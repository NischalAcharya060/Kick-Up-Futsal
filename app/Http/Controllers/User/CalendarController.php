<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $user = auth()->user();
        $bookings = Booking::all();

        $bookedDates = $bookings->map(function ($booking) {
            $bookingDate = \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d');
            $bookingTime = \Carbon\Carbon::parse($booking->booking_time)->format('H:i:s');

            return [
                'title' => 'Already Booked',
                'start' => $bookingDate,
                'bookingDate' => $bookingDate,
                'bookingTime' => $bookingTime,
                'facilityName' => $booking->facility->name,
                'className' => 'booked-event',
            ];
        });

        return view('user.calendar.index', compact('events', 'user', 'bookedDates'));
    }
}
