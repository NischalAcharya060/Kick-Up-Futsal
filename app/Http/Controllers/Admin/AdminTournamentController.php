<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Http\Request;

class AdminTournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::all();
        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create()
    {
        return view('admin.tournaments.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:tournaments',
                'location' => 'nullable|string|max:255',
                'map_coordinates' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after:start_date',
            ], [
                'start_date.after_or_equal' => 'The start date must be today or a future date.',
                'end_date.after' => 'The end date must be after the start date.',
            ]);

            $start_date = $request->input('start_date');
            if (now()->greaterThan($start_date)) {
                throw new \Exception('Start date must be today or a future date.');
            }

            Tournament::create($request->all());


            return redirect()->route('admin.tournaments.index')->with('success', 'Tournament created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tournaments.create')->with('error', $e->getMessage());
        }
    }


    public function edit(Tournament $tournament)
    {
        return view('admin.tournaments.edit', compact('tournament'));
    }

    public function update(Request $request, Tournament $tournament)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:tournaments,name,' . $tournament->id,
                'location' => 'nullable|string|max:255',
                'map_coordinates' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after:start_date',
            ], [
                'start_date.after_or_equal' => 'The start date must be today or a future date.',
                'end_date.after' => 'The end date must be after the start date.',
            ]);

            $start_date = $request->input('start_date');
            if (now()->greaterThan($start_date)) {
                throw new \Exception('Start date must be today or a future date.');
            }

            $tournament->update($request->all());

            return redirect()->route('admin.tournaments.index', $tournament->id)->with('success', 'Tournament updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tournaments.edit', $tournament->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();

        return redirect()->route('admin.tournaments.index')->with('success', 'Tournament deleted successfully.');
    }
}
