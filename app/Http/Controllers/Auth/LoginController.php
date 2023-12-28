<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout successful.');
    }
}
