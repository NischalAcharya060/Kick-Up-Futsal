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
            return [
                'title' => 'Already Booked',
                'start' => $booking->booking_date,
                'className' => 'booked-event',
            ];
        });

        return view('user.calendar.index', compact('events', 'user', 'bookedDates'));
    }
}
