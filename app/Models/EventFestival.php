<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventFestival extends Model
{
    protected $fillable = [
        'title',
        'address',
        'description',
        'host',
        'contact',
        'email',
        'facebook',
        'admission_fee',
        'image',
        'website',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'total_seats',
    ];
        protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
         'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        ];
}
