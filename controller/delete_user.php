<?php
include_once '../helpers/users.php';
include_once '../lib/user.php';
session_start();


function delete_user()
{
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_POST['id'])) {
               $id = $_POST['id'];
               $result = soft_destroy($id);
               if ($result === true) {
                    $_SESSION['success_message'] = "User berhasil dihapus.";
                    redirect_to("user");
                    exit();
               } else {
                    $_SESSION['error'] = "User tidak ditemukan.";
                    redirect_to("user");
                    exit();
               }
          } else {
               $_SESSION['error'] = "User tidak ditemukan.";
               redirect_to("user");
               exit();
          }
     } else {
          $_SESSION['error'] = "Permintaan tidak valid.";
          redirect_to("user");
          exit();
     }
}


delete_user();
