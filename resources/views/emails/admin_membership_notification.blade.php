<!DOCTYPE html>
<html>
<head>
    <title>New Membership Purchase</title>
</head>
<body>
    <p>Hello Admin,</p>

    <p>A new membership has just been purchased. Here are the details:</p>

    <ul>
        <li><strong>Full Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Phone:</strong> {{ $user->phone }}</li>
        <li><strong>Membership Type:</strong> {{ ucfirst($membership->type) }}</li>
        <li><strong>Amount Paid:</strong> ${{ number_format($membership->price, 2) }}</li>
        <li><strong>Payment ID:</strong> {{ $payment->stripe_payment_intent_id }}</li>
        <li><strong>Purchased At:</strong> {{ $payment->created_at->format('F d, Y H:i A') }}</li>
    </ul>

    <p>You can view more details in the admin dashboard.</p>

    <p>Regards,<br>The {{ config('app.name') }} System</p>
</body>
</html>
