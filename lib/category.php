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
