<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenter extends Model
{
   protected $fillable = [
        'name',
        'title',
        'description',
        'contact',
        'email',
        'website',
        'timeslot',
        'image',
        'member_id',
    ];
}
