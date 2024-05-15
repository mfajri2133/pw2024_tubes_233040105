<?php
include_once '../helpers/users.php';
start_session();


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
