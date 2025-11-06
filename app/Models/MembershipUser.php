<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;



class MembershipUser extends Authenticatable
{
    protected $guard = 'member';
    protected $table = 'membership_users'; 
      protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'membership_type',
        'interests',
        'terms',
        'password',
        'last_login_at',
        'last_login_ip',
        'previous_login_at',
        'previous_login_ip',
        'password_changed_at',
        'status'
    ];
    protected $casts = [
    'email_verified_at' => 'datetime',
    'last_login_at' => 'datetime',
    'previous_login_at' => 'datetime',
    'password_changed_at' => 'datetime',
    'last_active_at' => 'datetime',
    'dormant_until' => 'datetime',
];
 public function membership_details()
    {
        return $this->hasOne(MembershipPayment::class, 'user_id');
    }
// Membership payments
    public function payments()
    {
        return $this->hasMany(MembershipPayment::class, 'user_id');
    }

    // Orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

  
}
