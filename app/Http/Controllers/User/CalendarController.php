<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $user = auth()->user();

        return view('user.calendar.index', compact('events', 'user'));
    }
}
