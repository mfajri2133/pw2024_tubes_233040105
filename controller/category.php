<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
include_once '../lib/category.php';
start_session();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
     case 'POST':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'create':
                    create_category();
                    break;
               case 'update':
                    update_category();
                    break;
               case 'delete':
                    delete_category();
                    break;
               default:
                    redirect_to("category");
                    break;
          }
          break;
     case 'GET':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'search':
                    search_category();
                    break;
               default:
                    redirect_to("category");
                    break;
          }
          break;

     default:
          $_SESSION['error'] = "Invalid request.";
          redirect_to("category");
          break;
}


function create_category()
{
     // Jika ada data nama yang dikirim
     if (isset($_POST['name'])) {
          $name = $_POST['name'];
          // Panggil fungsi add_category
          $result = add_category($name);
          // Jika hasilnya true
          if ($result === true) {
               // Dan tampilkan pesan sukses
               $_SESSION['success_message'] = "Category added successfully.";
               redirect_to("category");
               exit();
          } else {
               $_SESSION['error'] = "Failed to add category. Please try again.";
               redirect_to("category");
               exit();
          }
     } else {
          $_SESSION['error'] = "Category name is required.";
     }
     redirect_to("category");
     exit();
}

function update_category()
{
     // Jika data id dan nama dikirimkan melalui form
     if (isset($_POST['id']) && isset($_POST['name'])) {
          // Ambil data yang dikirimkan melalui form
          $id = $_POST['id'];
          $name = $_POST['name'];
          // Panggil fungsi change_category
          $result = change_category($id, $name);
          // Jika hasilnya true
          if ($result === true) {
               // Dan tampilkan pesan sukses
               $_SESSION['success_message'] = "Category updated successfully.";
               redirect_to("category");
               exit();
               // Jika tidak
          } else {
               // Tampilkan pesan error
               $_SESSION['error'] = "Category not found.";
               redirect_to("category");
               exit();
          }
          // Jika data id tidak dikirim
     } else {
          $_SESSION['error'] = "Category not found.";
     }
     redirect_to("category");
     exit();
}

function delete_category()
{
     if (isset($_POST['id'])) {
          $id = $_POST['id'];
          $result = destroy_category($id);
          if ($result === true) {
               $_SESSION['success_message'] = "Category deleted successfully.";
               redirect_to("category");
               exit();
          } else {
               $_SESSION['error'] = "Category not found.";
               redirect_to("category");
               exit();
          }
     } else {
          $_SESSION['error'] = "category not found.";
     }
     redirect_to("category");
     exit();
}

function search_category()
{
     // Jika ada data search yang dikirim
     $search = isset($_GET['search']) ? $_GET['search'] : '';
     // Panggil fungsi fetchCategories dengan parameter search
     $categories = fetchCategories($search);

     // Set header response
     header('Content-Type: application/json');
     // Tampilkan data dalam format JSON
     echo json_encode($categories);
}
