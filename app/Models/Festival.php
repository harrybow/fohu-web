<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    protected $fillable = [
        'aufbau_start',
        'aufbau_end',
        'festival_start',
        'festival_end',
        'abbau_start',
        'abbau_end',
    ];

    protected $casts = [
        'aufbau_start' => 'date',
        'aufbau_end' => 'date',
        'festival_start' => 'date',
        'festival_end' => 'date',
        'abbau_start' => 'date',
        'abbau_end' => 'date',
    ];
}
