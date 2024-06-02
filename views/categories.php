<?php include_once 'components/layout-user-top.php'; ?>
<?php include_once '../lib/general.php'; ?>

<?php

$categories = getCategories();
?>

<title>FWeb - All Categories</title>

<section class="h-screen w-full bg-[#181a1b] flex items-center justify-center">
     <div class="px-4 mx-auto text-center">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-3xl sm:text-2xl poppins">Explore Movies by Category</h1>
          <div class="mb-8 text-lg sm:text-base text-gray-300 sm:px-3 lg:px-48 karla font-extralight tracking-wide">
               <p>Select a category to see the movies in that category.</p>
          </div>
     </div>
</section>

<section id="categories" class="bg-[#007bff] p-6 py-24">
     <div class="container mx-auto">
          <div class="grid sm:grid-cols-1 md:grid-cols-3 grid-cols-6 gap-6">
               <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                         <a href="movies_by_category.php?id=<?= $category['id'] ?>" class="block bg-white text-center py-4 px-6 rounded-lg shadow-md text-lg font-bold text-[#007bff] ">
                              <?= htmlspecialchars($category['name']) ?>
                         </a>
                    <?php endforeach; ?>
               <?php else : ?>
                    <p class="text-white col-span-full text-center text-2xl font-extrabold tracking-tight leading-none md:text-1xl sm:text-xl poppins">No categories found.</p>
               <?php endif; ?>
          </div>
     </div>
</section>

<?php include_once 'components/layout-user-bottom.php'; ?>