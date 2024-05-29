<?php include_once 'components/layout-user-top.php'; ?>
<?php include_once '../lib/general.php'; ?>

<?php
$categories = getCategories();
?>
<title>FWeb - All Categories</title>


<section class="bg-[#181a1b] h-[90vh] sm:h-max flex items-center ">
     <div class="flex flex-row flex-wrap gap-4 justify-center py-10">
          <?php foreach ($categories as $category) : ?>
               <a href="movies_category.php?id=<?= $category['id'] ?>" class="w-80 sm:w-[25rem] bg-white text-black border border-gray-200 rounded-lg shadow-lg hover:text-[#007bff]">
                    <div class="p-3 text-center">
                         <h3 class="mb-1 text-base font-bold tracking-tight  line-clamp-1"><?= $category['name'] ?></h3>
                    </div>
               </a>
          <?php endforeach; ?>
     </div>
</section>

<?php include_once 'components/ajax-search.php'; ?>

<?php include_once 'components/layout-user-bottom.php'; ?>