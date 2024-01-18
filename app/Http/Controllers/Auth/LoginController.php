<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Check if the user is banned
            if (Auth::user()->isBanned()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Your account is banned. Please contact the admin for assistance.'])->withInput();
            }

            // Check the user type and redirect accordingly
            if (Auth::user()->user_type == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->user_type == 'user') {
                return redirect()->route('user.dashboard');
            }
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Check if the user already exists in your database or create a new user
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            // Create a new user with Google credentials
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = bcrypt(Str::random(8));
            $newUser->save();

            Auth::login($newUser);
        }

        return redirect()->route('user.dashboard'); // Redirect to user dashboard after login
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout successful.');
    }
}
