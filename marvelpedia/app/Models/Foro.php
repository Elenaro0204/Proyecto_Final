<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Foro extends Model
{
    protected $fillable = [
        'user_id',
        'categoria',
        'titulo',
        'descripcion',
        'estado',
        'num_mensajes',
        'ultima_actividad',
        'color_fondo',
        'color_titulo',
        'imagen_portada',
        'visibilidad',
    ];

    public function puedeVer(User $user)
    {
        return $this->visibilidad === 'publico'
            || $user->id === $this->user_id
            || $user->rol === 'admin';
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class);
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report(): HasMany
    {
        return $this->hasMany(ForoReport::class);
    }
}
