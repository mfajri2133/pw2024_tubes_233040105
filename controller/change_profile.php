<?php
include_once '../helpers/users.php';
include_once '../lib/user.php';
session_start();

function update_profile()
{

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $email = $_POST['email'];
          $name = $_POST['name'];

          // Periksa apakah file foto profil diupload
          if (isset($_FILES['img_profile_path']) && $_FILES['img_profile_path']['error'] === UPLOAD_ERR_OK) {
               upload_img($email, $name);
          } else {
               // Jika file foto profil tidak diupload, lanjutkan tanpa menyimpan path foto profil
               $result = update_user_profile($email, $name);
               if ($result === true) {
                    // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
                    $_SESSION['success_message'] = "Profil berhasil diperbarui.";
                    redirect_to("profile"); // Redirect ke halaman dashboard atau halaman lainnya
                    exit();
               } else {
                    $_SESSION['error'] = "Email sudah digunakan.";
                    redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
                    exit();
               }
          }
     } else {
          $_SESSION['error'] = "Permintaan tidak valid.";
          redirect_to("profile"); // Redirect kembali ke halaman pengeditan profil
          exit();
     }
}

function upload_img($email, $name)
{
     $upload_dir = "/uploads/" . $_SESSION['user']['id'] . '/';

     // Buat direktori jika belum ada
     if (!is_dir('..' . $upload_dir)) {
          mkdir('..' . $upload_dir, 0775, true);
     }

     // Ambil nama file dan ekstensi
     $file_name = basename($_FILES["img_profile_path"]["name"]);
     $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
     $file_size = $_FILES["img_profile_path"]["size"];

     // Format nama file yang disimpan
     $real_file_name = $upload_dir . 'profile.' . $file_extension;

     // Ekstensi dan ukuran file yang diperbolehkan
     $allowed_extensions = array('jpg', 'jpeg', 'png');

     if (in_array($file_extension, $allowed_extensions) && $file_size <= 5 * 1024 * 1024) {
          // Hapus file lama dengan nama yang sama namun ekstensi berbeda
          foreach ($allowed_extensions as $ext) {
               $old_file = $upload_dir . 'profile.' . $ext;
               if (file_exists('..' . $old_file) && $ext !== $file_extension) {
                    unlink('..' . $old_file);
               }
          }

          // Pindahkan file yang diupload ke direktori upload
          if (move_uploaded_file($_FILES["img_profile_path"]["tmp_name"], '..' . $real_file_name)) {
               // Panggil fungsi untuk menyimpan data ke database
               $result = update_user_profile($email, $name, $real_file_name);
               if ($result === true) {
                    // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
                    $_SESSION['success_message'] = "Profil berhasil diperbarui.";
                    redirect_to("profile");
                    exit();
               } else {
                    $_SESSION['error'] = "Gagal menyimpan profil. Silakan coba lagi.";
                    redirect_to("profile");
                    exit();
               }
          } else {
               $_SESSION['error'] = "Gagal mengunggah file. Silakan coba lagi.";
               redirect_to("profile");
               exit();
          }
     } else {
          $_SESSION['error'] = "Ukuran file terlalu besar.";
          redirect_to("profile");
          exit();
     }
}


update_profile();
