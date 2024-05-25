<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
include_once '../lib/movie.php';
start_session();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
     case 'POST':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'create':
                    create_movie();
                    break;
               case 'update':
                    update_movie();
                    break;
               case 'delete':
                    delete_movie();
                    break;
               default:
                    redirect_to("movie");
                    break;
          }
          break;
     case 'GET':
          $action = isset($_GET['action']) ? $_GET['action'] : '';

          switch ($action) {
               case 'search':
                    search_movie();
                    break;
               default:
                    redirect_to("movie");
                    break;
          }
          break;

     default:
          $_SESSION['error'] = "Invalid request.";
          redirect_to("movie");
          break;
}


function create_movie()
{
     // Ambil data dari form
     $name = $_POST['name'];
     $duration = $_POST['duration'];
     $release_date = $_POST['release_date'];
     $director = $_POST['director'];
     $producer = $_POST['producer'];
     $description = $_POST['description'];

     $release_date = date('Y-m-d', strtotime($release_date));
     // Simpan data ke database tanpa poster untuk mendapatkan ID film
     $movie_id = saveMovieWithoutPoster($name, $duration, $release_date, $director, $producer, $description);

     if ($movie_id === false) {
          $_SESSION['error'] = "Failed to create movie.";
          redirect_to("movie");
          exit();
     }

     if (isset($_POST['categories']) && is_array($_POST['categories'])) {
          foreach ($_POST['categories'] as $category_id) {
               // Simpan kategori untuk setiap id film
               saveMovieCategory($movie_id, $category_id);
          }
     }

     // Proses upload poster menggunakan ID film
     $poster_path = uploadPoster($movie_id);

     if ($poster_path === false) {
          $_SESSION['error'] = "Failed to upload poster.";
          redirect_to("movie");
          exit();
     }

     // Perbarui data film dengan path poster
     $result = updateMovieWithPoster($movie_id, $poster_path);

     if ($result) {
          $_SESSION['success_message'] = "Movie successfully created.";
          redirect_to("movie");
          exit();
     } else {
          $_SESSION['error'] = "Failed to update movie with poster.";
          redirect_to("movie");
          exit();
     }
}


function update_movie()
{
     if (isset($_POST['id'])) {
          $id = $_POST['id'];
          $name = $_POST['name'];
          $duration = $_POST['duration'];
          $release_date = $_POST['release_date'];
          $director = $_POST['director'];
          $producer = $_POST['producer'];
          $description = $_POST['description'];

          $release_date = date('Y-m-d', strtotime($release_date));

          // Fetch current poster path
          $poster_path = get_movie_poster($id);

          // Check if a new poster is uploaded
          if (isset($_FILES['poster_path']) && $_FILES['poster_path']['error'] === 0) {
               $new_poster_path = uploadPoster($id);
               if ($new_poster_path === false) {
                    $_SESSION['error'] = "Failed to upload poster.";
                    redirect_to("movie");
                    exit();
               }
               $poster_path = $new_poster_path; // Update poster path if new poster uploaded
          }

          // Update movie details
          $result = updateMovie($id, $name, $duration, $release_date, $director, $producer, $description, $poster_path);

          // Update categories
          if (isset($_POST['categories']) && is_array($_POST['categories'])) {
               // Remove existing categories
               deleteMovieCategories($id);

               // Add new categories
               foreach ($_POST['categories'] as $category_id) {
                    saveMovieCategory($id, $category_id);
               }
          }

          if ($result === true) {
               $_SESSION['success_message'] = "Movie updated successfully.";
               redirect_to("movie");
               exit();
          } else {
               $_SESSION['error'] = "Failed to update movie.";
          }
     }
     redirect_to("movie");
     exit();
}


function uploadPoster($movie_id)
{
     $upload_dir = "/uploads/movie-posters/" . $movie_id . "/";
     if (!is_dir('..' . $upload_dir)) {
          mkdir('..' . $upload_dir, 0775, true);
     }

     $file_name = basename($_FILES["poster_path"]["name"]);
     $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
     $file_size = $_FILES["poster_path"]["size"];

     $allowed_extensions = array('jpg', 'jpeg', 'png');

     if (in_array($file_extension, $allowed_extensions) && $file_size <= 5 * 1024 * 1024) {
          $real_file_name = $upload_dir . 'poster.' . $file_extension;

          // Hapus file lama dengan nama yang sama namun ekstensi berbeda
          foreach ($allowed_extensions as $ext) {
               if ($ext !== $file_extension) {
                    $old_file = $upload_dir . 'poster.' . $ext;
                    if (file_exists('..' . $old_file)) {
                         unlink('..' . $old_file);
                    }
               }
          }

          if (move_uploaded_file($_FILES["poster_path"]["tmp_name"], '..' . $real_file_name)) {
               return $real_file_name;
          }
     }
     return false;
}




function delete_movie()
{
     if (isset($_POST['id'])) {
          $id = $_POST['id'];
          $result = destroy_movie($id);
          if ($result === true) {
               $_SESSION['success_message'] = "Movie deleted successfully.";
               redirect_to("movie");
               exit();
          } else {
               $_SESSION['error'] = "Movie not found.";
               redirect_to("movie");
               exit();
          }
     } else {
          $_SESSION['error'] = "Movie not found.";
     }
     redirect_to("movie");
     exit();
}

function search_movie()
{
     // Jika ada data search yang dikirim
     $search = isset($_GET['search']) ? $_GET['search'] : '';
     // Panggil fungsi fetchMovies dengan parameter search
     $movies = fetchMovies($search);

     // Set header response
     header('Content-Type: application/json');
     // Tampilkan data dalam format JSON
     echo json_encode($movies);
}
