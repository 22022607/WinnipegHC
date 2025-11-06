<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLinks extends Model
{
    protected $fillable=[
        'twitter',
        'facebook',
        'linkedin',
        'instagram'
    ];
}
