<?php include_once 'components/layout-user-top.php'; ?>
<?php include_once '../lib/general.php'; ?>

<?php
$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$query = isset($_GET['query']) ? $_GET['query'] : '';
$offset = ($page - 1) * $limit;

$movies = getMovieWithSearch($query, $limit, $offset);
$total_movies = countTotalMoviesWithSearch($query);
$total_pages = ceil($total_movies / $limit);
?>
<title>FWeb - Search Results</title>

<section class="bg-[#181a1b] p-6 min-h-screen">
     <div class="container mx-auto">
          <h1 class="text-white text-4xl mb-5">Search Results for "<?= htmlspecialchars($query) ?>"</h1>

          <div id="movies-container" class="grid sm:grid-cols-2 grid-cols-6 md:grid-cols-4 gap-6 sm:gap-4 mb-5">
               <?php if (count($movies) > 0) : ?>
                    <?php foreach ($movies as $movie) : ?>
                         <a href="movie_detail.php?id=<?= $movie['id'] ?>" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg ">
                              <?php if ($movie['poster_path'] !== null) : ?>
                                   <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>" />
                              <?php else : ?>
                                   <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url('/uploads/movie-posters/default-poster-picture.png') ?>" alt="Movie Poster">
                              <?php endif; ?>
                              <div class="p-3 text-center">
                                   <h3 class="text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= $movie['name'] ?></h3>
                                   <p class=" text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($movie['release_date'])) ?>)</p>

                              </div>
                         </a>
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white col-span-6 sm:col-span-2 md:col-span-4 text-center text-xl">No movies found.</p>
               <?php endif; ?>
          </div>

          <?php if ($total_pages > 1) : ?>
               <div id="pagination" class="flex justify-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                         <a href="?query=<?= urlencode($query) ?>&page=<?= $i ?>" class="mx-1 px-3 py-2 bg-white border-2 rounded-lg <?= $i == $page ? 'text-[#007bff] border-[#007bff]' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
               </div>
          <?php endif; ?>
     </div>
</section>




<?php include_once 'components/layout-user-bottom.php'; ?>