<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'loan_id',
        'user_id',
        'return_id',
        'type',
        'total_score',
        'fine',
        'description',
        'status',
        'created_at'
    ];

    // ================= RELASI =================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function return()
    {
        return $this->belongsTo(ReturnModel::class, 'return_id');
    }

    public function settlement()
    {
        return $this->hasOne(Settlement::class);
    }
}