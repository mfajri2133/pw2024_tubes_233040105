<?php
include_once 'connection.php';

include_once '../controller/toast_handler.php';

function login($username, $password)
{
     global $conn;
     $sql = "SELECT * FROM users WHERE username = ?";
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "s", $username);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     $user = mysqli_fetch_assoc($result);

     if (!$user || !password_verify($password, $user['password'])) {
          $_SESSION['error'] = ("username atau password salah");
          $_SESSION['post_data'] = $_POST;
          return false;
     }

     $_SESSION['user'] = $user;
     return $user;
}
