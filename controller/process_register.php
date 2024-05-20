<?php
session_start();
include_once base_url('/lib/user.php');
include_once '../helpers/users.php';

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
          // Jika method yang digunakan adalah POST
     case 'POST':
          // Panggil fungsi handle_register
          handle_register();
          break;
     default:
          // Redirect kembali ke halaman register
          redirect_to("register");
          break;
}

// Fungsi handle_register
function handle_register()
{
     if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];

          if (is_email_exists($email)) {
               $_SESSION['error'] = "This email is already registered.";
               redirect_to("register");
               exit();
          }

          $result = add_user($name, $email, $password);
          if ($result === true) {
               $_SESSION['success_message'] = "Account created successfully.";
               redirect_to("register");
               exit();
          } else {
               $_SESSION['error'] = "Failed to create account. Please try again.";
               redirect_to("register");
               exit();
          }
     } else {
          $_SESSION['error'] = "Invalid request.";
          redirect_to("register");
          exit();
     }
}
