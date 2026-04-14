<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UnitCondition extends Model
{
    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $table = 'unit_conditions';

    protected $fillable = [
        'id',
        'unit_code',
        'conditions',
        'notes',
        'recorded_at',
        'return_id'
    ];

    public $timestamps = false; // karena kamu tidak pakai created_at default
}