<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'degree',
        'field_of_study',
        'institution',
        'location',
        'start_date',
        'end_date',
        'cgpa',
        'description',
        'order',
    ];

    protected $casts = [
        'cgpa' => 'decimal:3',
    ];
}
