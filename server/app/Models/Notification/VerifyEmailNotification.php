<?php

namespace App\Models\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($this->userId);

        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please click the button below to verify your email address.'))
            ->action(Lang::get('Verify Email'), $verificationUrl)
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }

    protected function verificationUrl($userId)
    {
        return url("/api/verify-email/{$userId}");
    }
}
