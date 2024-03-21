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

    public function accessTeamInformation($tournamentId)
    {
        $tournamentMatches = TournamentMatch::where('tournament_id', $tournamentId)->get();

        foreach ($tournamentMatches as $match) {
            $team1 = $match->team1;
            $team2 = $match->team2;
            // Do something with $team1 and $team2
        }

        return view('admin.tournament_matches.team_information');
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
                'team1_score' => 'nullable|numeric',
                'team2_score' => 'nullable|numeric',
            ]);

            $team1Score = $request->input('team1_score');
            $team2Score = $request->input('team2_score');

            $winnerId = ($team1Score > $team2Score) ? $request->input('team1_id') : $request->input('team2_id');

            $tournamentMatch = TournamentMatch::create([
                'tournament_id' => $request->input('tournament_id'),
                'team1_id' => $request->input('team1_id'),
                'team2_id' => $request->input('team2_id'),
                'team1_score' => $team1Score,
                'team2_score' => $team2Score,
                'winner_id' => $winnerId,
            ]);

            return redirect()->route('admin.tournaments.matches', ['tournamentId' => $request->input('tournament_id')])
                ->with('success', 'Tournament match created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the tournament match: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $matchId)
    {
        try {
            $matchToUpdate = TournamentMatch::find($matchId);

            if (!$matchToUpdate) {
                abort(404, 'Match not found');
            }

            $request->validate([
                'winner_id' => 'required',
            ]);

            $matchToUpdate->winner_id = $request->input('winner_id');
            $matchToUpdate->save();

            return redirect()->route('admin.tournaments.matches')->with('success', 'Tournament match updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the tournament match: ' . $e->getMessage());
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
