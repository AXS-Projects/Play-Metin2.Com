<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $username;
    public string $reset_link;
    public string $cancel_link;

    public function __construct(string $username, string $reset_link, string $cancel_link)
    {
        $this->username = $username;
        $this->reset_link = $reset_link;
        $this->cancel_link = $cancel_link;
    }

    public function build()
    {
        return $this->subject(__('messages.password_reset_email_subject'))
            ->view('emails.password_reset')
            ->with([
                'username' => $this->username,
                'reset_link' => $this->reset_link,
                'cancel_link' => $this->cancel_link,
            ]);
    }
}
