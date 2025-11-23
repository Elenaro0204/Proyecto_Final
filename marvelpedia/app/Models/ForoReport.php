<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ForoReport extends Model
{
    protected $fillable = [
        'foro_id',        // Clave foránea al foro
        'reported_by',    // Usuario que reporta
        'resolved',       // Estado de resolución
        'deadline',       // Fecha límite
    ];

    protected $casts = [
        'resolved' => 'boolean',
        'deadline' => 'datetime',
    ];

    /**
     * Relación con el foro reportado
     */
    public function foro()
    {
        return $this->belongsTo(Foro::class);
    }

    /**
     * Relación con el usuario que realizó el reporte
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /**
     * Tiempo restante para resolución del reporte
     */
    public function getRemainingTimeAttribute()
    {
        if (!$this->deadline) return null;

        $diff = Carbon::now()->diffInSeconds(Carbon::parse($this->deadline), false);
        return $diff > 0 ? gmdate('H:i:s', $diff) : 'Expirado';
    }
}
