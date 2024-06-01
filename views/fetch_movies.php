<?php
include_once '../lib/general.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'latest';
$movies = getMovies($page);

if (!empty($movies)) {
     foreach ($movies as $movie) {
?>
          <a href="movie_detail.php?id=<?= $movie['id'] ?>" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg">
               <?php if ($movie['poster_path'] !== null) : ?>
                    <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>" />
               <?php else : ?>
                    <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url('/uploads/movie-posters/default-poster-picture.png') ?>" alt="Movie Poster">
               <?php endif; ?>
               <div class="p-3 text-center">
                    <h3 class="text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= $movie['name'] ?></h3>
                    <p class="text-sm font-medium text-gray-900">(<?= date('Y', strtotime($movie['release_date'])) ?>)</p>
               </div>
          </a>
<?php
     }
} else {
     echo '<p class="text-white col-span-6 sm:col-span-2 md:col-span-3">No movies found.</p>';
}
?>