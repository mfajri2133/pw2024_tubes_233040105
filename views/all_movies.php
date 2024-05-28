<?php include_once 'components/layout-user-top.php'; ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php'; ?>

<?php

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$movies = getMovies('all', $limit, $offset);
$total_movies = countTotalMovies();
$total_pages = ceil($total_movies / $limit);
?>
<title>FWeb - All Movies</title>

<section class="bg-[#181a1b] p-4">
     <div class="container mx-auto p-8">
          <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
               <?php foreach ($movies as $movie) : ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                         <a href="#">
                              <img src="<?= base_url($movie['poster_path']) ?>" alt="<?= $movie['name'] ?>" class="w-full h-64 object-cover">
                              <div class="p-4 text-center">
                                   <h2 class="mt-2 text-black font-bold"><?= $movie['name'] ?></h2>
                                   <h3 class="text-black font-bold">(<?= $movie['release_date'] ?>)</h3>
                                   <p class="mt-1 text-xs">
                                        <?php
                                        $categories = explode(',', $movie['category']);
                                        foreach ($categories as $category) {
                                             echo "<span class='inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2'>$category</span>";
                                        }
                                        ?>
                                   </p>
                              </div>
                         </a>
                    </div>
               <?php endforeach; ?>
          </div>
          <div class="flex justify-center mt-8">
               <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <a href="?page=<?= $i ?>" class="mx-1 px-3 py-2 bg-white text-black rounded-lg <?= $i == $page ? 'text-[#007bff] border-[#007bff]' : '' ?>"><?= $i ?></a>
               <?php endfor; ?>
          </div>
     </div>
</section>

<?php include_once 'components/layout-user-bottom.php'; ?>