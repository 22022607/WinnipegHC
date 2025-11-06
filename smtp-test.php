<?php
// smtp-test.php

require 'vendor/autoload.php'; // If using Laravel or Composer; otherwise, remove this line

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp-relay.brevo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '997ba4001@smtp-brevo.com'; // Always "apikey" for Brevo
    $mail->Password   = '5hnFjHyN9ZfvBATg'; // <-- replace with your actual SMTP key
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // From & To
    $mail->setFrom('komalchauhan393@gmail.com', 'Webzent');
    $mail->addAddress('komal.chauhan@webzent.in', 'Test Receiver');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'SMTP Test from Brevo';
    $mail->Body    = '<h3>This is a test email sent using Brevo SMTP</h3>';

    $mail->send();
    echo "✅ Message sent successfully!";
} catch (Exception $e) {
    echo "❌ Message could not be sent. Error: {$mail->ErrorInfo}";
}
