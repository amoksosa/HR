<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
