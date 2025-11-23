<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'mensaje_id',
        'reported_by',
        'resolved',
        'deadline',
    ];

    protected $casts = [
        'resolved' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function mensaje()
    {
        return $this->belongsTo(Mensaje::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}
