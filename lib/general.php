<?php
include_once 'connection.php';



// Lib CRUD
// Lib C (Create)
// fungsi untuk register user dihalaman register


function add_user($name, $username, $password)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Hash password
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
     // Membuat query untuk menambahkan user
     $stmt = $conn->prepare("INSERT INTO users (name, username, password, is_active, is_admin) VALUES (?, ?, ?, 1, 0)");
     // Mengikat parameter dan mengeksekusi query
     $stmt->bind_param("sss", $name, $username, $hashed_password);
     if ($stmt->execute()) {
          $stmt->close();
          return true;
     } else {
          $stmt->close();
          return false;
     }
}

// Lib D (Delete)
function destroy($id)
{
     global $conn;
     $sql = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_close($sql);

     return true;
}

// Fungsi mengapus user/admin dari list dengan cara soft delete
function soft_destroy($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;
     // SQL untuk mengubah status user menjadi tidak aktif
     $sql = mysqli_prepare($conn, "UPDATE users SET is_active = 0 WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     $result = mysqli_stmt_execute($sql);
     // Menutup statement
     mysqli_stmt_close($sql);
     // Mengembalikan status berhasil atau tidak
     return $result;
}

// Lib helper
// Mendapatkan user berdasarkan id
function get_user($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;
     // SQL untuk mendapatkan user berdasarkan id
     $sql = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     $result = mysqli_stmt_get_result($sql);
     // Mengambil data user
     $user = mysqli_fetch_assoc($result);
     // Menutup statement
     mysqli_stmt_close($sql);
     // Mengembalikan data user
     return $user;
}

// Fungsi untuk mengecek apakah user adalah admin
function check_is_admin($id)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // SQL untuk mendapatkan status admin user
     $sql = mysqli_prepare($conn, "SELECT is_admin FROM users WHERE id = ?");
     // Mengikat parameter dan mengeksekusi query
     mysqli_stmt_bind_param($sql, "i", $id);
     mysqli_stmt_execute($sql);
     mysqli_stmt_bind_result($sql, $is_admin);
     mysqli_stmt_fetch($sql);
     mysqli_stmt_close($sql);
     return $is_admin == 1;
}

// fungsi untuk mencari username yang sudah terdaftar
function is_username_exists($username)
{
     // Menggunakan variabel global $conn untuk konek ke database
     global $conn;

     // Mencari username yang cocok
     try {
          $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $stmt->bind_result($count);
          $stmt->fetch();
          $stmt->close();

          // Jika jumlah baris dengan username yang cocok lebih dari 0, username sudah terdaftar
          return $count > 0;
     } catch (Exception $e) {
          // Jika terjadi kesalahan, tangani di sini (misalnya, log kesalahan atau tampilkan pesan kesalahan)
          return false;
     }
}

// Function get movies untuk dihalaman user/landing page
function getMovies($order = 'latest', $limit = 6, $offset = 0)
{
     global $conn;

     // Sesuaikan query berdasarkan $order
     // Jika $order adalah 'latest', urutkan berdasarkan release_date secara descending
     if ($order == 'latest') {
          $order_by = "ORDER BY movies.release_date DESC";
          // Jika $order adalah 'oldest', urutkan berdasarkan release_date secara ascending
     } elseif ($order == 'oldest') {
          $order_by = "ORDER BY movies.release_date ASC";
          // Jika $order tidak valid, jangan gunakan ORDER BY
     } else {
          $order_by = "";
     }

     // Query untuk mengambil film dengan kategori yang di-join menggunakan GROUP_CONCAT dan LEFT JOIN untuk mengambil semua film meskipun tidak memiliki kategori
     // Cara baca querynya adalah:
     // 1. Memilih semua kolom dari tabel movies
     // 2. Menggabungkan nama-nama kategori yang terikat dengan sebuah film menjadi satu string dengan pemisah ', ' dan memberikan alias 'categories'
     // 3. Mengambil data dari tabel movies
     // 4. Menggabungkan tabel movies dengan tabel movie_categories menggunakan LEFT JOIN 
     // 5. Menggabungkan tabel movie_categories dengan tabel categories menggunakan LEFT JOIN
     // 6. Mengelompokkan data berdasarkan id film
     // 7. Mengurutkan data berdasarkan $order_by
     // 8. Mengambil data sebanyak $limit mulai dari $offset
     $query = "
          SELECT movies.*, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories FROM movies
          LEFT JOIN movie_categories ON movies.id = movie_categories.movie_id
          LEFT JOIN categories ON movie_categories.category_id = categories.id
          GROUP BY movies.id
          $order_by
          LIMIT $limit OFFSET $offset
     ";

     $result = $conn->query($query);

     if (!$result) {
          die("Query Error: " . $conn->error);
     }

     $movies = [];
     while ($row = $result->fetch_assoc()) {
          $movies[] = [
               'id' => $row['id'],
               'name' => $row['name'],
               'release_date' => $row['release_date'],
               'poster_path' => $row['poster_path'],
               'categories' => $row['categories']
          ];
     }

     return $movies;
}

// Query untuk menghitung total film
function countTotalMovies()
{
     global $conn;

     $query = "SELECT COUNT(*) AS total FROM movies";
     $result = $conn->query($query);
     $row = $result->fetch_assoc();
     return $row['total'];
}

function countTotalMoviesWithSearch($search = "")
{
     global $conn;
     $search = "%$search%";
     $query = "
        SELECT COUNT(DISTINCT movies.id) AS total FROM movies
        LEFT JOIN movie_categories ON movies.id = movie_categories.movie_id
        LEFT JOIN categories ON movie_categories.category_id = categories.id
        WHERE movies.name LIKE ?
    ";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('s', $search);
     $stmt->execute();
     $result = $stmt->get_result();
     $row = $result->fetch_assoc();
     return $row['total'];
}


function getMovieWithSearch($search = "", $limit = 3, $offset = 0)
{
     global $conn;
     $search = "%$search%";
     $query = "
          SELECT movies.*, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories FROM movies
          LEFT JOIN movie_categories ON movies.id = movie_categories.movie_id
          LEFT JOIN categories ON movie_categories.category_id = categories.id
          WHERE movies.name LIKE ?
          GROUP BY movies.id
          LIMIT $limit OFFSET $offset
     ";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('s', $search);
     $stmt->execute();
     $result = $stmt->get_result();
     $movies = [];
     while ($row = $result->fetch_assoc()) {
          $movies[] = $row;
     }
     return $movies;
}


function getMovieById($id)
{
     global $conn;

     // Cara baca querynya adalah:
     // 1. Memilih semua kolom dari tabel movies
     // 2. Menggabungkan nama-nama kategori yang terikat dengan sebuah film menjadi satu string dengan pemisah ', ' dan memberikan alias 'categories'
     // 3. Mengambil data dari tabel movies
     // 4. Menggabungkan tabel movies dengan tabel movie_categories menggunakan LEFT JOIN
     // 5. Menggabungkan tabel movie_categories dengan tabel categories menggunakan LEFT JOIN
     // 6. Mengambil data film dengan id yang sesuai
     // 7. Mengelompokkan data berdasarkan id film     
     $query = "
          SELECT movies.*, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories FROM movies
          LEFT JOIN movie_categories ON movies.id = movie_categories.movie_id
          LEFT JOIN categories ON movie_categories.category_id = categories.id
          WHERE movies.id = ?
          GROUP BY movies.id
     ";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('i', $id);
     $stmt->execute();
     $result = $stmt->get_result();
     return $result->fetch_assoc();
}

function getMoviesByCategories($categories, $exclude_movie_id)
{
     global $conn;
     $category_placeholders = implode(',', array_fill(0, count($categories), '?'));
     $query = "
          SELECT movies.*, GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories FROM movies
          LEFT JOIN movie_categories ON movies.id = movie_categories.movie_id
          LEFT JOIN categories ON movie_categories.category_id = categories.id
          WHERE categories.name IN ($category_placeholders) AND movies.id != ?
          GROUP BY movies.id
          ORDER BY RAND()
          LIMIT 6
     ";
     $stmt = $conn->prepare($query);
     $types = str_repeat('s', count($categories)) . 'i';
     $params = array_merge($categories, [$exclude_movie_id]);
     $stmt->bind_param($types, ...$params);
     $stmt->execute();
     $result = $stmt->get_result();
     $movies = [];
     while ($row = $result->fetch_assoc()) {
          $movies[] = $row;
     }
     return $movies;
}



function getCategories()
{
     global $conn;
     $query = "SELECT * FROM categories";
     $result = $conn->query($query);
     $categories = [];
     while ($row = $result->fetch_assoc()) {
          $categories[] = $row;
     }
     return $categories;
}
