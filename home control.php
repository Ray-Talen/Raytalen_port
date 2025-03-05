<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message']; // Fix: This was missing

    $mail = new PHPMailer(true); // Fix: Create PHPMailer instance

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kutefrank1234@gmail.com'; // Replace with your Gmail
        $mail->Password = 'hzpa qjek kqcj liqj'; // Use an App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Fix: Use TLS
        $mail->Port = 587; // Fix: Use 587 for TLS

        // Email content
        $mail->setFrom($email, $name);
        $mail->addAddress('kutefrank1234@gmail.com'); // Replace with your Gmail
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        header("location: index.php?Successful");
    } catch (Exception $e) {
        header("location: index.php?Failed");
    }
}
?>