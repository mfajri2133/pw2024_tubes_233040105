<?php include_once 'components/layout-user-top.php'; ?>
<!-- lib for fetch movie -->
<?php include_once '../lib/general.php'; ?>

<?php
// Fetch distinct years from the movies table
$years = getMovieYears();
?>

<title>FWeb - Movie Years</title>

<section class="h-screen w-full bg-[#181a1b] flex items-center justify-center">
     <div class="px-4 mx-auto text-center">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-3xl sm:text-2xl poppins">Explore Movies by Year</h1>
          <div class="mb-8 text-lg sm:text-base text-gray-300 sm:px-3 lg:px-48 karla font-extralight tracking-wide">
               <p>Select a year to see the movies released in that year.</p>
          </div>
     </div>
</section>

<section id="years" class="bg-[#007bff] p-4 py-24">
     <div class="container mx-auto">
          <div class="grid sm:grid-cols-2 md:grid-cols-3 grid-cols-6 gap-6">
               <?php if (!empty($years)) : ?>
                    <?php foreach ($years as $year) : ?>
                         <a href="movies_by_year.php?year=<?= $year ?>" class="block bg-white text-center py-4 px-6 rounded-lg shadow-md text-lg font-bold text-[#007bff]">
                              <?= $year ?>
                         </a>
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white col-span-full text-center text-2xl font-extrabold tracking-tight leading-none md:text-1xl sm:text-xl poppins">No years found.</p>
               <?php endif; ?>
          </div>
     </div>
</section>

<?php include_once 'components/layout-user-bottom.php'; ?>