<?php
include_once '../lib/general.php';
include_once '../helpers/users.php';
include_once '../helpers/add_admin_mailer.php';
session_start();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
          // Jika method yang digunakan adalah POST
     case 'POST':
          // mengecek action yang diambil
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
                    // Jika action yang diambil adalah create
               case 'create':
                    // Panggil fungsi create_admin
                    create_admin();
                    break;
                    // Jika action yang diambil adalah delete
               case 'delete':
                    // Panggil fungsi delete_admin
                    delete_admin();
                    break;
               default:
                    redirect_to("admin");
                    break;
          }
          break;
          // Jika method yang digunakan adalah GET
     case 'GET':
          // Panggil fungsi search_admin
          search_admin();
          break;
          // Jika method yang digunakan bukan POST atau GET
     default:
          // Tampilkan pesan error
          $_SESSION['error'] = "Invalid request.";
          redirect_to("admin");
          break;
}

// Fungsi untuk menambahkan admin
function create_admin()
{
     // Wadah untuk menyimpan data yang dikirimkan
     if (isset($_POST['name']) && isset($_POST['email'])) {
          $name = $_POST['name'];
          $email = $_POST['email'];

          // Cek apakah email sudah terdaftar
          if (is_email_exists($email)) {
               $_SESSION['error'] = "This email is already registered.";
               redirect_to("admin");
               exit();
          }

          // Jika belum terdaftar panggil fungsi add_admin_user
          $result = add_admin_user($name, $email);
          // Cek apakah admin berhasil ditambahkan
          if ($result === true) {
               // Jika berhasil maka kirim email notifikasi
               send_email_notification($email, $name);
               // Dan tampilkan pesan sukses
               $_SESSION['success_message'] = "Admin added successfully.";
               redirect_to("admin");
               exit();
          } else {
               $_SESSION['error'] = "Failed to add admin. Please try again.";
               redirect_to("admin");
               exit();
          }
     } else {
          $_SESSION['error'] = "Name and email are required.";
     }
     redirect_to("admin");
     exit();
}

// Fungsi untuk menghapus admin dengan soft delete
function delete_admin()
{
     // Jika ada data id yang dikirim dari form
     if (isset($_POST['id'])) {
          // Simpan data id ke dalam variabel
          $id = $_POST['id'];
          // Panggil fungsi soft_destroy dan kirimkan id
          $result = soft_destroy($id);
          // Cek apakah admin berhasil dihapus
          if ($result === true) {
               $_SESSION['success_message'] = "Admin deleted successfully.";
               redirect_to("admin");
               exit();
          } else {
               $_SESSION['error'] = "Admin not found.";
               redirect_to("admin");
               exit();
          }
     } else {
          $_SESSION['error'] = "Admin not found.";
     }
     redirect_to("admin");
     exit();
}

function search_admin()
{
     $search = isset($_GET['search']) ? $_GET['search'] : '';
     $users = fetchAdmin($search);

     header('Content-Type: application/json');
     echo json_encode($users);
}
