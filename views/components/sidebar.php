<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<aside id="logo-sidebar" class="fixed top-0 left-0  w-64 h-screen pt-20 transition-transform sm:z-50 bg-white border-r border-gray-200  dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
     <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
          <ul class="space-y-2 font-medium">
               <li>
                    <a href="<?= base_url('/views/category.php') ?>" class="flex items-center p-2  rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group <?php echo $current_page == 'category' ? 'bg-gray-100  dark:bg-gray-700' : ''; ?>">
                         <div class="w-5 h-5 content-center text-center">
                              <i class="fa-solid fa-film"></i>
                         </div>
                         <span class="ms-3">Movie Category</span>
                    </a>
               </li>
               <li>
                    <a href="<?= base_url('/views/movie.php') ?>" class="flex items-center p-2  rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group <?php echo $current_page == 'movie' ? 'bg-gray-100 dark:bg-gray-700 ' : ''; ?>">
                         <div class="w-5 h-5 content-center text-center">
                              <i class="fa-regular fa-file-video"></i>
                         </div>
                         <span class="flex-1 ms-3 whitespace-nowrap">Movies</span>
                    </a>
               </li>
               <li>
                    <a href="<?= base_url('/views/user.php') ?>" class="flex items-center p-2  rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group <?php echo $current_page == 'user' ? 'bg-gray-100 dark:bg-gray-700' : ''; ?>">
                         <div class="w-5 h-5 content-center text-center">
                              <i class="fa-solid fa-user"></i>
                         </div>
                         <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
               </li>
               <li>
                    <a href="<?= base_url('/views/admin.php') ?>" class="flex items-center p-2  rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group <?php echo $current_page == 'admin' ? 'bg-gray-100 dark:bg-gray-700' : ''; ?>">
                         <div class="w-5 h-5 content-center text-center">
                              <i class="fa-solid fa-users-gear"></i>
                         </div>
                         <span class="flex-1 ms-3 whitespace-nowrap">Admin</span>
                    </a>
               </li>
          </ul>
     </div>
</aside>