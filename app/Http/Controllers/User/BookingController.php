<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('user.booking.show', compact('facility'));
    }

    public function showBookings()
    {
        $user = auth()->user();
        $bookings = $user->bookings;

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
            $booking->receipt_file_path = 'path/to/receipt';

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

    public function savePaymentMethod(Request $request)
    {
        try {
            // Retrieve the booking ID from the session
            $bookingId = session('booking.id');

            // Ensure booking id is present
            if (!$bookingId) {
                throw new \Exception('Invalid booking id.');
            }

            // Retrieve booking data from the database
            $booking = Booking::find($bookingId);

            // Check if the booking is not found
            if (!$booking) {
                throw new \Exception('Booking not found. Booking ID: ' . $bookingId);
            }

            // Ensure necessary keys are present in the booking data
            if (!$booking->facility_id || !$booking->date || !$booking->time) {
                throw new \Exception('Invalid booking information.');
            }

            // Retrieve the payment method from the request
            $paymentMethod = $request->input('payment_method');

            // Save the payment method to the booking
            $booking->payment_method = $paymentMethod;

            // Save the booking to the database
            $booking->save();

            // Save the payment method in the session (replace 'your_payment_method' with the desired session key)
            session(['your_payment_method' => $paymentMethod]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $bookingId = session('booking.id');

            // Ensure booking id is present
            if (!$bookingId) {
                throw new \Exception('Invalid booking id.');
            }
            // Retrieve booking data from the database
            $booking = Booking::find($bookingId);

            // Check if the booking is not found
            if (!$booking) {
                throw new \Exception('Booking not found. Booking ID: ' . $bookingId);
            }

            // Ensure necessary keys are present in the booking data
            if (!$booking->facility_id || !$booking->date || !$booking->time) {
                throw new \Exception('Invalid booking information.');
            }

            $facility = Facility::find($booking->facility_id);

            // Ensure the facility is found
            if (!$facility) {
                throw new \Exception('Facility not found for booking ID: ' . $bookingId);
            }

            return view('user.booking.payment-success');
        } catch (\Exception $e) {
            return view('user.booking.payment-success');
        }
    }
}
