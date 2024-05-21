<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../PHPMailer/src/Exception.php';
include_once '../PHPMailer/src/SMTP.php';
include_once '../PHPMailer/src/PHPMailer.php';

function send_email_prep($email, $name)
{
     try {
          // Create a new PHPMailer instance
          $mail = new PHPMailer();

          // Set SMTP configuration if you're using SMTP
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com'; // Your SMTP host
          $mail->SMTPAuth = true;
          $mail->Username = 'applicationfweb@gmail.com';
          $mail->Password = 'desglkcewqxaussp';
          $mail->SMTPSecure = 'ssl';
          $mail->Port = 465; // Your SMTP port

          // Set email parameters
          // Menyiapkan email dan nama pengirim
          $mail->setFrom('applicationfweb@gmail.com', 'FWeb');
          // Menyiapkan email dan nama penerima
          $mail->addAddress($email, $name);
          // Mail berformat HTML
          $mail->isHTML(true);
          // Menyiapkan subject email
          $mail->Subject = mailer_subject();

          return $mail;
     } catch (Exception $e) {
          echo 'Message could not be prepared. Mailer Error: ' . $mail->ErrorInfo;
          return false;
     }
}
