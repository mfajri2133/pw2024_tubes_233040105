<?php
function login_check()
{
     return isset($_SESSION['user_logged_in']);
}

function is_admin()
{

     if (!login_check()) return false;

     return ($_SESSION['user'])['is_admin'] == 1;
}

function start_session()
{
     if (session_status() == PHP_SESSION_NONE) {
          session_start();
     }
}

function redirect_to($view)
{
     header("Location: ../views/" . $view . ".php");
     exit();
}

function redirect_to_profile()
{
     if (isset($_SESSION['user_logged_in'])  && isset($_SESSION['user']['is_admin'])) {
          if ($_SESSION['user']['is_admin'] == 1) {
               header("Location: ../views/profile.php");
          } else {
               header("Location: ../views/profile-user.php");
          }
     } else {
          header("Location: ../views/index.php");
     }
     exit();
}


function fetch_post_data()
{
     if (isset($_SESSION["post_data"])) {
          $_POST = $_SESSION["post_data"];
          unset($_SESSION["post_data"]);
     }

     return;
}

function get_post_data($field)
{
     if (isset($_POST[$field])) return $_POST[$field];

     return;
}

function base_url($path = "")
{
     return "http://localhost/pw/pw2024_tubes_233040105" . $path;
}
