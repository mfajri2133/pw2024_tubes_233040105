<?php include_once 'components/layout-user-top.php' ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php' ?>

<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'latest';
$movies = getMovies($current_page);
?>
<title>FWeb</title>


<section class="h-screen w-full bg-[#181a1b] flex items-center justify-center ">
     <div class="px-4 mx-auto max-w-screen-xl text-center ">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl poppins">Experience the Magic of <p class="text-[#007bff]">Movie.</p>
          </h1>
          <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
               At FWeb Movie, we bring you movie details and reviews. Discover the latest blockbusters, timeless classics, and hidden gems that will awaken your passion for movies. Join us and dive into the world of cinema, where every story comes alive.
          </p>
     </div>
</section>

<section id="movies" class="bg-[#181a1b] p-4">
     <div class="flex items-center justify-center py-2 flex-wrap">
          <a href="?page=latest#movies" class=" hover:text-[#007bff] border-2 hover:border-[#007bff]  bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'latest' ? 'text-[#007bff] border-[#007bff]  ' : '' ?>">Latest Movies</a>
          <a href="movies.php" class="sm:order-1 hover:text-[#007bff] border-2 hover:border-[#007bff]  bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 ">All Movies</a>
          <a href="?page=oldest#movies" class=" hover:text-[#007bff] border-2 hover:border-[#007bff]  bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'oldest' ? 'text-[#007bff] border-[#007bff]' : '' ?>">Oldest Movies</a>
     </div>

     <div class="container mx-auto">
          <div class="grid sm:grid-cols-2 grid-cols-6 gap-6 sm:gap-4">
               <?php foreach ($movies as $movie) : ?>
                    <a href=" movie_detail.php?id=<?= $movie['id'] ?>" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg ">
                         <img class="rounded-t-lg w-full h-64 object-cover" src="<?= base_url($movie['poster_path']) ?>" alt="<?= $movie['name'] ?>" />
                         <div class="p-3 text-center">
                              <h3 class=" text-base font-bold tracking-tight text-gray-900 line-clamp-1"><?= $movie['name'] ?></h3>
                              <p class="mb-1 text-sm font-medium text-gray-900 ">(<?= date('Y', strtotime($movie['release_date'])) ?>)</p>
                              <p class=" font-normal text-xs text-gray-700 "><?= $movie['categories'] ?></p>
                         </div>
                    </a>
               <?php endforeach; ?>
          </div>
     </div>
</section>
<?php include_once 'components/ajax-search.php'; ?>


<?php include_once 'components/layout-user-bottom.php' ?>