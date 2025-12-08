<?php

namespace App\Mail;

use App\Models\Mensaje;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContenidoCreadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contenido;
    public $tipo;
    public $url;

    public function __construct($user, $contenido, $tipo = 'mensaje', $url = null)
    {
        $this->user = $user;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Tu contenido ha sido creado')
            ->view('emails.contenido-creado')
            ->with([
                'user' => $this->user,
                'contenido' => $this->contenido,
                'tipo' => $this->tipo,
                'url' => $this->url,
            ]);
    }
}
