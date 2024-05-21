<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
include_once '../lib/admin.php';
include_once '../mailer/preparation_mailer.php';
include_once '../mailer/add_admin_mailer.php';
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
          $action = isset($_GET['action']) ? $_GET['action'] : '';
          // Panggil fungsi search_admin

          switch ($action) {
               case 'search':
                    search_admin();
                    break;
               default:
                    redirect_to("admin");
                    break;
          }
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
     if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email'])) {
          $name = htmlspecialchars($_POST['name']);
          $email = htmlspecialchars($_POST['email']);
          $username = htmlspecialchars($_POST['username']);

          // Cek apakah username telah digunakan atau belum
          if (is_username_exists($username)) {
               $_SESSION['error'] = "This username is already registered.";
               redirect_to("admin");
               exit();
          }

          // Jika belum terdaftar panggil fungsi add_admin
          $result = add_admin($name, $username);
          // Cek apakah admin berhasil ditambahkan
          if ($result === true) {
               // Persiapan email
               $mail = send_email_prep($email, $name);

               if ($mail) {
                    // Menyiapkan konten HTML email
                    $mail->Body = add_admin_mailer($name, $username);

                    try {
                         // Kirim email
                         if ($mail->send()) {
                              $_SESSION['success_message'] = "Admin added successfully.";
                         } else {
                              $_SESSION['error'] = "Admin added failed to send email notification. Please try again.";
                         }
                    } catch (Exception $e) {
                         $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                    }
               } else {
                    $_SESSION['error'] = "Failed to prepare email.";
               }
               redirect_to("admin");
               exit();
          } else {
               $_SESSION['error'] = "Failed to add admin. Please try again.";
               redirect_to("admin");
               exit();
          }
     } else {
          $_SESSION['error'] = "Name and username are required.";
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
          $result = destroy($id);
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
     // Ambil data search jika ada
     $search = isset($_GET['search']) ? $_GET['search'] : '';
     // Panggil fungsi fetchAdmin dengan parameter search
     $users = fetchAdmin($search);

     // Set header response
     header('Content-Type: application/json');
     // Tampilkan data dalam format JSON
     echo json_encode($users);
}
