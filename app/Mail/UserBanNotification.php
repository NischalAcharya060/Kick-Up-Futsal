<?php

// app/Mail/UserBanNotification.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserBanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $action;

    public function __construct($user, $action)
    {
        $this->user = $user;
        $this->action = $action;
    }

    public function build()
    {
        return $this->view('admin.users.user_ban_notification')
            ->subject('User ' . ucfirst($this->action))
            ->with([
                'user' => $this->user,
                'action' => $this->action,
            ]);
    }
}
