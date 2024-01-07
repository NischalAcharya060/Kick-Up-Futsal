<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
        ]);

        // Update user data
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle password update if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Handle profile picture update if provided
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

}
