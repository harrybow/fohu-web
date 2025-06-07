<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    protected $fillable = [
        'day',
        'title',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
