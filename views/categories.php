<?php include_once 'components/layout-user-top.php'; ?>
<?php include_once '../lib/general.php'; ?>

<?php
$categories = getCategories();
?>
<title>FWeb - All Categories</title>


<section class="bg-[#181a1b] min-h-screen">
     <div class="container mx-auto py-10">
          <h1 class="text-white text-3xl mb-5 font-semibold text-center">All Movie Category</h1>
          <div class="flex flex-row flex-wrap gap-4 justify-center ">
               <?php foreach ($categories as $category) : ?>
                    <a href="movies_category.php?id=<?= $category['id'] ?>" class="w-80 sm:w-[25rem] bg-white text-black border border-gray-200 rounded-lg shadow-lg hover:text-[#007bff]">
                         <div class="p-3 text-center">
                              <h3 class="mb-1 text-base font-bold tracking-tight  line-clamp-1"><?= $category['name'] ?></h3>
                         </div>
                    </a>
               <?php endforeach; ?>
          </div>
     </div>
</section>


<?php include_once 'components/layout-user-bottom.php'; ?>