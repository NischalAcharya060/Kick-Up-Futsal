<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Models\TournamentMatch;
use Dompdf\Dompdf;
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

//    public function downloadCertificate($winnerId)
//    {
//        try {
//            // Find the tournament match by winner ID
//            $tournamentMatch = TournamentMatch::find($winnerId);
//
//            // Check if the tournament match exists
//            if (!$tournamentMatch) {
//                return redirect()->route('user.tournaments.index')->with('error', 'Tournament match not found.');
//            }
//
//            // Get the winning team's ID from the tournament match
//            $winningTeamId = $tournamentMatch->winner_id;
//
//            // Retrieve the winning team from the Team table
//            $winningTeam = Team::find($winningTeamId);
//
//            // Check if the winning team exists
//            if (!$winningTeam) {
//                return redirect()->route('user.tournaments.index')->with('error', 'Winning team not found.');
//            }
//
//            // Get team members
//            $teamMembers = $winningTeam->users;
//
//            // Generate PDF content
//            $pdfContent = view('user.tournaments.certificate', compact('winningTeam', 'teamMembers'))->render();
//
//            // Generate PDF
//            $dompdf = new Dompdf();
//            $dompdf->loadHtml($pdfContent);
//            $dompdf->setPaper('A4', 'landscape');
//            $dompdf->render();
//
//            // Generate file name
//            $fileName = $winningTeam->name . '_certificate.pdf';
//
//            // Download PDF
//            return $dompdf->stream($fileName);
//        } catch (\Exception $e) {
//            dd($e);
//            return redirect()->route('user.tournaments.index')->with('error', 'An error occurred in downloading certificate.');
//        }
//    }

}
