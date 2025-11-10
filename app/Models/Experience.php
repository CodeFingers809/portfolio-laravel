<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'organization',
        'location',
        'start_date',
        'end_date',
        'current',
        'description',
        'achievements',
        'type',
        'url',
        'order',
    ];

    protected $casts = [
        'achievements' => 'array',
        'current' => 'boolean',
    ];
}
