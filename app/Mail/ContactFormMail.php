<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;
    public $subject;

    public function __construct($name, $email, $message, $subject)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from($this->email)
            ->subject($this->subject)
            ->view('user.contact_us.contact-form-mail', [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
                'subject' => $this->subject,
            ]);
    }
}
