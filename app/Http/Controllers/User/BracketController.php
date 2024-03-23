<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
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
            $tournament = Tournament::find($tournamentId);

            if ($tournament) {
                $matches = TournamentMatch::where('tournament_id', $tournamentId)->get();

                return view('user.tournaments.bracket', [
                    'tournamentName' => $tournament->name,
                    'matches' => $matches
                ]);
            } else {
                return redirect()->route('user.tournaments.index')->with('error', 'Tournament not found.');
            }
        } catch (\Exception $e) {
            return redirect()->route('user.tournaments.index')->with('error', 'An error occurred.');
        }
    }
}
