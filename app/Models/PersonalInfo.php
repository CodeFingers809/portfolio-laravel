<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personal_info';

    protected $fillable = [
        'name',
        'title',
        'email',
        'mobile',
        'bio',
        'location',
        'profile_image',
    ];
}
