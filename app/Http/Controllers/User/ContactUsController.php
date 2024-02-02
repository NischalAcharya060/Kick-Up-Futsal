<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function showForm()
    {
        return view('user.contact_us.contact_us');
    }

    public function submitForm(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'messages' => 'string',
                'subject' => 'required',
            ]);

            // Send email
            Mail::to('Nischal060@gmail.com')->send(new ContactFormMail(
                $request->input('name'),
                $request->input('email'),
                $request->input('subject'),
                $request->input('messages')
            ));

            return "Thank you for the form submission. An admin will reach out soon.";
        } catch (\Exception $e) {
            dd($e);
            Log::error('Email sending failed: ' . $e->getMessage());

            return redirect()->back()->withErrors(['email' => 'Failed to send email. Please try again.']);
        }
    }

}

