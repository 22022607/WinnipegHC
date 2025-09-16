<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Cashier\Billable; // Ensure in User model

class SubscriptionController extends Controller
{
   public function subscribe(Request $request)
{
    $plan = MembershipPlan::find($request->input('plan_id'));
    $user = auth()->user();
    $user->newSubscription('default', $plan->stripe_price_id)->create($request->input('paymentMethodId'));
    return redirect()->route('dashboard')->with('success', 'Subscription started!');
}
}
