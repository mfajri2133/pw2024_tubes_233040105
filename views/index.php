<?php include_once 'components/layout-user-top.php' ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php' ?>

<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'latest';
$movies = getMovies();
?>
<title>FWeb</title>


<section class="h-screen w-full bg-[#181a1b] flex items-center justify-center">
     <div class="px-4 mx-auto max-w-screen-xl text-center ">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl poppins">Experience the Magic of <p class="text-[#007bff]">Movie.</p>
          </h1>
          <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
               At FWeb Movie, we bring you movie details and reviews. Discover the latest blockbusters, timeless classics, and hidden gems that will awaken your passion for movies. Join us and dive into the world of cinema, where every story comes alive.
          </p>
     </div>
</section>

<section class="bg-[#181a1b] p-4">
     <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
          <a href="?page=latest" class="text-black hover:text-[#007bff] hover:border-[#007bff] border border-white bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'latest' ? 'text-[#007bff] border-[#007bff]' : '' ?>">Latest Movies</a>
          <a href="all_movies.php" class="text-black hover:text-[#007bff] hover:border-[#007bff] border border-white bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 ">All Movies</a>
          <a href="?page=oldest" class="text-black hover:text-[#007bff] hover:border-[#007bff] border border-white bg-white rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 <?= $current_page == 'oldest' ? 'text-[#007bff] border-[#007bff]' : '' ?>">Oldest Movies</a>
     </div>

     <div class="container mx-auto p-8">
          <div class="grid sm:grid-cols-2 grid-cols-5 gap-6">
               <?php foreach ($movies as $movie) : ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                         <a href="#">
                              <img src="<?= base_url($movie['poster_path']) ?>" alt="<?= $movie['name'] ?>" class="w-full h-64 object-cover">
                              <div class="p-4 text-center">
                                   <h2 class="mt-2 text-black font-bold"><?= $movie['name'] ?></h2>
                                   <h3 class="text-black font-bold">(<?= $movie['release_date'] ?>)</h3>
                              </div>
                         </a>
                    </div>
               <?php endforeach; ?>
          </div>
     </div>
</section>


<?php include_once 'components/layout-user-bottom.php' ?>