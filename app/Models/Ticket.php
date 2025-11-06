<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_id', 
        'user_id', 
        'qr_code', 
        'status',
        'name',
        'price',
        'quantity',
        'attendees',
        'early_bird_price',
        'ticket_sale_start',
        'ticket_sale_end',
        'registration_url',
        'platform_name',
        'ticket_type'
    ];
     public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function purchases()
    {
        return $this->hasMany(Order::class, 'ticket_id');
    }
}
