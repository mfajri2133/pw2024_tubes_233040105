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

// Mengapus dari list
function soft_destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "UPDATE users SET is_active = 0 WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     $success = mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);
     return $success;
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

// index user dengan search
function getUsers($search = '')
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
function getAdmin($search = '')
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

// Update profile user
function update_user_profile($email, $name, $img_profile_path = null)
{
     global $conn;

     try {
          if ($img_profile_path == null) {
               $stmt = $conn->prepare("UPDATE users SET email = ?,  name= ? WHERE id = ?");
               $stmt->bind_param("ssi", $email, $name, $_SESSION['user']['id']);
          } else {
               $stmt = $conn->prepare("UPDATE users SET email = ?,  name= ?, img_profile_path=? WHERE id = ?");
               $stmt->bind_param("sssi", $email, $name, $img_profile_path, $_SESSION['user']['id']);
          }
          $stmt->execute();

          $stmt->close();
          $user = get_user($_SESSION['user']['id']);
          $_SESSION['user'] = $user;

          return true;
     } catch (Exception $e) {
          return $e->getMessage();
     }
}


// Mendapatkan user berdasarkan id
function get_user($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     $result = mysqli_stmt_get_result($sql);
     $user = mysqli_fetch_assoc($result);
     mysqli_stmt_close($sql);
     return $user;
}

// Menghapus gambar profil
function remove_profile_image($user_id)
{
     global $conn;
     try {
          $stmt = $conn->prepare("UPDATE users SET img_profile_path = NULL WHERE id = ?");
          $stmt->bind_param("i", $user_id);
          $stmt->execute();
          $stmt->close();

          $user = get_user($user_id);
          $_SESSION['user'] = $user;

          return true;
     } catch (Exception $e) {
          return $e->getMessage();
     }
}




// Verifikasi password lama untuk melakukan ganti password
function verify_old_password($user_id, $old_password)
{
     $user = get_user($user_id);

     return password_verify($old_password, $user['password']);
}

// Melakukan pergantian password
function update_user_password($user_id, $new_password)
{
     global $conn;

     $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);


     $sql = "UPDATE users SET password = ? WHERE id = ?";
     $stmt = $conn->prepare($sql);
     return $stmt->execute([$hashed_password, $user_id]);
}




// soft_destroy(2);
// update(3, "Admin Sujono Ganteng", "jono@admin.com", "123123");
// index_admin();