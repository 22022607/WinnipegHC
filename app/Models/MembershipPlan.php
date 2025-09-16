<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
     protected $fillable = ['name', 'price', 'stripe_price_id', 'duration_months', 'active'];

}
