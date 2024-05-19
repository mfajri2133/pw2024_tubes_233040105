<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../PHPMailer/src/Exception.php';
include_once '../PHPMailer/src/SMTP.php';
include_once '../PHPMailer/src/PHPMailer.php';

function send_email_notification($email, $name)
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
          // Menyiapkan subject email
          $mail->Subject = 'Admin Account Created';
          // Menyiapkan isi email
          $mail->isHTML(true);
          $mail->Body =
               '<html><body style="font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 20px;">' .
               '<div style="background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">' .
               '<h2 style="color: #333; margin-bottom: 20px;">Hello ' . $name . ',</h2>' .
               '<p>Your admin account has been successfully created.</p>' .
               '<p>Please login with your account below:</p>' .
               '<table style="background-color: #f2f2f2; padding: 10px; border-collapse: collapse; width: 100%; margin-bottom: 20px;">' .
               '<tr><td style="padding: 8px; border-bottom: 1px solid #ddd;">Email</td><td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $email . '</td></tr>' .
               '<tr><td style="padding: 8px;">Password</td><td style="padding: 8px;"><strong>fwebAdmin123!</strong></td></tr>' .
               '</table>' .
               '<p>After successfully logging in, please change the password.</p>' .
               '<p>Thank you.</p>' .
               '</div></body></html>';


          // Send email
          if ($mail->send()) {
               echo 'Email notification sent successfully.';
          } else {
               throw new Exception('Email notification could not be sent. Please try again later.');
          }
     } catch (Exception $e) {
          echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
     }
}
