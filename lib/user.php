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

// fungsi untuk menambahkan admin dari dashboard admin
function add_admin_user($name, $email)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Default password
     $password = 'fwebAdmin123!';
     // Hash password
     $password_hash = password_hash($password, PASSWORD_DEFAULT);

     // SQL untuk menambahkan user admin
     $sql = "INSERT INTO users (name, email, password, is_admin, is_active) VALUES (?, ?, ?, 1, 1)";

     // Mengeksekusi query
     if ($stmt = $conn->prepare($sql)) {
          // Mengikat parameter dan mengeksekusi query
          $stmt->bind_param("sss", $name, $email, $password_hash);
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

// Fungsi untuk menambahkan kategori
function add_category($name)
{
     global $conn;
     $sql = "INSERT INTO categories (name) VALUES (?)";
     if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("s", $name);
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

// Lib U (Update)
// Update profile user
function update_user_profile($email, $name, $img_profile_path = null)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     try {
          // Jika tidak ada gambar profil yang diunggah
          if ($img_profile_path == null) {
               // SQL untuk mengupdate data user tanpa gambar profil
               $stmt = $conn->prepare("UPDATE users SET email = ?, name= ? WHERE id = ?");
               $stmt->bind_param("ssi", $email, $name, $_SESSION['user']['id']);
               // Jika ada gambar profil yang diunggah
          } else {
               // SQL untuk mengupdate data user dengan gambar profil
               $stmt = $conn->prepare("UPDATE users SET email = ?, name= ?, img_profile_path=? WHERE id = ?");
               $stmt->bind_param("sssi", $email, $name, $img_profile_path, $_SESSION['user']['id']);
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

// Update kategori
function change_category($id, $name)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // SQL untuk mengupdate kategori
     $sql = "UPDATE categories SET name = ? WHERE id = ?";
     // Mengikat parameter dan mengeksekusi query
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('si', $name, $id);

     $result = $stmt->execute();
     // Menutup statement
     $stmt->close();

     return $result;
}

// Lib D (Delete)
function destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
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
function destroy_category($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;
     // SQL untuk menghapus kategori
     $sql = mysqli_prepare($conn, "DELETE FROM categories WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     $result = mysqli_stmt_execute($sql);
     // Menutup statement
     mysqli_stmt_close($sql);
     // Mengembalikan status berhasil atau tidak
     return $result;
}

// lib fetch
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
          $sql .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
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
          $sql .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
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

function fetchCategories($search = '')
{
     global $conn;

     // Mengamankan input pencarian
     $search = mysqli_real_escape_string($conn, $search);

     // Dasar query untuk mengambil kategori
     $sql = "SELECT * FROM categories";

     // Menambahkan kondisi pencarian jika ada input pencarian
     if (!empty($search)) {
          $sql .= " WHERE name LIKE '%$search%'";
     }

     // Eksekusi query
     $result = mysqli_query($conn, $sql);

     // Mengumpulkan hasil query
     $categories = [];
     if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $categories[] = $row;
          }
     }

     return $categories;
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

// Verifikasi password lama untuk melakukan ganti password
function verify_old_password($user_id, $old_password)
{
     // mendapatkan user berdasarkan id
     $user = get_user($user_id);
     // membandingkan password lama dengan password yang ada di database
     return password_verify($old_password, $user['password']);
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
