<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            // Send welcome email to the user
            Mail::to($user)->send(new WelcomeMail($user));

            // Authentication success
            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            // Handle registration errors
            return redirect()->back()->with('error', 'An error occurred during registration.');
        }
    }
}
