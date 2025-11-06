<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
abstract class Controller
{
    protected function sendLoginMail($userEmail)
{
    $mail = new PHPMailer(true);
    // dd($mail);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.winnipeghealingconnection.com';   // or your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@winnipeghealingconnection.com';  // SMTP username
        $mail->Password   = 'qkiqlukptzymypvz';     // SMTP app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 25;

        // Recipients
        $mail->setFrom('info@winnipeghealingconnection.com', 'Your App Name');
        $mail->addAddress($userEmail);   // send to logged in user
        $mail->addReplyTo('info@winnipeghealingconnection.com', 'Support');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Login Successful';
        $mail->Body    = "<p>Hello,</p><p>You have successfully logged in at <b>" . now() . "</b>.</p>";

        $mail->send();
        // \Log::info("Login email sent to $userEmail");
    } catch (Exception $e) {
        \Log::error("Mailer Error: {$mail->ErrorInfo}");
    }
}
}
