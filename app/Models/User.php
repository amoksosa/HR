<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'schedule_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // users.schedule_id -> schedules.id
    public function schedule()
    {
        return $this->belongsTo(\App\Models\Schedule::class);
    }

    // attendance_logs.user_id -> users.id
    public function attendanceLogs()
    {
        return $this->hasMany(\App\Models\AttendanceLog::class);
    }

    // activity_logs.user_id -> users.id (optional)
    public function activityLogs()
    {
        return $this->hasMany(\App\Models\ActivityLog::class);
    }
}
