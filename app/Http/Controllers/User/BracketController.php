<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;
use App\Models\Team;

class BracketController extends Controller
{
    public function generateBracket()
    {
        try {
            // Retrieve tournament matches from the database
            $matches = TournamentMatch::with(['team1', 'team2', 'winner'])->get();

            // Return the view with bracket matches
            return view('user.tournaments.bracket', ['matches' => $matches]);
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('user.tournaments.index')->with('error', 'An error occurred.');
        }
    }

    public function showBracket($tournamentId)
    {
        try {
            // Retrieve tournament matches from the database based on the tournament ID
            $matches = TournamentMatch::where('tournament_id', $tournamentId)->get();

            // Return the view with the tournament bracket matches
            return view('user.tournaments.bracket', ['matches' => $matches]);
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('user.tournaments.index')->with('error', 'An error occurred.');
        }
    }

}
