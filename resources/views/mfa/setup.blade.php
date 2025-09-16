@extends('layouts.app')
 
@section('content')
<h2>MFA Setup (Google Authenticator)</h2>
<p>Scan this QR code with your Authenticator app:</p>
<div>{!! $qr !!}</div>
<p>Your secret key: <code>{{ $secret }}</code></p>
<form method="POST" action="{{ route('mfa.verify') }}">
    @csrf
<label>Enter code from your app:</label>
<input type="text" name="one_time_password" required>
<button type="submit">Verify</button>
</form>
@endsection