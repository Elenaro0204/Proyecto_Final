<?php

namespace App\Mail;

use App\Models\Foro;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class NuevoMensajeForo extends Mailable
{
    use Queueable, SerializesModels;

    public $autor;
    public $foro;
    public $mensaje;
    public $url;

    public function __construct(User $autor, Foro $foro, Mensaje $mensaje, $url)
    {
        $this->autor = $autor;     // Autor del mensaje
        $this->foro = $foro;       // Foro donde se escribe
        $this->mensaje = $mensaje; // Mensaje completo
        $this->url = $url;         // Enlace al foro o al mensaje
    }

    public function build()
    {
        return $this->subject('📩 Nuevo mensaje en tu foro')
            ->view('emails.nuevo-mensaje-foro')
            ->with([
                'foro' => $this->foro,
                'mensaje' => $this->mensaje,
                'autor' => $this->autor,
                'url' => $this->url,
            ]);
    }
}
