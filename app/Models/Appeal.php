<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    protected $fillable = [
        'user_id',
        'reviewed_by',
        'reason',
        'status',
        'credit_changed',
        'admin_notes',
        'created_at',
        'reviewed_at'
    ];

    public $timestamps = false;

    // relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}