<?php
include_once '../helpers/users.php';
include_once '../lib/user.php';
session_start();

function change_password()
{
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $old_password = $_POST['password'];
          $new_password = $_POST['new_password'];
          $confirm_password = $_POST['confirm_password'];

          // Verifikasi password baru dan konfirmasi password
          if ($new_password !== $confirm_password) {
               $_SESSION['error'] = "Konfirmasi password tidak cocok.";
               redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
               exit();
          }

          // Verifikasi password lama
          $user_id = $_SESSION['user']['id'];
          if (!verify_old_password($user_id, $old_password)) {
               $_SESSION['error'] = "Password lama tidak valid.";
               redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
               exit();
          }

          // Validasi password baru
          if (strlen($new_password) < 6) {
               $_SESSION['error'] = "Password harus memiliki panjang minimal 6 karakter.";
               redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
               exit();
          }

          // Update password baru
          $result = update_user_password($user_id, $new_password);
          if ($result === true) {
               $_SESSION['success_message'] = "Password berhasil diperbarui.";
               redirect_to("profile");
               exit();
          } else {
               $_SESSION['error'] = "Gagal memperbarui password. Silakan coba lagi.";
               redirect_to("profile");
               exit();
          }
     } else {
          $_SESSION['error'] = "Permintaan tidak valid.";
          redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
          exit();
     }
}

change_password();