<?php include_once 'components/layout-user-top.php'; ?>
<?php include_once '../lib/general.php'; ?>

<?php
if (!isset($_GET['id'])) {
     redirect_to('categories');
     exit;
}

$categoryId = (int) $_GET['id'];
$category = getCategoryById($categoryId);
$movies = getMoviesByCategory($categoryId);

if (!$category) {
     redirect_to('categories');
     exit;
}
?>
<title>FWeb - <?= htmlspecialchars($category['name']) ?> Movies</title>

<section class="bg-[#181a1b] min-h-screen p-7">
     <div class="container mx-auto">
          <h1 class="text-4xl font-bold text-white mb-8"><?= htmlspecialchars($category['name']) ?> Movies</h1>
          <div class="grid sm:grid-cols-2 grid-cols-6 md:grid-cols-4 gap-6 sm:gap-4 mb-5">
               <?php if (!empty($movies)) : ?>
                    <?php foreach ($movies as $movie) : ?>
                         <a href="movie_detail.php?id=<?= $movie['id'] ?>" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg ">
                              <img class="rounded-t-lg w-full h-64 object-cover" src="<?= base_url($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>" />
                              <div class="p-3 text-center">
                                   <h3 class="text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= htmlspecialchars($movie['name']) ?></h3>
                                   <p class=" text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($movie['release_date'])) ?>)</p>
                              </div>
                         </a>
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white cols-col-span-6 sm:col-span-2 md:col-span-4">Tidak ada movies</p>
               <?php endif; ?>
          </div>
     </div>
</section>

<?php include_once 'components/layout-user-bottom.php'; ?>