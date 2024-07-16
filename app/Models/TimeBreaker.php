<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeBreaker extends Model
{
    use HasFactory;

    protected $table = 'time_breaks';

    protected $fillable = [
        'time_tracker_id',
        'breakin',
        'breakout',
        'total_hours',
        'created_at',
        'updated_at',
    ];
}
