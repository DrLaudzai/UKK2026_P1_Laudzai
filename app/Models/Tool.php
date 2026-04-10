<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'item_type',
        'price',
        'min_credit_score',
        'description',
        'code_slug',
        'photo_path'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function units()
    {
        return $this->hasMany(ToolUnit::class, 'tool_id');
    }

}