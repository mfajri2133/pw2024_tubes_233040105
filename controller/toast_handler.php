<?php
include_once '../helpers/users.php';
start_session();


function set_error_message($message)
{
     $_SESSION['error'] = $message;
}

function get_error_message()
{
     if (isset($_SESSION['error'])) {
          $message = $_SESSION['error'];
          unset($_SESSION['error']);
          return $message;
     }
     return false;
}

function set_success_message($message)
{
     $_SESSION['success_message'] = $message;
}

function get_success_message()
{
     if (isset($_SESSION['success_message'])) {
          $message = $_SESSION['success_message'];
          unset($_SESSION['success_message']);
          return $message;
     }
     return false;
}
