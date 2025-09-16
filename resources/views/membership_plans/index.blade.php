@extends('layouts.app')
@section('content')
<h2>Membership Plans</h2>
<a href="{{ route('membership-plans.create') }}">Add New Plan</a>
@foreach($plans as $plan)
<div>
<h3>{{ $plan->name }}</h3>
<p>Price: ${{ $plan->price }}</p>
<p>Duration: {{ $plan->duration_months }} months</p>
<a href="{{ route('membership-plans.edit', $plan) }}">Edit</a>
<form method="POST" action="{{ route('membership-plans.destroy', $plan) }}">
            @csrf @method('DELETE')
<button type="submit">Delete</button>
</form>
</div>
@endforeach
@endsection