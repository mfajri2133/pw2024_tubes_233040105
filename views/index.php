<?php include_once 'components/layout-user-top.php' ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php' ?>

<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'latest';
$movies = getMovies($current_page);
?>
<title>FWeb</title>

<section class="h-screen w-full bg-[#181a1b] flex items-center justify-center ">
     <div class="px-4 mx-auto text-center">
          <h1 class="mb-4 text-8xl font-extrabold tracking-tight leading-none text-white md:text-5xl sm:text-3xl poppins">Experience the Magic of <p class="text-[#007bff]">Movie.</p>
          </h1>
          <div class="mb-8 text-lg sm:text-base text-gray-300 sm:px-3 lg:px-48 karla font-extralight tracking-wide">
               <p class="mb-3">
                    At FMovie, we bring you movie details and reviews.
               </p>
               <p class="mb-3">
                    Discover the latest blockbusters, timeless classics, and hidden gems that will awaken your passion for movies.
               </p>
               <p>
                    Join us and dive into the world of cinema, where every story comes alive.
               </p>
          </div>
     </div>
</section>


<section class="h-auto bg-[#007bff] md:h-auto sm:h-auto relative overflow-hidden">
     <div class="p-[50px] sm:px-[16px] sm:py-[28px] flex place-content-center  max-w-[1440px] mx-auto md:pt-[64px] md:pb-[80px] md:px-[40px]">
          <div class="poppins text-[32px] sm:text-[16px] md:text-[28px] font-medium text-white text-center whitespace-pre-wrap">
               <p>Designed as the ultimate platform for movie enthusiasts, FWeb Movie offers a wide variety of films to explore and enjoy. From the latest blockbusters to timeless classics and hidden gems, we have something for everyone. Immerse yourself in the world of cinema and experience the magic of movies with FMovie.<br></p>
          </div>
     </div>
</section>


<section id="movies" class="bg-[#181a1b] p-4 py-20">
     <div class="flex items-center justify-center mb-6 flex-wrap">
          <a href="movies.php" class=" hover:text-[#007bff] border-2 hover:border-[#007bff] bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3">All Movies</a>
          <a href="#" id="latest-movies" class="hover:text-[#007bff] border-2 hover:border-[#007bff] bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'latest' ? 'text-[#007bff] border-[#007bff]' : '' ?>">Latest Movies</a>
          <a href="#" id="oldest-movies" class="hover:text-[#007bff] border-2 hover:border-[#007bff] bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'oldest' ? 'text-[#007bff] border-[#007bff]' : '' ?>">Oldest Movies</a>
     </div>

     <div class="container mx-auto">
          <div id="movies-container" class="grid sm:grid-cols-2 grid-cols-6 md:grid-cols-3 gap-6 sm:gap-4">
               <?php if (!empty($movies)) : ?>
                    <?php foreach ($movies as $movie) : ?>
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
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white col-span-6 sm:col-span-2 md:col-span-3">No movies found.</p>
               <?php endif; ?>
          </div>
     </div>
</section>

<?php include_once 'components/layout-user-bottom.php' ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
          $('#latest-movies, #oldest-movies').on('click', function(e) {
               e.preventDefault();
               let page = $(this).attr('id').replace('-movies', '');

               $.ajax({
                    url: window.location.href,
                    type: 'GET',
                    data: {
                         page: page,
                         ajax: true
                    },
                    // Kirim data ke server untuk di proses
                    success: function(response) {
                         $('#movies-container').html($(response).find('#movies-container').html());
                         if (page === 'latest') {
                              $('#latest-movies').addClass('text-[#007bff] border-[#007bff]');
                              $('#oldest-movies').removeClass('text-[#007bff] border-[#007bff]');
                         } else if (page === 'oldest') {
                              $('#oldest-movies').addClass('text-[#007bff] border-[#007bff]');
                              $('#latest-movies').removeClass('text-[#007bff] border-[#007bff]');
                         }
                    },
                    error: function(xhr, status, error) {
                         console.error('AJAX Error: ' + status + error);
                    }
               });
          });
     });
</script>

<?php
if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
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
     exit;
}
?>