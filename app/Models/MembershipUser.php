<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipUser extends Model
{
      protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'membership_type',
        'interests',
        'terms',
        'password'
    ];
}
