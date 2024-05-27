<?php
include_once 'connection.php';
include_once 'general.php';

// Fungsi untuk mengambil kategori / index
function fetchMovies($search = '')
{
     global $conn;

     // Mengamankan input pencarian
     $search = mysqli_real_escape_string($conn, $search);

     // Dasar query untuk mengambil kategori
     $sql = "SELECT * FROM movies";

     // Menambahkan kondisi pencarian jika ada input pencarian
     if (!empty($search)) {
          $sql .= " WHERE name LIKE '%$search%'";
     }

     // Eksekusi query
     $result = mysqli_query($conn, $sql);

     // Mengumpulkan hasil query
     $movies = [];
     if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
               $movies[] = $row;
          }
     }

     return $movies;
}

function saveMovieWithoutPoster($name, $duration, $release_date, $director, $producer, $description, $trailer_url)
{
     global $conn;
     $query = "INSERT INTO movies (name, duration, release_date, director, producer, description, trailer_url) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('sssssss', $name, $duration, $release_date, $director, $producer, $description, $trailer_url);

     if ($stmt->execute()) {
          return $stmt->insert_id; // Mengembalikan ID film yang baru disimpan
     } else {
          return false;
     }
}

function saveMovieCategory($movie_id, $category_id)
{
     global $conn;
     $query = "INSERT INTO movie_categories (movie_id, category_id) VALUES (?, ?)";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('ii', $movie_id, $category_id);

     return $stmt->execute();
}

function updateMovieWithPoster($movie_id, $poster_path)
{
     global $conn;
     $query = "UPDATE movies SET poster_path = ? WHERE id = ?";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('si', $poster_path, $movie_id);

     return $stmt->execute();
}

function destroy_movie($id)
{
     global $conn;

     // // Hapus relasi movie_categories terlebih dahulu
     // $query_delete_categories = "DELETE FROM movie_categories WHERE movie_id = ?";
     // $stmt_delete_categories = $conn->prepare($query_delete_categories);
     // $stmt_delete_categories->bind_param('i', $id);
     // $result_delete_categories = $stmt_delete_categories->execute();

     $result_delete_categories = deleteMovieCategories($id);

     // Hapus film setelah menghapus relasinya
     if ($result_delete_categories) {
          $query_delete_movie = "DELETE FROM movies WHERE id = ?";
          $stmt_delete_movie = $conn->prepare($query_delete_movie);
          $stmt_delete_movie->bind_param('i', $id);
          $result_delete_movie = $stmt_delete_movie->execute();

          return $result_delete_movie;
     } else {
          return false;
     }
}

function get_movie_poster($id)
{
     global $conn;
     $sql = "SELECT poster_path FROM movies WHERE id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('i', $id);
     $stmt->execute();
     $result = $stmt->get_result();
     if ($row = $result->fetch_assoc()) {
          return $row['poster_path'];
     }
     return false;
}

function updateMovie($id, $name, $duration, $release_date, $director, $producer, $description, $poster_path, $trailer_url)
{
     global $conn;
     $sql = "UPDATE movies SET name=?, duration=?, release_date=?, director=?, producer=?, description=?, poster_path=?, trailer_url=? WHERE id=?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('sissssssi', $name, $duration, $release_date, $director, $producer, $description, $poster_path, $trailer_url, $id);
     return $stmt->execute();
}

function deleteMovieCategories($id)
{
     global $conn;
     $sql = "DELETE FROM movie_categories WHERE movie_id=?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('i', $id);
     return $stmt->execute();
}

if (!function_exists('fetchMovieCategoryIds')) {
     function fetchMovieCategoryIds($movieId)
     {
          global $conn;
          $sql = "SELECT category_id FROM movie_categories WHERE movie_id = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $movieId);
          $stmt->execute();
          $result = $stmt->get_result();
          $categoryIds = [];
          while ($row = $result->fetch_assoc()) {
               $categoryIds[] = $row['category_id'];
          }
          return $categoryIds;
     }
}
