<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolUnit extends Model
{
    const STATUS_AVAILABLE = 'available';
    const STATUS_LENT = 'lent';
    const STATUS_NONACTIVE = 'nonactive';
    protected $table = 'tool_units';

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'tool_id',
        'status',
        'notes',
        'created_at'
    ];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}