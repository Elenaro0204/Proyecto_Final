<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ReviewReport extends Model
{
    protected $fillable = [
        'review_id',
        'reported_by',
        'resolved',
        'deadline',
    ];

    protected $casts = [
        'resolved' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function getRemainingTimeAttribute()
    {
        if (!$this->deadline) return null;

        $diff = Carbon::now()->diffInSeconds(Carbon::parse($this->deadline), false);
        return $diff > 0 ? gmdate('H:i:s', $diff) : 'Expirado';
    }
}
