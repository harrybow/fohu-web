<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['day', 'title', 'description'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'day' => 'date',
    ];

    /**
     * Users that are signed up for this workday.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
