@extends('layouts.app')
@section('content')
<h2>Add/Edit Membership Plan</h2>
<form method="POST" action="{{ isset($membershipPlan) ? route('membership-plans.update', $membershipPlan) : route('membership-plans.store') }}">
    @csrf
    @if(isset($membershipPlan)) @method('PUT') @endif
<input name="name" value="{{ old('name', $membershipPlan->name ?? '') }}" required>
<input name="price" type="number" step="0.01" value="{{ old('price', $membershipPlan->price ?? '') }}" required>
<input name="duration_months" type="number" value="{{ old('duration_months', $membershipPlan->duration_months ?? '') }}" required>
<input name="stripe_price_id" value="{{ old('stripe_price_id', $membershipPlan->stripe_price_id ?? '') }}">
<label>Active: <input type="checkbox" name="active" value="1" {{ isset($membershipPlan) && $membershipPlan->active ? 'checked' : '' }}></label>
<button type="submit">Save</button>
</form>
@endsection