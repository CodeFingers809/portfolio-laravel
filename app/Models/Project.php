<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tech_stack',
        'achievements',
        'github_url',
        'demo_url',
        'paper_url',
        'image',
        'featured',
        'order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'achievements' => 'array',
        'featured' => 'boolean',
    ];
}
