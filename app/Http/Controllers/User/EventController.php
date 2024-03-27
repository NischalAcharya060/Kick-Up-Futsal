<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Support\Carbon;


class EventController extends Controller
{
    public function show_event()
    {
        // Retrieve upcoming tournaments from the database
        $upcomingTournaments = Tournament::where('start_date', '>', Carbon::now())
            ->orderBy('start_date')
            ->get();

        // Return the view with upcoming tournaments
        return view('user.events.show', compact('upcomingTournaments'));
    }
}
