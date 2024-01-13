<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        $user = auth()->user();

        return view('auth.passwords.email', compact('user'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            // Save the email in the session
            $request->session()->put('reset_email', $request->email);
            return back()->with('status', 'Password reset link sent successfully. Check your email.');
        } else {
            return back()->withErrors(['email' => trans($response)]);
        }
    }

    public function showResetForm($token)
    {
        $user = auth()->user();
        return view('auth.passwords.reset', compact('token', 'user'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset($request->only(
            'email', 'password', 'password_confirmation', 'token'
        ), function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ])->save();
        });

        if ($response == Password::PASSWORD_RESET) {
            // Set a success message in the session
            $request->session()->flash('success', 'Password reset successfully. Login with your new password.');

            return redirect()->route('login');
        } else {
            return back()->withErrors(['email' => trans($response)]);
        }
    }
}
