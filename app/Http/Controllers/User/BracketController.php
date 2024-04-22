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

            return view('user.tournaments.bracket', ['matches' => $matches]);
        } catch (\Exception $e) {
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

    public function downloadCertificate($winnerId)
    {
        try {
            // Find the tournament match by winner ID
            $tournamentMatch = TournamentMatch::findOrFail($winnerId);

            // Get the winning team
            $winningTeam = $tournamentMatch->winner;

            // Check if the winning team exists
            if (!$winningTeam) {
                return redirect()->route('user.tournaments.index')->with('error', 'Winning team not found.');
            }

            // Get team members
            $teamMembers = $winningTeam->users;

            // Generate PDF content
            $pdfContent = view('user.tournaments.certificate', compact('winningTeam', 'teamMembers'))->render();

            // Generate PDF
            $dompdf = new Dompdf();
            $dompdf->loadHtml($pdfContent);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Generate file name
            $fileName = $winningTeam->name . '_certificate.pdf';

            // Download PDF
            return $dompdf->stream($fileName);
        } catch (\Exception $e) {
            return redirect()->route('user.tournaments.index')->with('error', 'An error occurred in downloading certificate.');
        }
    }

}
