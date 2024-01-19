<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        $facilities = Facility::paginate(10);
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'map_coordinates' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Facility::create($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Added Successfully.');
    }

    public function show(Facility $facility)
    {
        return view('admin.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'map_coordinates' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $facility->update($request->all());

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Updated Successfully.');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Deleted Successfully.');
    }
}
