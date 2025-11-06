<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exhibitor extends Model
{
    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
        'email',
        'contact',
        'website',
        'member_id',
    ];
}
