<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;
use Illuminate\Http\Request;

class FacilitySubmissionController extends Controller
{
    public function create()
    {
        return view('user.facility_submissions.create');
    }

    public function viewSubmission($id)
    {
        $facility = Facility::findOrFail($id);

        return view('user.facility_submissions.view', compact('facility'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the form data for adding facilities
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string',
                'map_coordinates' => 'nullable|string|max:255',
                'price_per_hour' => 'nullable|numeric|min:0',
                'facility_type' => 'nullable|string|max:255',
                'opening_time' => 'nullable|string|max:255',
                'closing_time' => 'nullable|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'contact_email' => 'nullable|string|email|max:255',
                'contact_phone' => 'nullable|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'in:pending,accepted',
            ]);

            // Check if an image file is uploaded
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('facility_images', 'public');
                $imagePath = 'storage/' . $imagePath;
            }
            $facilityData['added_by'] = auth()->id();

            // Status is set to 'pending' by default
            $status = $request->input('status', 'pending');

            // Create a new facility submission
            $facilitySubmission = Facility::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'map_coordinates' => $request->input('map_coordinates'),
                'price_per_hour' => $request->input('price_per_hour'),
                'facility_type' => $request->input('facility_type'),
                'opening_time' => $request->input('opening_time'),
                'closing_time' => $request->input('closing_time'),
                'contact_person' => $request->input('contact_person'),
                'contact_email' => $request->input('contact_email'),
                'contact_phone' => $request->input('contact_phone'),
                'status' => $status,
                'image_path' => $imagePath,
            ]);

            // Create a notification for admin
            Notification::create([
                'facility_submission_id' => $facilitySubmission->id,
                'message' => "New facility submission {$status}.",
            ]);

            return redirect()->route('user.facility_submissions.create')->with('success', 'Facility submission received. Admin will review shortly.');
        } catch (\Exception $e) {
            return redirect()->route('user.facility_submissions.create')->with('error', 'An error occurred while processing the submission.');
        }
    }

    public function updateStatus(Request $request, Facility $facility)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,accepted',
            ]);

            $facility->update([
                'status' => $request->input('status'),
            ]);

            return redirect()->route('user.facility_submissions.view', $facility->id)
                ->with('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.facility_submissions.view', $facility->id)
                ->with('error', 'An error occurred while updating the status.');
        }
    }

}
