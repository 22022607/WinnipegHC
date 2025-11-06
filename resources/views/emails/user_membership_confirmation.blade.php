<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Membership Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <p>Hi {{ $user->first_name }},</p>

    <p>Thank you for purchasing the <strong>{{ ucfirst($membership->type) }}</strong> membership.</p>

    <p>Here are your membership details:</p>

    <ul>
        <li><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Phone:</strong> {{ $user->phone }}</li>
        <li><strong>Membership Type:</strong> {{ ucfirst($membership->type) }}</li>
        <li><strong>Price:</strong> ${{ number_format($membership->price, 2) }}</li>
        <li><strong>Start Date:</strong> {{ now()->format('F d, Y') }}</li>
        <li><strong>End Date:</strong> {{ now()->addMonths($membership->duration_months)->format('F d, Y') }}</li>
        <li><strong>Transaction ID:</strong> {{ $transactionId }}</li>
        <li><strong>Expire Date:</strong> {{ now()->addMonth()->format('F d, Y') }}</li>

    </ul>

    <p>You now have access to all membership benefits.</p>

    <p>If you have any questions, feel free to contact us at 
        <a href="info@winnipeghealingconnection.com">info@winnipeghealingconnection.com</a>.
    </p>

    <p>Welcome to the community!</p>

    <p>— The Winnipeg HC Team</p>
</body>
</html>
