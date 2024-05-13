<?php

include_once 'connection.php';

function store($name, $email, $password, $is_admin = 0, $is_active = 1)
{
     global $conn;
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     $sql = mysqli_prepare($conn, "INSERT INTO users (name, email, password, is_admin, is_active) VALUES (?, ?, ?, ?, ?)");
     mysqli_stmt_bind_param($sql, "sssii", $name, $email, $hashed_password, $is_admin, $is_active);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
}

function store_admin($name, $email, $password, $is_admin = 1, $is_active = 1)
{
     global $conn;
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     $sql = mysqli_prepare($conn, "INSERT INTO users (name, email, password, is_admin, is_active) VALUES (?, ?, ?, ?, ?)");
     mysqli_stmt_bind_param($sql, "sssii", $name, $email, $hashed_password, $is_admin, $is_active);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
}


function destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
}

function soft_destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "UPDATE users SET is_active = 0 WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
}

function check_is_admin($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "SELECT is_admin FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_bind_result($sql, $is_admin);
     mysqli_stmt_fetch($sql);
     mysqli_stmt_close($sql);
     return $is_admin == 1;
}

function update($id, $name, $email, $password, $is_admin = 0, $is_active = 1)
{
     global $conn;
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     $current_admin_status = check_is_admin($id);
     if ($current_admin_status && $is_admin == 0) {
          $is_admin = 1;
     }
     $sql = mysqli_prepare($conn, "UPDATE users SET name = ?, email = ?, password = ?, is_admin = ?, is_active = ? WHERE id = ?");
     mysqli_stmt_bind_param($sql, "sssiii", $name, $email, $hashed_password, $is_admin, $is_active, $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
}

function index()
{
     global $conn;
     $sql = "SELECT * FROM users WHERE is_admin = 0 AND is_active = 1";
     $result = mysqli_query($conn, $sql);
     $users = [];
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $users[] = $row;
          }
     }
     return $users;
}

function index_admin()
{
     global $conn;
     $sql = "SELECT * FROM users WHERE is_admin = 1 AND is_active = 1";
     $result = mysqli_query($conn, $sql);
     $users = [];
     if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $users[] = $row;
          }
     }
     return $users;
}

function update_user_profile($email, $name, $img_profile_path)
{
     global $conn; // Variabel koneksi database dari file db.php

     try {
          // SQL statement untuk memasukkan data pengguna ke dalam tabel user_profiles
          $stmt = $conn->prepare("INSERT INTO users (email, name, img_profile_path) VALUES (?, ?, ?)");
          $stmt->bind_param("sss", $email, $name, $img_profile_path);

          // Eksekusi statement SQL
          $stmt->execute();

          // Tutup statement
          $stmt->close();

          // Mengembalikan true jika proses insert berhasil
          return true;
     } catch (Exception $e) {
          // Mengembalikan pesan error jika terjadi kesalahan
          return $e->getMessage();
     }
}

// soft_destroy(2);
// update(2, "Jhone", "jhone@example.com", "123123");
// index_admin();
