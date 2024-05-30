<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
include_once '../lib/profile.php';
session_start();


// pengecekan method yang dipakai dalam pengiriman form
switch ($_SERVER['REQUEST_METHOD']) {
          // jika method yang digunakan adalah POST maka jalankan
     case 'POST':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'update':
                    update_profile();
                    break;
               case 'change_password':
                    change_password();
                    break;
               case 'delete_profile_img':
                    delete_profile_image();
                    break;
               default:
                    redirect_to("category");
                    break;
          }
          break;
          // jika method yang digunakan bukan POST maka redirect ke halaman profile dan tidak menjalankan fungsi apapun
     default:
          $_SESSION['error'] = "Invalid request.";
          redirect_to_profile();
          break;
}

// Fungsi untuk mengupdate profil pengguna
function update_profile()
{
     // Jika data username dan nama dikirimkan melalui form
     if (isset($_POST['username']) && isset($_POST['name'])) {
          // Ambil data yang dikirimkan melalui form
          $username = htmlspecialchars($_POST['username']);
          $name = htmlspecialchars($_POST['name']);

          // Periksa apakah file foto profil diupload atau tidak
          if (isset($_FILES['img_profile_path']) && $_FILES['img_profile_path']['error'] === UPLOAD_ERR_OK) {
               // Jika file foto profil diupload, jalankan fungsi upload_img()
               upload_img($username, $name);
          } else {
               // Jika file foto profil tidak diupload, lanjutkan tanpa menyimpan path foto profil
               $result = update_user_profile($username, $name);
               if ($result === true) {
                    // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
                    $_SESSION['success_message'] = "Profile successfully changed.";
                    redirect_to_profile(); // Redirect ke halaman dashboard atau halaman lainnya
                    exit();
               } else {
                    $_SESSION['error'] = "username is already in use.";
                    redirect_to_profile(); // Redirect kembali ke halaman pengeditan profil
                    exit();
               }
          }
     } else {
          $_SESSION['error'] = "Invalid request.";
          redirect_to_profile(); // Redirect kembali ke halaman pengeditan profil
          exit();
     }
}

// Fungsi untuk mengupload gambar profil
function upload_img($username, $name)
{
     // Direktori penyimpanan file
     $upload_dir = "/uploads/profile-pict/" . $_SESSION['user']['id'] . '/';

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
               $result = update_user_profile($username, $name, $real_file_name);
               if ($result === true) {
                    // Jika penyimpanan berhasil, lakukan tindakan selanjutnya
                    $_SESSION['success_message'] = "Profile successfully changed.";
                    redirect_to_profile();
                    exit();
               } else {
                    $_SESSION['error'] = "Failed to save profile. Please try again.";
                    redirect_to_profile();
                    exit();
               }
          } else {
               $_SESSION['error'] = "Failed to upload file. Please try again.";
               redirect_to_profile();
               exit();
          }
     } else {
          $_SESSION['error'] = "File size too large.";
          redirect_to_profile();
          exit();
     }
}

// Fungsi untuk mengganti password
function change_password()
{
     // Jika data password lama, password baru, dan konfirmasi password dikirimkan melalui form
     if (isset($_POST['password']) && isset($_POST['new_password'])) {
          // Ambil data yang dikirimkan melalui form
          $old_password = htmlspecialchars($_POST['password']);
          $new_password = htmlspecialchars($_POST['new_password']);

          // Periksa apakah password lama benar
          $user_id = $_SESSION['user']['id'];
          if (!verify_old_password($user_id, $old_password)) {
               // Jika password lama salah, tampilkan pesan error
               $_SESSION['error'] = "Invalid old password.";
               redirect_to_profile(); // Redirect kembali ke halaman pengeditan profil
               exit();
          }

          // Update password baru
          $result = update_user_password($user_id, $new_password);
          if ($result === true) {
               $_SESSION['success_message'] = "Password changed successfully.";
               redirect_to_profile();
               exit();
          } else {
               $_SESSION['error'] = "Failed to change password. please try again.";
               redirect_to_profile();
               exit();
          }
     } else {
          $_SESSION['error'] = "Invalid request.";
     }
     redirect_to_profile(); // Redirect kembali ke halaman pengeditan profil
     exit();
}

// Fungsi untuk menghapus foto profil
function delete_profile_image()
{
     // Jika data id pengguna dikirimkan melalui form
     if (isset($_POST['id'])) {
          // Ambil data pengguna berdasarkan id
          $user_id = $_POST['id'];
          $user = get_user($user_id);

          // Jika pengguna ditemukan
          if ($user) {
               $upload_dir = "../uploads/profile-pict/" . $user_id . "/";
               $allowed_extensions = array('jpg', 'jpeg', 'png');
               // Lakukan pengecekan direction dan hapus file foto profil {profile.jpg, profile.jpeg, profile.png}
               foreach ($allowed_extensions as $ext) {
                    $file = $upload_dir . 'profile.' . $ext;
                    // Jika file ada, hapus file
                    if (file_exists($file)) {
                         unlink($file);
                    }
               }

               // Panggil fungsi untuk menghapus path foto profil dari database
               $result = remove_profile_image($user_id);

               if ($result === true) {
                    $_SESSION['success_message'] = "Profile image deleted successfully.";
                    redirect_to_profile();
                    exit();
               } else {
                    $_SESSION['error'] = "Failed to delete profile image from the database.";
                    redirect_to_profile();
                    exit();
               }
          } else {
               $_SESSION['error'] = "User not found.";
          }
          redirect_to_profile();
          exit();
     }
}
