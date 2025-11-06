<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessAppointment extends Model
{
    protected $fillable = [
        'business_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'appointment_time',
        'notes',
        'date',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
