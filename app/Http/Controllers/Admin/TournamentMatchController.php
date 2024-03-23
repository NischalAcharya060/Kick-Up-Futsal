<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use Illuminate\Http\Request;

class TournamentMatchController extends Controller
{
    public function index($tournamentId)
    {
        $tournaments = Tournament::all();
        $tournament = Tournament::find(1);
        $team1 = Team::find(1);
        $team2 = Team::find(2);
        $tournamentMatches = TournamentMatch::where('tournament_id', $tournamentId)->get();
        return view('admin.tournament_matches.index', compact('tournamentMatches', 'tournaments', 'tournament','team1', 'team2'));
    }

    public function getWinner($matchId)
    {
        $match = TournamentMatch::find($matchId);

        if ($match) {
            $winner = $match->winner;
            if ($winner) {
                return view('admin.tournament_matches.winner', compact('winner'));
            } else {
                return view('admin.tournament_matches.draw');
            }
        } else {
            abort(404, 'Match not found');
        }
    }

    public function create($tournamentId)
    {
        $tournaments = Tournament::all();
        $tournament = Tournament::find($tournamentId);
        $teams = Team::all();
        return view('admin.tournament_matches.create', compact('tournament', 'tournaments', 'teams'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tournament_id' => 'required',
                'team1_id' => 'required',
                'team2_id' => 'required',
                'round' => 'required',
            ]);

            $tournamentMatch = TournamentMatch::create([
                'tournament_id' => $request->input('tournament_id'),
                'team1_id' => $request->input('team1_id'),
                'team2_id' => $request->input('team2_id'),
                'round' => $request->input('round'),
            ]);

            return redirect()->route('admin.tournaments.matches', ['tournamentId' => $request->input('tournament_id')])
                ->with('success', 'Tournament match created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the tournament match: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $tournamentId, $matchId)
    {
        try {
            // Retrieve the tournament associated with the match
            $tournament = Tournament::findOrFail($tournamentId);

            // Check if the match belongs to the tournament
            $matchToUpdate = $tournament->matches()->findOrFail($matchId);

            // Validate the request data
            $request->validate([
                'team1_score' => 'nullable|numeric',
                'team2_score' => 'nullable|numeric',
            ]);

            // Extract team scores from the request
            $team1Score = $request->input('team1_score');
            $team2Score = $request->input('team2_score');

            // Update team scores
            $matchToUpdate->team1_score = $team1Score;
            $matchToUpdate->team2_score = $team2Score;

            // Determine the winner based on scores
            if ($team1Score > $team2Score) {
                $matchToUpdate->winner_id = $matchToUpdate->team1_id;
            } elseif ($team2Score > $team1Score) {
                $matchToUpdate->winner_id = $matchToUpdate->team2_id;
            } else {
                // If scores are equal, set winner_id to null (draw)
                $matchToUpdate->winner_id = null;
            }

            // Save the updated match
            $matchToUpdate->save();

            return redirect()->back()->with('success', 'Tournament match scores updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the tournament match scores: ' . $e->getMessage());
        }
    }

    public function delete($matchId)
    {
        $matchToDelete = TournamentMatch::find($matchId);

        if (!$matchToDelete) {
            abort(404, 'Match not found');
        }

        $matchToDelete->delete();
        return redirect()->route('admin.tournaments.matches')->with('success', 'Tournament match deleted successfully');
    }
}
