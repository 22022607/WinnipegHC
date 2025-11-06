<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset Request</title>
</head>
<body>
    <p>Hello,</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>
        <a href="{{ url('reset-passwords/' . $token . '?email=' . urlencode($user->email)) }}" 
           style="background: #6b46c1; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px;">
           Reset Password
        </a>
    </p>
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>
