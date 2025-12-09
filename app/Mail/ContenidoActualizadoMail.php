<?php

namespace App\Mail;

use App\Models\Mensaje;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContenidoActualizadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contenido;
    public $tipo;
    public $url;

    public function __construct($user, $contenido, $tipo = null, $url = null)
    {
        $this->user = $user;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
        $this->url = $url;
    }


    public function build()
    {
        $subject = $this->tipo ? "Tu {$this->tipo} ha sido actualizado" : "Contenido Actualizado";
        return $this->from('soportemarvelpedia@gmail.com', 'Marvelpedia Soporte')
            ->subject($subject)
            ->view('emails.contenido-actualizado')
            ->with([
                'user' => $this->user,
                'contenido' => $this->contenido,
                'tipo' => $this->tipo,
                'url' => $this->url,
            ]);
    }
}
