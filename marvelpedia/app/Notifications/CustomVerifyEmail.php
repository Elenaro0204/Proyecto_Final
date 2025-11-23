<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailBase
{
    protected function verificationUrl($notifiable)
    {
    $hash = sha1($notifiable->getEmailForVerification());

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => $hash,
            ]
        );
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('¡Bienvenido a Marvelpedia! Verifica tu correo')
            ->view('email.welcome', [
                'user' => $notifiable,
                'verificationUrl' => $verificationUrl
            ]);
    }
}
