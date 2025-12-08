<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContenidoCreado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tipo;
    public $contenido;
    public $user;

    public function __construct($tipo, $contenido, $user)
    {
        $this->tipo = $tipo;
        $this->contenido = $contenido;
        $this->user = $user;
    }
}
