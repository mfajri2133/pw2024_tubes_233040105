<?php
include_once 'connection.php';

function register($name, $email, $password, $confirm_password)
{
     global $conn;
     $sql = "SELECT * FROM users WHERE email = ?";
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "s", $email);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     $existing_user = mysqli_fetch_assoc($result);

     if ($existing_user) {
          return "Email sudah terdaftar";
     }

     if ($password !== $confirm_password) {
          return "Konfirmasi password tidak sesuai";
     }

     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
     $stmt = mysqli_prepare($conn, $sql);
     mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
     if (mysqli_stmt_execute($stmt)) {
          redirect_to("login");
     } else {
          return "Registrasi gagal";
     }
}

// $name = $_POST['name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $confirm_password = $_POST['confirm_password'];

$name = "User Test gugun";
$email = "gugunbalap@gmail.com";
$password = "test12345";
$confirm_password = "test12345";
$result = register($name, $email, $password, $confirm_password);

echo $result;
