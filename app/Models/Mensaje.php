<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'foro_id',
        'user_id',
        'contenido',
        'editado',
        'editado_en',
        'eliminado',
        'parent_id'
    ];

    public function foro()
    {
        return $this->belongsTo(Foro::class, 'foro_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Mensaje::class, 'parent_id')->with('user', 'replies');
    }

    public function parent()
    {
        return $this->belongsTo(Mensaje::class, 'parent_id');
    }

    public function respuestas()
    {
        return $this->hasMany(Mensaje::class, 'parent_id');
    }

    public function reports()
    {
        return $this->hasMany(MensajeReport::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by'); // si necesitas el usuario que reportó
    }
}
