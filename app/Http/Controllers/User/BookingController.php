<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Facility;
use App\Models\User;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $facilities = Facility::all();
        $sortBy = $request->input('sort_by', 'price_lowest');

        return view('user.booking.index', compact('facilities', 'sortBy'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'price_lowest');

        $facilitiesQuery = Facility::where('name', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%");

        switch ($sortBy) {
            case 'price_highest':
                $facilitiesQuery->orderByDesc('price_per_hour');
                break;
            case 'price_lowest':
            default:
                $facilitiesQuery->orderBy('price_per_hour');
                break;
        }

        $facilities = $facilitiesQuery->get();

        return view('user.booking.index', compact('facilities', 'search', 'sortBy'));
    }

    public function bookmark(Facility $facility)
    {
        $user = auth()->user();

        if (!$user->bookmarkedFacilities->contains($facility)) {
            $user->bookmarkedFacilities()->attach($facility);
            return back()->with('success', 'Facility bookmarked successfully.');
        }

        return back()->with('warning', 'Facility already bookmarked.');
    }

    public function bookmarks()
    {
        $bookmarkedFacilities = auth()->user()->bookmarkedFacilities;
        return view('user.booking.bookmarks', compact('bookmarkedFacilities'));
    }

    public function unbookmark($facilityId)
    {
        $user = Auth::user();

        $facility = Facility::find($facilityId);

        // Check if the facility and user exist
        if (!$facility || !$user) {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $user->bookmarkedFacilities()->detach($facility);

        return redirect()->back()->with('success', 'Facility Un-Bookmarked Successfully.');
    }

    public function show($facilityId)
    {
        $facility = Facility::findOrFail($facilityId);

        // Retrieve bookings with ratings and reviews for the specific facility
        $ratingsAndReviews = Booking::where('facility_id', $facility->id)
            ->whereNotNull('ratings')
            ->whereNotNull('reviews')
            ->with('user')
            ->get();

        return view('user.booking.show', compact('facility', 'ratingsAndReviews'));
    }

    public function showBookings()
    {
        $user = auth()->user();
        $bookings = $user->bookings()->paginate(5);

        return view('user.booking.my-booking', compact('bookings'));
    }

    public function confirm(Request $request, $facilityId)
    {
        try {
            $facility = Facility::findOrFail($facilityId);

            // Create a new Booking instance
            $user = auth()->user();
            $booking = new Booking();
            $booking->user_id = auth()->user()->id;
            $booking->facility_id = $facilityId;
            $booking->amount = $facility->price_per_hour;
            $booking->user_name = $user->name;
            $booking->email = $user->email;
            $booking->contact_number = $user->contact_number;
            $booking->booking_date = $request->input('date');
            $booking->booking_time = $request->input('time');

            // Save the booking to the database
            $booking->save();

            // Set the booking ID in the session
            $request->session()->put('booking.id', $booking->id);

            // Set other booking details in the session
            $request->session()->put('booking.facility_id', $facilityId);
            $request->session()->put('booking.date', $request->input('date'));
            $request->session()->put('booking.time', $request->input('time'));
            $request->session()->put('booking.amount', $facility->price_per_hour);

            return view('user.booking.confirmation', compact('facility', 'booking'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while confirming booking.');
        }
    }

    public function generateReceipt()
    {
        $facilityId = session('booking.facility_id');

        $facility = Facility::find($facilityId);

        if (!$facility) {
            \Log::error("Facility not found for facility_id: $facilityId");

            return redirect()->route('error')->with('message', 'Facility not found.');
        }

        $bookingDate = session('booking.date');
        $bookingTime = session('booking.time');

        $price = $facility->price_per_hour;

        $receiptContent = view('user.booking.receipt', compact('facility', 'bookingDate', 'bookingTime', 'price'))->render();

        $pdf = \PDF::loadHtml($receiptContent);

        $filename = 'receipt_' . time() . '_' . Str::random(8) . '.pdf';

        Storage::makeDirectory("public/receipts");

        $pdf->save(storage_path("app/public/receipts/$filename"));

        return Storage::download("public/receipts/$filename", $filename);
    }

    public function paymentSuccess(Request $request)
    {
        try {
            // Retrieve data from the session
            $facilityId = session('booking.facility_id');
            $bookingDate = session('booking.date');
            $bookingTime = session('booking.time');

            // Ensure all required data is present
            if (!$facilityId || !$bookingDate || !$bookingTime) {
                throw new \Exception('Incomplete or missing booking information in session.');
            }

            // Retrieve booking data from the database using the facility ID, date, and time
            $booking = Booking::where('facility_id', $facilityId)
                ->where('booking_date', $bookingDate)
                ->where('booking_time', $bookingTime)
                ->first();

            // Check if the booking is not found
            if (!$booking) {
                throw new \Exception('Booking not found. Facility ID: ' . $facilityId . ', Date: ' . $bookingDate . ', Time: ' . $bookingTime);
            }

            // Update the booking status to "completed"
            $booking->status = 'Payment Completed';
            $booking->save();

            return view('user.booking.payment-success');
        } catch (\Exception $e) {
            return view('user.booking.payment-error', ['error' => $e->getMessage()]);
        }
    }

    public function storeReview(Request $request, Booking $booking)
    {
        try {
            $request->validate([
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'review' => ['nullable', 'string'],
            ]);

            // Check if the user has already reviewed this booking
            if ($booking->hasReviews()) {
                return redirect()->route('user.bookings', $booking->id)->with('error', 'You have already reviewed this booking.');
            }

            // Update ratings and reviews in the database
            $booking->ratings += $request->input('rating');
            $booking->reviews = $request->input('review');
            $booking->save();

            return redirect()->route('user.bookings', $booking->id)->with('success', 'Review added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.bookings', $booking->id)->with('error', 'Error adding review: ' . $e->getMessage());
        }
    }

    public function cancel(Request $request, Booking $booking)
    {
        $booking->update(['status' => 'Booking Cancelled']);

        return redirect()->back()->with('success', 'Booking has been cancelled successfully.');
    }
}
