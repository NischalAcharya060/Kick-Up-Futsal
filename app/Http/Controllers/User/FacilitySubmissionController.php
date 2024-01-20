<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Facility;
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
            ]);

            // Create a new facility submission with 'pending' status
            $facilitySubmission = Facility::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'status' => 'pending',
            ]);

            // Create a notification for admin
            Notification::create([
                'facility_submission_id' => $facilitySubmission->id,
                'message' => 'New facility submission received.',
            ]);

            return redirect()->route('user.facility_submissions.create')->with('success', 'Facility submission received. Admin will review shortly.');
        } catch (\Exception $e) {
            return redirect()->route('user.facility_submissions.create')->with('error', 'An error occurred while processing the submission.');
        }
    }
}
