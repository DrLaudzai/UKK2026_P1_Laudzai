<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BundleTool extends Model
{
    protected $table = 'bundle_tools';

    protected $fillable = [
        'bundle_id',
        'name',
        'qty'
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'bundle_id');
    }
}
