<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendWelcomeEmail;
use App\Mail\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


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

            // Generate a random verification code
            $verificationCode = strtoupper(Str::random(6));

            // Create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'register_type' => 'Register Form',
                'verification_code' => $verificationCode,
            ]);

            // Send verification email to the user
            Mail::to($user)->send(new VerificationMail($user));


            // Send welcome email to the user
            SendWelcomeEmail::dispatch($user)->delay(now()->addMinutes(1));

            // Authentication success
            return redirect()->route('verification.code')->with('success', 'Registration successful. Please check your email for the verification code.');
        } catch (\Exception $e) {
            // Handle registration errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showVerificationCodeForm()
    {

        return view('Auth.verification');
    }

    public function verify(Request $request)
    {
        // Validate the verification code and reCAPTCHA response
        $request->validate([
            'verification_code' => 'required|string|exists:users,verification_code',
            'g-recaptcha-response' => 'required',
        ]);

        // Verify reCAPTCHA response
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        // Check if reCAPTCHA verification failed
        if (!$response->json('success')) {
            return redirect()->back()->with('error', 'RECAPTCHA verification failed. Please try again.');
        }

        // Find the user by verification code
        $user = User::where('verification_code', $request->input('verification_code'))->first();

        if ($user) {
            // Clear the verification code
            $user->verification_code = null;
            $user->verified = true;
            $user->save();

            // Redirect to login page
            return redirect()->route('login')->with('success', 'Verification successful. You can now log in.');
        } else {
            // Verification failed
            return redirect()->back()->with('error', 'Invalid verification code. Please re-enter your verification code.');
        }
    }
}
