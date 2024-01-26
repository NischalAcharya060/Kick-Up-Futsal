<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
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
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price_per_hour' => 'nullable|numeric|min:0',
            'facility_type' => 'nullable|string|max:255',
            'opening_time' => 'nullable|string|max:255',
            'closing_time' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
        ]);

        // Create a new Facility instance
        $facilityData = $request->except('image');

        // Check if an image file is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('facility_images', 'public');
            $facilityData['image_path'] = 'storage/' . $imagePath;
        }

        Facility::create($facilityData);

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
            'price_per_hour' => 'nullable|numeric|min:0',
            'facility_type' => 'nullable|string|max:255',
            'opening_time' => 'nullable|string|max:255',
            'closing_time' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|string|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if an image file is uploaded
        if ($request->hasFile('image_path')) {
            // Delete the previous image if it exists
            if ($facility->image_path) {
                Storage::delete('public/facility_images/' . $facility->image_path);
            }

            // Store the new image
            $imagePath = $request->file('image_path')->store('facility_images', 'public');
            $facility->image_path = basename($imagePath);
        }

        $facility->name = $request->input('name');
        $facility->description = $request->input('description');

        $facility->save();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Updated Successfully.');
    }



    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Deleted Successfully.');
    }
}
