<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Facility;
use App\Models\Booking;
use App\Models\Payment;

class BookingController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();

        return view('user.booking.index', compact('facilities'));
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

    public function confirm(Request $request, $facilityId)
    {
        $facility = Facility::findOrFail($facilityId);
        // Validate date and time inputs here

        // Store selected date and time in the session
        $request->session()->put('booking.facility_id', $facilityId);
        $request->session()->put('booking.date', $request->input('date'));
        $request->session()->put('booking.time', $request->input('time'));

        return view('user.booking.confirmation', compact('facility'));
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

        // Calculate total price based on facility and booking information
        $price = $facility->price_per_hour;

        // Generate receipt content
        $receiptContent = view('user.booking.receipt', compact('facility', 'bookingDate', 'bookingTime', 'price'))->render();

        $pdf = \PDF::loadHtml($receiptContent);

        $filename = 'receipt_' . time() . '_' . Str::random(8) . '.pdf';

        // Ensure the directory exists
        Storage::makeDirectory("public/receipts");

        $pdf->save(storage_path("app/public/receipts/$filename"));

        return Storage::download("public/receipts/$filename", $filename);
    }

}
