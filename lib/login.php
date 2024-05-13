<?php
include_once 'connection.php';
include_once '../controller/error_handler.php';

function login($email, $password)
{
     global $conn;
     $sql = "SELECT * FROM users WHERE email = ?";
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "s", $email);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     $user = mysqli_fetch_assoc($result);

     if (!$user || !password_verify($password, $user['password'])) {
          set_error_message("Email atau password salah");
          $_SESSION['post_data'] = $_POST;
          return false;
     }

     $_SESSION['user'] = $user;
     return $user;
}


$email = $_POST['email'];
$password = $_POST['password'];
$result = login($email, $password);

// function redirect_url($user)
// {
//      if ($user['is_admin'] == 1) {
//           header("Location: ../views/dashboard.php");
//           exit;
//      } else {
//           header("Location: ../views/index.php");
//           exit;
//      }
// }


// if (is_array($result)) {
//      redirect_url($result);
// } else {
//      echo "Login gagal: " . $result;
// }
