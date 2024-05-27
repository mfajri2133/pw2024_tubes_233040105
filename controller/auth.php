<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
include_once '../lib/login.php';
start_session();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
          // Jika method yang digunakan adalah POST
     case 'POST':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'login':
                    // Panggil fungsi handle_login
                    handle_login();
                    break;
               case 'register':
                    // Panggil fungsi handle_register
                    handle_register();
                    break;
               default:
                    redirect_to("login");
                    break;
          }
          break;
          // Jika method yang digunakan bukan POST
     default:
          redirect_to("login");
          break;
}

function handle_login()
{
     if (isset($_POST['username']) && isset($_POST['password'])) {
          $username = htmlspecialchars($_POST['username']);
          $password = htmlspecialchars($_POST['password']);

          $result = login($username, $password);
          if (is_array($result)) {
               if ($result['is_active'] == 1) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['success_message'] = 'Welcome back, ' . $result['name'] . '!';
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
               $_SESSION['error'] = "Incorrect username or password.";
               redirect_to("login");
          }
     } else {
          redirect_to("login");
     }
}

// Fungsi handle_register
function handle_register()
{
     if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {
          $name = htmlspecialchars($_POST['name']);
          $username = htmlspecialchars($_POST['username']);
          $password = htmlspecialchars($_POST['password']);

          if (is_username_exists($username)) {
               $_SESSION['error'] = "This username is already registered.";
               redirect_to("register");
               exit();
          }

          $result = add_user($name, $username, $password);
          if ($result === true) {
               $_SESSION['success_message'] = "Account created successfully.";
               redirect_to("login");
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
