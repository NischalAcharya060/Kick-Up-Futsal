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

    public function store(Request $request)
    {
        try {
            // Validate the form data for adding facilities
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'location' => 'required|string',
                'map_coordinates' => 'nullable|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Check if an image file is uploaded
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('facility_images', 'public');
                $imagePath = 'storage/' . $imagePath;
            }

            // Status is set to 'pending' by default
            $status = 'pending';

            if ($request->input('status') === 'accepted') {
                // Create a new facility submission with 'accepted' status
                $facilitySubmission = Facility::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'location' => $request->input('location'),
                    'map_coordinates' => $request->input('map_coordinates'),
                    'status' => 'accepted',
                    'image_path' => $imagePath,
                ]);

                // Create a notification for admin
                Notification::create([
                    'facility_submission_id' => $facilitySubmission->id,
                    'message' => 'New facility submission accepted.',
                ]);

                return redirect()->route('user.facility_submissions.create')->with('success', 'Facility submission accepted.');
            }

            return redirect()->route('user.facility_submissions.create')->with('success', 'Facility submission received. Admin will review shortly.');
        } catch (\Exception $e) {
            return redirect()->route('user.facility_submissions.create')->with('error', 'An error occurred while processing the submission.');
        }
    }

}
