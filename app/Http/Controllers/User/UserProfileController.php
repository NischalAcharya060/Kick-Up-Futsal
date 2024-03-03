<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', ['user' => $user]);
    }

    public function updateDetails(Request $request)
    {
        try {
            $user = auth()->user();

            // Validate the form data for updating details
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Update user details
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            // Handle profile picture update if provided
            if ($request->hasFile('profile_picture')) {
                // Delete the previous profile picture if it exists
                if ($user->profile_picture) {
                    Storage::delete('public/profile_pictures/' . $user->profile_picture);
                }

                // Store the new profile picture
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile_picture = basename($profilePicturePath);
            }

            $user->save();

            return redirect()->route('user.profile')->with('success', 'Details updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.profile')->with('error', 'An error occurred while updating details.');
        }
    }

    public function additionalDetails(Request $request)
    {
        try {
            $user = auth()->user();

            // Validate the form data for updating details
            $request->validate([
                'dob' => 'date',
                'contact_number' => 'numeric',
                'address' => 'string|max:255',
                'preferred_position' => 'string|max:255',
            ]);

            // Update user details
            $user->dob = $request->input('dob');
            $user->gender = $request->input('gender');
            $user->contact_number = $request->input('contact_number');
            $user->address = $request->input('address');
            $user->preferred_position = $request->input('preferred_position');
            $user->experience_level = $request->input('experience_level');

            $user->save();

            return redirect()->route('user.profile')->with('success', 'Additional Details updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('user.profile')->with('error', 'An error occurred while updating details.');
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            // Validate the form data for updating password
            $request->validate([
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            // Get the authenticated user
            $user = auth()->user();

            // Update the password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            // Handle the exception as per your requirement
            return redirect()->route('user.profile')->with('error', 'An error occurred while updating the password.');
        }
    }
}
