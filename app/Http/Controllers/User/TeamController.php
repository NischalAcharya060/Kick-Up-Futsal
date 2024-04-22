<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $usersToInvite = User::whereNotIn('id', auth()->user()->teams->pluck('id'))->get();
        return view('user.teams.index', compact('teams', 'usersToInvite'));
    }

    public function create()
    {
        return view('user.teams.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:teams',
            ]);

            $team = Team::create([
                'name' => $request->input('name'),
            ]);

            $team->users()->attach(Auth::id(), ['is_creator' => true]);

            return redirect()->route('user.teams.index')->with('success', 'Team created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.teams.create')->with('error', 'Team is not created. Please try again.');
        }
    }

    public function joinTeam(Team $team)
    {
        $user = Auth::user();

        // Check if the team has reached its capacity (5 users)
        if ($team->users->count() >= 5) {
            return redirect()->route('user.teams.index')->with('error', 'This team has reached its maximum capacity. Please try joining another team.');
        }
        // Check if the user is already a member of the team
        if ($user->teams->isNotEmpty()) {
            return redirect()->route('user.teams.index')->with('error', 'You are already a member of a team. Please leave your current team before joining another.');
        }
        $team->users()->attach($user->id);

        return redirect()->route('user.teams.index')->with('success', 'Joined the team successfully.');
    }


    public function leaveTeam(Team $team)
    {
        $team->users()->detach(Auth::id());

        return redirect()->route('user.teams.index')->with('success', 'Left the team successfully.');
    }

    public function inviteUser(Request $request, Team $team)
    {
        $request->validate([
            'invited_user' => 'required|exists:users,id',
        ]);

        $invitedUserId = $request->input('invited_user');

        // Check if the user is already a member of the team
        if ($team->users->contains($invitedUserId)) {
            return redirect()->route('user.teams.index')->with('error', 'This user is already a member of the team.');
        }

        // Check if the team has reached its capacity (5 users)
        if ($team->users->count() >= 5) {
            return redirect()->route('user.teams.index')->with('error', 'This team has reached its maximum capacity. You cannot send more invitations.');
        }

        // Add the invited user to the team
        $team->users()->attach($invitedUserId);

        return redirect()->route('user.teams.index')->with('success', 'User invited to the team successfully.');
    }
}
