<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContenidoReportadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $owner;
    public $contenido;
    public $reporter;
    public $reporte;
    public $link;
    public $tipo;

    public function __construct($owner, $contenido, $reporter, $reporte = null, $link = null, $tipo = null)
    {
        $this->owner = $owner;
        $this->contenido = $contenido;
        $this->reporter = $reporter;
        $this->reporte = $reporte;
        $this->link = $link;
        $this->tipo = $tipo;
    }

    public function build()
    {
        return $this->from('soportemarvelpedia@gmail.com', 'Marvelpedia Soporte')
            ->subject('Tu contenido ha sido reportado')
            ->view('emails.contenido-reportado');
    }
}
