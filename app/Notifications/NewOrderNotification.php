<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['database']; // Salvează notificarea în baza de date
    }

	public function toDatabase($notifiable): array
	{
		return [
			'title' => 'Test Notification',
			'body' => 'This is a test notification sent from Tinker.', // Modificat din "message" în "body"
		];
	}
}
