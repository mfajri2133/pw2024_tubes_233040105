<?php
include_once '../lib/user.php';
include_once '../helpers/users.php';
include_once '../helpers/add_admin_mailer.php';

session_start();

function add_admin()
{
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name = $_POST['name'];
          $email = $_POST['email'];

          if (is_email_exists($email)) {
               $_SESSION['error'] = "This email is already registered.";
               redirect_to("admin");
               exit();
          }

          $result = add_admin_user($name, $email);

          if ($result === true) {
               send_email_notification($email, $name);
               $_SESSION['success_message'] = "Admin added successfully.";
               redirect_to("admin");
               exit();
          } else {
               $_SESSION['error'] = "Failed to add admin. Please try again.";
               redirect_to("admin");
               exit();
          }
     } else {
          $_SESSION['error'] = "Invalid request.";
          redirect_to("admin");
          exit();
     }
}

add_admin();
