<?php
include_once 'connection.php';
include_once 'general.php';

// index user dengan search
function fetchUsers($search = '')
{
     global $conn;

     // Mengamankan input pencarian
     $search = mysqli_real_escape_string($conn, $search);

     // Query dasar untuk mendapatkan pengguna yang bukan admin dan aktif
     $sql = "SELECT * FROM users WHERE is_admin = 0 AND is_active = 1";

     // Menambahkan kondisi pencarian jika ada input pencarian
     if (!empty($search)) {
          $sql .= " AND (name LIKE '%$search%' OR username LIKE '%$search%')";
     }

     // Eksekusi query
     $result = mysqli_query($conn, $sql);
     $users = [];

     // Mengumpulkan hasil query
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $users[] = $row;
          }
     }

     return $users;
}
