<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      protected $fillable = [
        'event_id', 
        'user_id', 
        'ticket_id',
        'transaction_id',
        'price',
        'quantity',
        'status',
        'ticket_code'
       
    ];
    public function event()
    {
        return $this->hasOne(Event::class,'id','event_id');
    }
     public function ticket()
    {
        return $this->hasOne(Ticket::class,'id','ticket_id');
    }
}
