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
