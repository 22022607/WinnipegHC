<!DOCTYPE html>
<html>
<head>
    <title>Business Spotlight Purchase Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafc;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h2 {
            color: #2563eb;
        }
        p {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 25px;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Business Spotlight Purchase Confirmation</h2>

        <p>Hi {{ $user->first_name }} {{ $user->last_name }},</p>

        <p>Thank you for your <strong>Business Spotlight</strong> purchase!</p>

        <p>Here are the details of your purchase:</p>

        
        <ul>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</li>
            <li><strong>Transaction ID:</strong> {{ $transactionId }}</li>
            <li><strong>Purchase Date:</strong> {{ now()->format('F d, Y') }}</li>
        </ul>

        <p>
            If you have any questions, feel free to contact us at  
            <a href="mailto:support@example.com">support@example.com</a>.
        </p>

        <p>Best regards,<br>
        <strong>The Winnipeg HC Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html>
