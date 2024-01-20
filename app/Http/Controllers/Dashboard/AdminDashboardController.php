<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.dashboard', compact('user'));
    }

    public function notifications()
    {
        $notifications = Notification::with('facility.user')->where('is_read', false)->get();
        return view('admin.notifications.index', ['notifications' => $notifications]);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);
        return redirect()->route('admin.notifications.index');
    }

    public function viewSubmission(Notification $notification)
    {
        $facility = $notification->facility;

        if ($facility) {
            // Redirect to a page to view the facility details
            return redirect()->route('admin.facilities.show', $facility->id);
        } else {
            // Handle the case where the related facility is not found
            return redirect()->route('admin.notifications.index')->with('error', 'Facility not found.');
        }
    }
}

