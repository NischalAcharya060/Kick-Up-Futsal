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
    public $subject;
    public $messages;

    /**
     * Create a new message instance.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  string  $subject
     * @param  string  $messages
     * @return void
     */
    public function __construct($name, $email, $subject, $messages)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)
            ->subject($this->subject)
            ->view('user.contact_us.contactformTemplate')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'messages' => $this->messages,
            ]);
    }
}
