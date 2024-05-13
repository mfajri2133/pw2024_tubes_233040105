<?php
include_once '../helpers/users.php';
include_once '../lib/user.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = $_POST['email'];
     $name = $_POST['name'];

     // Periksa apakah file foto profil diupload
     if (isset($_FILES['img_profile_path']) && $_FILES['img_profile_path']['error'] === UPLOAD_ERR_OK) {
          $upload_dir = "../uploads/";
          $file_name = basename($_FILES["img_profile_path"]["name"]);
          $target_file = $upload_dir . $file_name;

          // Periksa ekstensi dan ukuran file
          $allowed_extensions = array('jpg', 'jpeg', 'png');
          $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          $file_size = $_FILES["img_profile_path"]["size"];

          if (in_array($file_extension, $allowed_extensions) && $file_size <= 5 * 1024 * 1024) {
               // Pindahkan file yang diupload ke direktori upload
               if (move_uploaded_file($_FILES["img_profile_path"]["tmp_name"], $target_file)) {
                    // Panggil fungsi untuk menyimpan data ke database
                    $result = update_user_profile($email, $name, $target_file);
                    if ($result === true) {
                         // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
                         $_SESSION['success_message'] = "Profil berhasil diperbarui.";
                         redirect_to("dashboard"); // Redirect ke halaman dashboard atau halaman lainnya
                         exit();
                    } else {
                         $_SESSION['error'] = "Gagal menyimpan profil. Silakan coba lagi 09.";
                         redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
                         exit();
                    }
               } else {
                    $_SESSION['error'] = "Gagal mengunggah file. Silakan coba lagi.";
                    redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
                    exit();
               }
          } else {
               $_SESSION['error'] = "Format file tidak didukung atau ukuran file terlalu besar.";
               redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
               exit();
          }
     } else {
          // Jika file foto profil tidak diupload, lanjutkan tanpa menyimpan path foto profil
          $result = update_user_profile($email, $name, null);
          if ($result === true) {
               // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
               $_SESSION['success_message'] = "Profil berhasil diperbarui.";
               redirect_to("dashboard"); // Redirect ke halaman dashboard atau halaman lainnya
               exit();
          } else {
               $_SESSION['error'] = "Gagal menyimpan profil. Silakan coba lagi00.";
               redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
               exit();
          }
     }
} else {
     $_SESSION['error'] = "Permintaan tidak valid.";
     redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
     exit();
}
