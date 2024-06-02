<?php
include_once '../lib/general.php';
include_once '../helpers/users.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$movie = getMovieById($id);
$related_movies = getRelatedMovies(explode(', ', $movie['categories']), $id);

function convertToEmbedURL($url)
{
     if (strpos($url, 'youtu.be') !== false) {
          preg_match('/youtu.be\/([^\?]+)/', $url, $matches);
          return 'https://www.youtube.com/embed/' . $matches[1];
     }
     if (strpos($url, 'youtube.com') !== false) {
          preg_match('/v=([^\&]+)/', $url, $matches);
          return 'https://www.youtube.com/embed/' . $matches[1];
     }
     return $url;
}

$trailer_url = convertToEmbedURL($movie['trailer_url']);
?>

<?php include_once 'components/layout-user-top.php'; ?>
<title><?= htmlspecialchars($movie['name']) ?> - FWeb</title>

<section class=" bg-[#181a1b] px-40 sm:px-6 md:px-8 sm:py-7 py-8 poppins">
     <div class="flex justify-between">
          <div>
               <h1 class="mb-3 text-4xl sm:text-3xl font-extrabold tracking-tight leading-none text-white poppins"><?= htmlspecialchars($movie['name']) ?></h1>
          </div>
          <div>
               <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="left" data-dropdown-offset-distance="5" data-dropdown-offset-skidding="70" class="inline-flex items-center p-2 text-sm font-medium text-center bg-[#fff] text-black rounded-lg" type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                         <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
               </button>

               <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                         <li>
                              <a href="#" id="copyLinkButton" class="block px-4 py-2 hover:bg-gray-100 ">Copy to clipboard</a>
                         </li>
                         <li>
                              <?php if (!login_check()) : ?>
                                   <?php $_SESSION['error'] = 'Please login to use the feature.'; ?>
                                   <a href="<?= base_url('/views/login.php') ?>" class="block px-4 py-2 hover:bg-gray-100">Convert to PDF</a>
                              <?php else : ?>
                                   <a href="../pdf/generate_movie_pdf.php?id=<?= $movie['id'] ?>" class="block px-4 py-2 hover:bg-gray-100">Convert to PDF</a>
                              <?php endif; ?>
                         </li>
                    </ul>
               </div>
          </div>
     </div>

     <div class="flex items-center justify-center gap-4 sm:grid sm:grid-cols-1 mb-3">
          <?php if ($movie['poster_path'] !== null) : ?>
               <img class="w-[304px] h-[456px] sm:w-full sm:h-[515px] object-cover" src="<?= base_url($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
          <?php else : ?>
               <img class="w-[304px] h-[456px] sm:w-full sm:h-[515px] object-cover" src="<?= base_url('/uploads/movie-posters/default-poster-picture.png') ?>" alt="Movie Poster">
          <?php endif; ?>
          <iframe class="w-[900px] h-[456px] sm:w-full sm:h-[315px]" src="<?= $trailer_url ?>" frameborder="0" allowfullscreen></iframe>
     </div>

     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1">Category</h4>
          <div class="flex flex-wrap">
               <?php
               $categories = explode(', ', $movie['categories']);
               $category_ids = explode(', ', $movie['category_ids']);
               foreach ($categories as $index => $category) {
                    $category_id = $category_ids[$index];
                    echo "<a href='movies_by_category.php?id=$category_id' class='inline-block bg-[#fff] rounded-full px-3 py-1 mb-1.5 border border-[#007bff] text-sm font-semibold text-[#007bff] mr-1.5'>$category</a>";
               }
               ?>
          </div>
     </div>

     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1">Details</h4>
          <p class="text-sm text-white">Release Date: <?= date('j F, Y', strtotime($movie['release_date'])) ?></p>
          <p class="text-sm text-white">Duration: <?= htmlspecialchars($movie['duration']) ?> min</p>
          <p class="text-sm text-white">Director: <?= htmlspecialchars($movie['director']) ?></p>
          <p class="text-sm text-white">Producer: <?= htmlspecialchars($movie['producer']) ?></p>
     </div>

     <div class="mb-4">
          <h4 class="text-[#007bff] font-semibold text-lg mb-1">Synopsis</h4>
          <p class="text-sm text-justify text-white"><?= htmlspecialchars($movie['description']) ?></p>
     </div>
</section>

<section class="bg-[#181a1b] p-4">
     <div class="container mx-auto">
          <div class="flex justify-between items-center mb-4">
               <h2 class="text-2xl sm:text-lg font-bold text-white">Same Movie Category</h2>
               <a href="<?= base_url('/views/movies.php') ?>" class="bg-[#007bff] py-2 px-3 text-base font-bold rounded-full text-white flex items-center justify-center">
                    See All Movies
               </a>
          </div>

          <div class="grid sm:grid-cols-2 grid-cols-6 md:grid-cols-3 gap-6 sm:gap-4">
               <?php if (!empty($related_movies)) : ?>
                    <?php foreach ($related_movies as $related_movie) : ?>
                         <a href="movie_detail.php?id=<?= $related_movie['id'] ?>" class="max-w-sm bg-white border border-white rounded-lg shadow-lg ">
                              <?php if ($related_movie['poster_path'] !== null) : ?>
                                   <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url($related_movie['poster_path']) ?>" alt="<?= htmlspecialchars($related_movie['name']) ?>" />
                              <?php else : ?>
                                   <img class="rounded-t-lg w-full object-cover h-64" src="<?= base_url('/uploads/movie-posters/default-poster-picture.png') ?>" alt="Movie Poster">
                              <?php endif; ?>
                              <div class="p-3 text-center">
                                   <h3 class="text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= htmlspecialchars($related_movie['name']) ?></h3>
                                   <p class=" text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($related_movie['release_date'])) ?>)</p>
                              </div>
                         </a>
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white col-span-6 sm:col-span-2 md:col-span-3">No movies found.</p>
               <?php endif; ?>
          </div>
     </div>
</section>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
          $('#copyLinkButton').on('click', function(e) {
               e.preventDefault();
               var button = $(this);
               var dummy = $('<textarea></textarea>');
               $('body').append(dummy);
               dummy.val(window.location.href);
               dummy.select();
               document.execCommand('copy');
               dummy.remove();


               button.text('Copied');
               button.prop('disabled', true);


               setTimeout(function() {
                    button.text('Copy to clipboard');
                    button.prop('disabled', false);
               }, 3000);
          });
     });
</script>

<?php include_once 'components/layout-user-bottom.php'; ?>