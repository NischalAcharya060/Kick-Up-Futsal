<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminCalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $user = auth()->user();
        $bookings = Booking::with('user')->get();

        $bookedDates = $bookings->map(function ($booking) {
            $bookingDate = \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d');
            $bookingTime = \Carbon\Carbon::parse($booking->booking_time)->format('H:i:s');
            $facilityName = $booking->facility->name;
            $userName = $booking->user->name;

            $title = "{$facilityName} - " . \Carbon\Carbon::parse($booking->booking_time)->format('h:i A');

            return [
                'title' => $title,
                'start' => $bookingDate,
                'bookingDate' => $bookingDate,
                'bookingTime' => $bookingTime,
                'facilityName' => $facilityName,
                'userName' => $userName,
                'bookingStatus' => $booking->status,
                'bookingAmount' => $booking->amount,
                'bookingPaymentMethod' => $booking->payment_method,
                'className' => 'badge badge-danger badge-pill',
                'borderColor' => 'red',
            ];
        });

        return view('admin.calendar.index', compact('user', 'bookedDates'));
    }
}
