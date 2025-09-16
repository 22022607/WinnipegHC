<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = 
    [
        'title', 
        'description', 
        'date_time_from',
        'date_time_to',
        'contact',
        'website',
        'venue', 
        'total_seats',
        'host',
        'email',
        'facebook_link',
        'registration_link',
        'admission_fee',
        'image',
        'date',
        'start_time',
        'end_time',
        'what_to_expect',
        'prerequisites',
        'category',
        'duration',
        'location',
        'user_id'
];
    protected $casts = [
    'date' => 'datetime',
    'start_time' => 'datetime:H:i:s',
    'end_time' => 'datetime:H:i:s',
];

public function tickets()
{
    return $this->hasOne(Ticket::class,'event_id','id');
}
protected static function boot()
{
    parent::boot();

    static::deleting(function ($event) {
        $event->tickets()->delete();
    });
}
public function eventtickets()
{
    return $this->hasMany(Ticket::class,'event_id','id');
}
}
