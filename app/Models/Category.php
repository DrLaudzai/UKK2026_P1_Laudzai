<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = false;

    public function tools()
{
    return $this->hasMany(Tool::class, 'category_id');
}
}