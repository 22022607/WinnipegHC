<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'category',
        'location',
        'rating',
        'reviews',
        'phone',
        'website',
        'hours',
        'description',
        'image',
        'featured',
    ];
}
