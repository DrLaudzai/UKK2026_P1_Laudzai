<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false; // ⚠️ karena cuma pakai created_at

    protected $fillable = [
        'user_id',
        'action',
        'module',
        'description',
        'meta',
        'ip_address',
        'created_at'
    ];

    protected $casts = [
        'meta' => 'array'
    ];
}
