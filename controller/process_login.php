<?php
include_once '../helpers/users.php';
include_once '../lib/login.php';
start_session();


function handle_login()
{
     if (isset($_POST['email']) && isset($_POST['password'])) {
          $email = $_POST['email'];
          $password = $_POST['password'];
          $result = login($email, $password);

          if (is_array($result)) {
               if ($result['is_active'] == 1) {
                    $_SESSION['user_logged_in'] = true;
                    if ($result['is_admin'] == 1) {
                         redirect_to("dashboard");
                    } else {
                         redirect_to("index");
                    }
               } else {
                    $_SESSION['error'] = "Your account has been deactivated.";
                    redirect_to("login");
               }
          } else {
               $_SESSION['error'] = "Incorrect email or password.";
               redirect_to("login");
          }
     } else {
          redirect_to("login");
     }
}


// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
     case 'POST':
          handle_login();
          break;
     default:
          redirect_to("login");
          break;
}
