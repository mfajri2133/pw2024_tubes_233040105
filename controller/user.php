<?php
include_once '../helpers/users.php';
include_once "../lib/general.php";
include_once "../lib/user.php";
session_start();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
          // Jika method yang digunakan adalah POST
     case 'POST':
          // mengecek action yang diambil
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
                    // Jika action yang diambil adalah delete
               case 'delete':
                    // Panggil fungsi delete_user
                    delete_user();
                    break;
               default:
                    redirect_to("user");
                    break;
          }
          break;
          // Jika method yang digunakan adalah GET
     case 'GET':
          // Panggil fungsi search_user
          search_user();
          break;
          // Jika method yang digunakan bukan POST
     default:
          // Redirect kembali ke halaman user
          $_SESSION['error'] = "Invalid request.";
          redirect_to("user");
          break;
}

// Fungsi delete_user
function delete_user()
{
     // Jika ada data id yang dikirim dari form
     if (isset($_POST['id'])) {
          // Simpan data id ke dalam variabel
          $id = $_POST['id'];
          // Panggil fungsi soft_destroy dan kirimkan id
          $result = soft_destroy($id);
          if ($result === true) {
               $_SESSION['success_message'] = "User deleted successfully.";
               redirect_to("user");
               exit();
          } else {
               $_SESSION['error'] = "User not found.";
               redirect_to("user");
               exit();
          }
     } else {
          $_SESSION['error'] = "User not found.";
     }
     redirect_to("user");
     exit();
}

function search_user()
{
     // Jika ada data search yang dikirim
     $search = isset($_GET['search']) ? $_GET['search'] : '';
     // Panggil fungsi fetchUsers dan kirimkan data search
     $users = fetchUsers($search);

     // Jika data ditemukan
     // Tampilkan data dalam format JSON
     header('Content-Type: application/json');
     echo json_encode($users);
}
