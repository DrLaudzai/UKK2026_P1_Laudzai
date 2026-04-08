<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'no_hp',
        'address',
        'birth_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
