<?php
include_once 'connection.php';
include_once 'general.php';

// Fungsi untuk mengambil kategori / index
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

     $sql .= " ORDER BY name ASC";

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

// Fungsi untuk menghapus kategori
function destroy_category($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     $result_delete_categories = destroy_movie_categories($id);

     if ($result_delete_categories) {
          // SQL untuk menghapus kategori
          $sql = "DELETE FROM categories WHERE id = ?";
          // Mengikat parameter dan mengekusi query
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $id);
          $result = $stmt->execute();
          // Menutup statement
          $stmt->close();
          // Mengembalikan status berhasil atau tidak
          return $result;
     } else {
          return false;
     }
}

function destroy_movie_categories($id)
{
     global $conn;

     $sql = "DELETE FROM movie_categories WHERE category_id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('i', $id);
     return $stmt->execute();
}
