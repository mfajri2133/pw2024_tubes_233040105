<?php
include_once 'connection.php';
include_once 'general.php';

// Index admin dengan search
function fetchAdmin($search = '')
{
     global $conn;

     // Mengamankan input pencarian
     $search = mysqli_real_escape_string($conn, $search);

     // Query dasar untuk mendapatkan pengguna yang bukan admin dan aktif
     $sql = "SELECT * FROM users WHERE is_admin = 1 AND is_active = 1";

     // Menambahkan kondisi pencarian jika ada input pencarian
     if (!empty($search)) {
          $sql .= " AND (name LIKE '%$search%' OR username LIKE '%$search%')";
     }

     // Eksekusi query
     $result = mysqli_query($conn, $sql);

     // Mengumpulkan hasil query
     $users = [];
     if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $users[] = $row;
          }
     }

     return $users;
}


// fungsi untuk menambahkan admin dari dashboard admin
function add_admin($name, $username)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Default password
     $password = 'fwebAdmin123!';
     // Hash password
     $password_hash = password_hash($password, PASSWORD_DEFAULT);

     // SQL untuk menambahkan user admin
     $sql = "INSERT INTO users (name, username, password, is_admin, is_active, is_new) VALUES (?, ?, ?, 1, 1, 1)";

     // Mengeksekusi query
     if ($stmt = $conn->prepare($sql)) {
          // Mengikat parameter dan mengeksekusi query
          $stmt->bind_param("sss", $name, $username, $password_hash);
          if ($stmt->execute()) {
               $stmt->close();
               return true;
          } else {
               $stmt->close();
               return $stmt->error;
          }
     } else {
          return $conn->error;
     }
}
