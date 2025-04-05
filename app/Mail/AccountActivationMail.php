<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $activation_link;

    /**
     * Create a new message instance.
     */
    public function __construct($username, $activation_link)
    {
        $this->username = $username;
        $this->activation_link = $activation_link;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Activate Your Metin2 Account')
                    ->view('emails.activation')
                    ->with([
                        'username' => $this->username,
                        'activation_link' => $this->activation_link,
                    ]);
    }
}
