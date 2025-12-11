<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContenidoCancelarReportadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $owner;
    public $contenido;
    public $link;
    public $tipo;

    public function __construct($owner, $contenido, $link = null, $tipo = null)
    {
        $this->owner = $owner;
        $this->contenido = $contenido;
        $this->link = $link;
        $this->tipo = $tipo;
    }

    public function build()
    {
        $subject = $this->tipo ? "Se ha cancelado el reporte en tu {$this->tipo}" : "Cancelado Reporte de Contenido";
        return $this->from('soportemarvelpedia@gmail.com', 'Marvelpedia Soporte')
            ->subject($subject)
            ->view('emails.contenido-canceladoreportado')
            ->with([
                'user' => $this->owner,
                'contenido' => $this->contenido,
                'link' => $this->link,
                'tipo' => $this->tipo,
            ]);
    }
}
