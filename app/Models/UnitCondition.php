<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitCondition extends Model
{
    protected $table = 'unit_conditions';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'unit_code',
        'return_id',
        'conditions',
        'notes',
        'recorded_at'
    ];
}
