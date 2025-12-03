<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token; // token para la verificación

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Verifica tu correo en Marvelpedia')
            ->view('emails.verificacion');
    }
}
