<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Festival Ticket</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background-color: #f8f9fa; padding: 40px; }
        .ticket {
            background: white;
            border: 2px dashed #6b21a8;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            max-width: 500px;
            margin: auto;
        }
        h1 { color: #6b21a8; margin-bottom: 10px; }
        .details { margin-top: 15px; line-height: 1.6; }
        .footer { margin-top: 30px; font-size: 12px; color: #555; }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>🎟️ Healing Connections Festival 2025</h1>
        <hr>
        <div class="details">
            <p><strong>Ticket Code:</strong> {{ $ticket_code }}</p>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Quantity:</strong> {{ $quantity }}</p>
            <p><strong>Total Paid:</strong> ${{ number_format($amount, 2) }}</p>
        </div>
        <hr>
        <div class="footer">
            <p>Thank you for being part of the festival!<br>Bring this ticket for entry.</p>
        </div>
    </div>
</body>
</html>
