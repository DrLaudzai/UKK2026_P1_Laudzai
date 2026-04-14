<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'loan_id',
        'employee_id',
        'condition_id',
        'return_date',
        'proof',
        'notes'
    ];

    public $timestamps = false;

    // relasi
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}