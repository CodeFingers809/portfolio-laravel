<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title',
        'position',
        'organization',
        'date',
        'description',
        'prize_type',
        'cash_prize',
        'other_prize',
        'url',
        'order',
    ];

    protected $casts = [
        'cash_prize' => 'decimal:2',
    ];
}
