<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    public $timestamps = false;

    protected $table = 'app_configs';

    protected $fillable = [
        'name',
        'late_point',
        'broken_point',
        'lost_point',
        'late_fine',
        'broken_fine',
        'lost_fine',
        'updated_at'
    ];
}