<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'facility'])->latest()->paginate(5);
        $unreadNotificationCount = Notification::where('is_read', false)->count();
        return view('admin.bookings.index', compact('bookings', 'unreadNotificationCount'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }
}
