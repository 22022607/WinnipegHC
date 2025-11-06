<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
      protected $fillable = [
        'user_id', 'membership_id', 'amount', 'currency', 'stripe_payment_intent_id', 
        'stripe_charge_id', 'status', 'membership_type', 'card_last4','start_date','end_date',
        'business_id','spotlight_month', 'next_payment_date'
    ];
    public function user() {
        return $this->belongsTo(MembershipUser::class);
    }

    public function membership() {
        return $this->belongsTo(MembershipPlan::class);
    }
public function membership_plan()
{
    return $this->belongsTo(MembershipPlan::class, 'membership_id');
}
public function events()
    {
        return $this->hasOne(Event::class, 'id','event_id');
    }
     public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
