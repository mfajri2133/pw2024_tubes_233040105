<?php
include_once 'connection.php';

// Lib CRUD
// Lib C (Create)
// fungsi untuk register user dihalaman register
function add_user($name, $email, $password)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Hash password
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     // Membuat query untuk menambahkan user
     $stmt = $conn->prepare("INSERT INTO users (name, email, password, is_active, is_admin) VALUES (?, ?, ?, 1, 0)");
     // Mengikat parameter dan mengeksekusi query
     $stmt->bind_param("sss", $name, $email, $hashed_password);
     if ($stmt->execute()) {
          $stmt->close();
          return true;
     } else {
          $stmt->close();
          return false;
     }
}

// Lib D (Delete)
function destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);

     return true;
}

// Fungsi mengapus user/admin dari list dengan cara soft delete
function soft_destroy($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;
     // SQL untuk mengubah status user menjadi tidak aktif
     $sql = mysqli_prepare($conn, "UPDATE users SET is_active = 0 WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     $result = mysqli_stmt_execute($sql);
     // Menutup statement
     mysqli_stmt_close($sql);
     // Mengembalikan status berhasil atau tidak
     return $result;
}

// Lib helper
// Mendapatkan user berdasarkan id
function get_user($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;
     // SQL untuk mendapatkan user berdasarkan id
     $sql = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     $result = mysqli_stmt_get_result($sql);
     // Mengambil data user
     $user = mysqli_fetch_assoc($result);
     // Menutup statement
     mysqli_stmt_close($sql);
     // Mengembalikan data user
     return $user;
}

// Fungsi untuk mengecek apakah user adalah admin
function check_is_admin($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // SQL untuk mendapatkan status admin user
     $sql = mysqli_prepare($conn, "SELECT is_admin FROM users WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_bind_result($sql, $is_admin);
     mysqli_stmt_fetch($sql);
     mysqli_stmt_close($sql);
     return $is_admin == 1;
}

// fungsi untuk mencari email yang sudah terdaftar
function is_email_exists($email)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Mencari email yang cocok
     try {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $stmt->bind_result($count);
          $stmt->fetch();
          $stmt->close();

          // Jika jumlah baris dengan email yang cocok lebih dari 0, email sudah terdaftar
          return $count > 0;
     } catch (Exception $e) {
          // Jika terjadi kesalahan, tangani di sini (misalnya, log kesalahan atau tampilkan pesan kesalahan)
          return false;
     }
}
