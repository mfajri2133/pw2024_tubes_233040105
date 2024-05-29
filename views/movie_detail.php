<?php
include_once '../lib/general.php';
include_once '../helpers/users.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$movie = getMovieById($id);
$related_movies = getMoviesByCategories(explode(', ', $movie['categories']), $id);
function convertToEmbedURL($url)
{
     // Cek jika URL adalah URL youtu.be
     if (strpos($url, 'youtu.be') !== false) {
          // Mengambil kode video dari URL youtu.be
          preg_match('/youtu.be\/([^\?]+)/', $url, $matches);
          // Mengembalikan URL embed youtube.com
          return 'https://www.youtube.com/embed/' . $matches[1];
     }
     // Cek jika URL adalah URL youtube.com
     if (strpos($url, 'youtube.com') !== false) {
          // Mengambil kode video dari URL youtube.com
          preg_match('/v=([^\&]+)/', $url, $matches);
          // Mengembalikan URL embed youtube.com
          return 'https://www.youtube.com/embed/' . $matches[1];
     }
     // Jika URL bukan URL youtube, kembalikan URL asli
     return $url;
}

$trailer_url = convertToEmbedURL($movie['trailer_url']);
?>

<?php include_once 'components/layout-user-top.php'; ?>
<title><?= htmlspecialchars($movie['name']) ?> - FWeb</title>

<section class=" bg-[#181a1b] px-40 sm:px-6 sm:py-7 py-8">
     <h1 class="mb-3 text-4xl sm:text-3xl font-extrabold tracking-tight leading-none text-white poppins"><?= htmlspecialchars($movie['name']) ?></h1>

     <div class="flex items-center justify-center gap-4 sm:grid sm:grid-cols-1 mb-3">
          <img class=" w-[304px] h-[456px] sm:w-[400px] sm:h-[515px] object-cover" src="<?= base_url($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
          <iframe class=" w-[900px] h-[456px] sm:w-[383px] sm:h-[315px]" src="<?= $trailer_url ?>" frameborder="0" allowfullscreen></iframe>
     </div>


     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1">Category</h4>
          <div class="flex flex-wrap ">
               <?php
               $categories = explode(', ', $movie['categories']);
               foreach ($categories as $category) {
                    echo "<span class='inline-block bg-[#fff] rounded-full px-3 py-1 mb-1.5 border border-[#007bff] text-sm font-semibold text-[#007bff] mr-1.5'>$category</span>";
               }
               ?>
          </div>
     </div>

     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1"></i>Details</h4>
          <p class=" text-sm text-white">Release Date: <?= date('j F, Y', strtotime($movie['release_date'])) ?></p>
          <p class=" text-sm text-white">Duration: <?= htmlspecialchars($movie['duration']) ?> min</p>
          <p class=" text-sm text-white">Director: <?= htmlspecialchars($movie['director']) ?></p>
          <p class=" text-sm text-white">Producer: <?= htmlspecialchars($movie['producer']) ?></p>
     </div>

     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1">Synopsis</h4>
          <p class=" text-sm text-justify text-white"><?= htmlspecialchars($movie['description']) ?></p>
     </div>

</section>

<section class="bg-[#181a1b] p-4">
     <div class="container mx-auto">
          <h2 class="mb-4 text-2xl font-bold text-white">Same Movie Category</h2>
          <div class="grid sm:grid-cols-2 grid-cols-6 gap-6 sm:gap-4">
               <?php foreach ($related_movies as $related_movie) : ?>
                    <a href="movie_detail.php?id=<?= $related_movie['id'] ?>" class="max-w-sm bg-white border border-white rounded-lg shadow-lg ">
                         <img class="rounded-t-lg w-full h-64" src="<?= base_url($related_movie['poster_path']) ?>" alt="<?= htmlspecialchars($related_movie['name']) ?>" />
                         <div class="p-3 text-center">
                              <h3 class="mb-1 text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= htmlspecialchars($related_movie['name']) ?></h3>
                              <p class="mb-2 text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($related_movie['release_date'])) ?>)</p>
                         </div>
                    </a>
               <?php endforeach; ?>
          </div>
     </div>
</section>

<?php include_once 'components/ajax-search.php'; ?>

<?php include_once 'components/layout-user-bottom.php'; ?>