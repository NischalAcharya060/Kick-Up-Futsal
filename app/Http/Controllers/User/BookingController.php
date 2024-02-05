<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
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
        // Retrieve facility ID from the session
        $facilityId = session('booking.facility_id');

        // Retrieve facility information from the database
        $facility = Facility::find($facilityId);

        // Check if the facility exists
        if (!$facility) {
            // Log the error or handle it as needed
            \Log::error("Facility not found for facility_id: $facilityId");

            // Facility not found, handle the error (e.g., redirect to an error page)
            return redirect()->route('error')->with('message', 'Facility not found.');
        }

        // Retrieve booking date and time from the session
        $bookingDate = session('booking.date');
        $bookingTime = session('booking.time');

        // Calculate total price based on facility and booking information
        $price = $facility->price_per_hour;

        // Generate receipt content
        $receiptContent = view('user.booking.receipt', compact('facility', 'bookingDate', 'bookingTime', 'price'))->render();

        // Generate PDF using a package like laravel-dompdf
        // Make sure to install the package: composer require barryvdh/laravel-dompdf
        $pdf = \PDF::loadHtml($receiptContent);

        // Generate a unique filename for the receipt
        $filename = 'receipt_' . time() . '_' . Str::random(8) . '.pdf';

        // Ensure the directory exists
        Storage::makeDirectory("public/receipts");

        // Save the PDF file to the storage directory
        $pdf->save(storage_path("app/public/receipts/$filename"));

        // Provide a download link to the user using Laravel Storage facade
        return Storage::download("public/receipts/$filename", $filename);
    }

}
