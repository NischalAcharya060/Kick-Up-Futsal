<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Booking;

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
        $request->session()->put('booking.date', $request->input('date'));
        $request->session()->put('booking.time', $request->input('time'));

        return view('user.booking.confirmation', compact('facility'));
    }

    public function showPaymentForm()
    {
        return view('user.booking.payment');
    }

    public function processPayment(Request $request)
    {
        // Handle payment processing logic based on the selected payment method
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'khalti') {
            // Implement Khalti payment logic
        } elseif ($paymentMethod === 'cash_on_delivery') {
            // Implement Cash on Delivery logic
        }

        // Add any necessary logic for successful or failed payments

        return redirect()->route('user.booking.show')->with('success', 'Booking successful!');
    }

}
