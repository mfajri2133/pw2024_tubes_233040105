<?php

include_once 'connection.php';
include_once 'general.php';


function update_user_profile($username, $name, $img_profile_path = null)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     try {
          // Jika tidak ada gambar profil yang diunggah
          if ($img_profile_path == null) {
               // SQL untuk mengupdate data user tanpa gambar profil
               $stmt = $conn->prepare("UPDATE users SET username = ?, name= ? WHERE id = ?");
               $stmt->bind_param("ssi", $username, $name, $_SESSION['user']['id']);
               // Jika ada gambar profil yang diunggah
          } else {
               // SQL untuk mengupdate data user dengan gambar profil
               $stmt = $conn->prepare("UPDATE users SET username = ?, name= ?, img_profile_path=? WHERE id = ?");
               $stmt->bind_param("sssi", $username, $name, $img_profile_path, $_SESSION['user']['id']);
          }
          // Mengeksekusi query
          $stmt->execute();
          // Menutup statement
          $stmt->close();

          // Mendapatkan data user berdasarkan id
          $user = get_user($_SESSION['user']['id']);
          // Mengupdate session user
          $_SESSION['user'] = $user;
          return true;

          // Mengembalikan pesan kesalahan jika terjadi kesalahan
     } catch (Exception $e) {
          return $e->getMessage();
     }
}

// Menghapus gambar profil
function remove_profile_image($user_id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     try {
          // SQL untuk menghapus path gambar profil
          $stmt = $conn->prepare("UPDATE users SET img_profile_path = NULL WHERE id = ?");
          // Mengikat parameter dan mengeksekusi query
          $stmt->bind_param("i", $user_id);
          $stmt->execute();
          $stmt->close();

          // Mendapatkan user berdasarkan id
          $user = get_user($user_id);
          // Mengupdate session user
          $_SESSION['user'] = $user;
          return true;

          // Mengembalikan pesan kesalahan jika terjadi kesalahan
     } catch (Exception $e) {
          return $e->getMessage();
     }
}

// Melakukan pergantian password

function update_user_password($user_id, $new_password)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Hash password baru
     $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

     // SQL untuk mengubah password user
     $sql = "UPDATE users SET password = ? WHERE id = ?";
     // Mengeksekusi query
     $stmt = $conn->prepare($sql);
     return $stmt->execute([$hashed_password, $user_id]);
}

// Verifikasi password lama untuk melakukan ganti password
function verify_old_password($user_id, $old_password)
{
     // mendapatkan user berdasarkan id
     $user = get_user($user_id);
     // membandingkan password lama dengan password yang ada di database
     return password_verify($old_password, $user['password']);
}
