<?php include_once 'components/layout-user-top.php'; ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php'; ?>

<?php
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$movies = getMovies('', $limit, $offset);
$total_movies = countTotalMovies();
$total_pages = ceil($total_movies / $limit);
?>
<title>FWeb - All Movies</title>


<section class="bg-[#181a1b] p-7 min-h-screen">
     <div class="container mx-auto">
          <div class="grid sm:grid-cols-2 grid-cols-6 gap-6 sm:gap-4 mb-5">
               <?php foreach ($movies as $movie) : ?>
                    <a href="movie_detail.php?id=<?= $movie['id'] ?>" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg ">
                         <img class="rounded-t-lg w-full h-64 object-cover" src="<?= base_url($movie['poster_path']) ?>" alt="<?= $movie['name'] ?>" />
                         <div class="p-3 text-center">
                              <h3 class="mb-1 text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= $movie['name'] ?></h3>
                              <p class="mb-2 text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($movie['release_date'])) ?>)</p>
                              <p class="mb-3 font-normal text-xs text-gray-700 "><?= $movie['categories'] ?></p>
                         </div>
                    </a>
               <?php endforeach; ?>
          </div>
          <div class="flex justify-center ">
               <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="mx-1 px-3 py-2 bg-white border-2 rounded-lg <?= $i == $page ? 'text-[#007bff] border-[#007bff]' : '' ?>"><?= $i ?></a>
               <?php endfor; ?>
          </div>
     </div>
</section>

<?php include_once 'components/ajax-search.php'; ?>
<?php include_once 'components/layout-user-bottom.php'; ?>