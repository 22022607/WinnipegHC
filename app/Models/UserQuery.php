<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}
