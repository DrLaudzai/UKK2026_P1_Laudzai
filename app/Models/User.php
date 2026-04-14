<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $attributes = [
        'credit_score' => 100,
        'is_restricted' => 0,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function loans()
    {
        return $this->hasMany(\App\Models\Loan::class);
    }

    public function violations()
    {
        return $this->hasMany(\App\Models\Violation::class);
    }

    public function appeals()
    {
        return $this->hasMany(\App\Models\Appeal::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(\App\Models\ActivityLog::class);
    }

    public function approvedLoans()
    {
        return $this->hasMany(\App\Models\Loan::class, 'employee_id');
    }

    public function recordedReturns()
    {
        return $this->hasMany(\App\Models\Return::class, 'employee_id');
    }

    public function settlements()
    {
        return $this->hasMany(\App\Models\Settlement::class, 'employee_id');
    }

    public function reviewedAppeals()
    {
        return $this->hasMany(\App\Models\Appeal::class, 'reviewed_by');
    }
}
