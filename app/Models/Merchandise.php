<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $fillable = ['event_id', 'name', 'sku', 'price', 'inventory'];
 
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
