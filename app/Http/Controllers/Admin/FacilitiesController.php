<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        $facilities = Facility::paginate(10);
        $unreadNotificationCount = Notification::where('is_read', false)->count();
        return view('admin.facilities.index', compact('facilities', 'unreadNotificationCount'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        try {
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

            $facilityData['added_by'] = auth()->id();

            Facility::create($facilityData);

            return redirect()->route('admin.facilities.index')->with('success', 'Facility Added Successfully.');
        } catch (QueryException $e) {
            // Handle the exception, log it, or return an error response
            return redirect()->back()->with('error', 'Error creating facility: ' . $e->getMessage());
        }
    }

    public function show(Facility $facility)
    {
        return view('admin.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, $id)
    {
        try {
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

            // Find the Facility by ID
            $facility = Facility::findOrFail($id);

            // Update the Facility instance with new data
            $facilityData = $request->except('image');

            // Check if an image file is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image file if it exists
                if (!is_null($facility->image_path) && Storage::disk('public')->exists($facility->image_path)) {
                    Storage::disk('public')->delete($facility->image_path);
                }

                // Store the new image file
                $imagePath = $request->file('image')->store('facility_images', 'public');
                $facilityData['image_path'] = 'storage/' . $imagePath;
            }

            // Update the facility
            $facility->update($facilityData);

            return redirect()->route('admin.facilities.index')->with('success', 'Facility Updated Successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error updating facility: ' . $e->getMessage());
        }
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Facility Deleted Successfully.');
    }
}
