<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.profile.index', compact('user'));
    }

    public function updateDetails(Request $request)
    {
        // Validate the form data for updating details
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user details
        $user = auth()->user();
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

        return redirect()->route('admin.profile')->with('success', 'Details updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validate the form data for updating password
        $request->validate([
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Update the password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }

}
