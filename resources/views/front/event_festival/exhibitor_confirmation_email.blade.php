<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exhibitor Table Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f8fafc; color: #333; padding: 30px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 25px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">

        <h2 style="color: #0a7ea4;">🎉 Thank you, {{ $user->first_name }}!</h2>
        <p>Your <strong>Exhibitor Table</strong> has been successfully confirmed.</p>
        
        <p>Below are your booking details:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">🎪 <strong>Festival:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">Healing Connections Festival 2025</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">💵 <strong>Amount:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">$79.00</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">🔑 <strong>Transaction ID:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $order->transaction_id }}</td>
            </tr>
        </table>


        <p style="margin-top: 25px;">We’re excited to have you at the <strong>Healing Connections Festival 2025</strong>!</p>

        <p style="margin-top: 40px;">Warm regards,<br>
        <strong>The Healing Connections Team</strong></p>
    </div>
</body>
</html>
