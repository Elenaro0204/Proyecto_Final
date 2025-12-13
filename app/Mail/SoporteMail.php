<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SoporteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $email;
    public $mensaje;
    public $tipo;

    public function __construct($nombre, $email, $mensaje, $tipo = null)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->mensaje = $mensaje;
        $this->tipo = $tipo;
    }

    public function build()
    {
        $subject = $this->tipo == "opinion" ? "Nueva Opinión desde Marvelpedia" : "Nuevo mensaje de soporte desde Marvelpedia";
        return $this->from('soportemarvelpedia@gmail.com', 'Marvelpedia Soporte')
            ->subject($subject)
            ->view('emails.soporte'); // Aquí va la vista que crearemos
    }
}
