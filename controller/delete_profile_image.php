<?php
include_once '../helpers/users.php';
include_once '../lib/user.php';
session_start();

function delete_profile_image()
{
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $user_id = $_POST['id'];

          // Ambil informasi pengguna
          $user = get_user($user_id);
          if ($user) {
               // Hapus file gambar profil
               $upload_dir = "../uploads/" . $user_id . "/";
               $allowed_extensions = array('jpg', 'jpeg', 'png');
               foreach ($allowed_extensions as $ext) {
                    $file = $upload_dir . 'profile.' . $ext;
                    if (file_exists($file)) {
                         unlink($file);
                    }
               }

               // Hapus path gambar profil di database
               $result = remove_profile_image($user_id);
               if ($result === true) {
                    $_SESSION['success_message'] = "Profile image deleted successfully.";
               } else {
                    $_SESSION['error'] = "Failed to delete profile image from the database.";
               }
          } else {
               $_SESSION['error'] = "User not found.";
          }
     } else {
          $_SESSION['error'] = "Invalid request.";
     }
     redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
     exit();
}

delete_profile_image();
