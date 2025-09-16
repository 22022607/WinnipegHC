<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
class MembershipPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $plans = MembershipPlan::all();
        return view('membership_plans.index', compact('plans'));
    }
    public function show(MembershipPlan $membershipPlan)
    {
        return view('membership_plans.show', compact('membershipPlan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('membership_plans.create');
    }
 
    public function store(Request $request) {
        MembershipPlan::create($request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration_months' => 'required|integer',
            'stripe_price_id' => 'nullable|string',
            'active' => 'boolean'
        ]));
        return redirect()->route('membership-plans.index')->with('success', 'Plan added!');
    }
 
    public function edit(MembershipPlan $membershipPlan) {
        return view('membership_plans.edit', compact('membershipPlan'));
    }
 
    public function update(Request $request, MembershipPlan $membershipPlan) {
        $membershipPlan->update($request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'duration_months' => 'required|integer',
            'stripe_price_id' => 'nullable|string',
            'active' => 'boolean'
        ]));
        return redirect()->route('membership-plans.index')->with('success', 'Plan updated!');
    }
 
    public function destroy(MembershipPlan $membershipPlan) {
        $membershipPlan->delete();
        return redirect()->route('membership-plans.index')->with('success', 'Plan deleted!');
    }
}
