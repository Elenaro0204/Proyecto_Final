<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
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
        // Generar la URL de verificación
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // Ruta que definiremos
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->id, 'hash' => sha1($notifiable->email)]
        );

        return (new MailMessage)
            ->subject('Verifica tu correo en Marvelpedia')
            ->view('emails.verificacion', [
                'user' => $notifiable,
                'verificationUrl' => $verificationUrl,
            ]);
    }
}
