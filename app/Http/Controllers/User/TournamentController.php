<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        $facilities = Facility::all();
        return view('user.tournaments.index', compact('tournaments', 'facilities'));
    }

    public function show(Tournament $tournament)
    {
        $facilities = Facility::all();

        return view('user.tournaments.show', compact('tournament', 'facilities'));
    }

    public function joinTournament(Tournament $tournament)
    {
        $user = auth()->user();

        // Check if the user is in a team
        if ($user->teams->isEmpty()) {
            return redirect()->route('user.teams.create')->with('error', 'You need to join or create a team before joining a tournament.');
        }

        $team = $user->teams()->first(); // Assuming a user can belong to only one team

        // Check if the team is already registered for the tournament
        if (!$tournament->teams->contains($team->id)) {
            $tournament->teams()->attach($team->id);
            return redirect()->route('user.tournaments.index')->with('success', 'Joined the tournament successfully.');
        }

        return redirect()->route('user.tournaments.index')->with('error', 'Team is already registered for the tournament.');
    }

}
