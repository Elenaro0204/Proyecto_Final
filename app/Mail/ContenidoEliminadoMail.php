<?php

namespace App\Mail;

use App\Models\Mensaje;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContenidoEliminadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contenido;
    private $tipo;

    public function __construct($user, $contenido, $tipo)
    {
        $this->user = $user;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
    }

    public function build()
    {
        $subject = $this->tipo ? "Tu {$this->tipo} ha sido eliminado" : "Contenido Eliminado";
        return $this->from('soportemarvelpedia@gmail.com', 'Marvelpedia Soporte')
            ->subject($subject)
            ->view('emails.contenido-eliminado');
    }
}
