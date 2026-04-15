<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'violation_id',
        'employee_id',
        'description',
        'settled_at'
    ];

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}