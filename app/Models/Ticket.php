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
        'platform_name'
    ];
}
