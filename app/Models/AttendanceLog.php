<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $table = 'attendance_logs';

    protected $fillable = [
        'user_id',
        'log_date',
        'time_in',
        'time_out',
        'status',
    ];

    protected $casts = [
        'log_date' => 'date',
        'time_in'  => 'datetime',
        'time_out' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
