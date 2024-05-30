<?php
include_once '../helpers/users.php';
include_once '../lib/general.php';
start_session();

// Pengecekan method yang digunakan
switch ($_SERVER['REQUEST_METHOD']) {
     case 'GET':
          $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : '';
          switch ($search_type) {
               case 'movie':
                    search_movies();
                    break;
               default:
                    redirect_to("movies");
                    break;
          }
          break;
     default:
          $_SESSION['error'] = "Invalid request.";
          redirect_to("movies");
          break;
}

function search_movies()
{
     $search = isset($_GET['query']) ? $_GET['query'] : '';
     $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;
     $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

     $movies = getMovieWithSearch($search, $limit, $offset);

     // Set header response
     header('Content-Type: application/json');
     // Tampilkan data dalam format JSON
     echo json_encode($movies);
}
