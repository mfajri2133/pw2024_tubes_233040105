<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
$page_names = [
     'movie_category' => 'Movie Category',
     'movies' => 'Movies',
     'user' => 'Users',
     'admin' => 'Admin',
     'roles' => 'Roles',
     'profile' => 'Profile',
];
$current_page_name = isset($page_names[$current_page]) ? $page_names[$current_page] : 'Dashboard';
?>

<div class="bg-white shadow-md rounded-md p-3 h-fit w-fit mb-4">
     <nav class="flex align-middle" aria-label="Breadcrumb">
          <ol class="inline-flex items-center  rtl:space-x-reverse">
               <li class="inline-flex items-center">
                    <a href="<?= base_url('/views/dashboard.php') ?>" class="inline-flex items-center text-xs font-medium text-gray-700 p-2 rounded-sm hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white">
                         <i class="fa-solid fa-house"></i>
                         <p class="ms-3">
                              Dashboard
                         </p>
                    </a>
               </li>
               <?php if ($current_page_name !== 'Dashboard') : ?>
                    <li class="inline-flex items-center">
                         <a class="inline-flex items-center text-xs font-medium text-gray-700 p-2 rounded-sm ">
                              <i class="fa-solid fa-chevron-right"></i>
                              <p class="ms-3">
                                   <?= htmlspecialchars($current_page_name) ?>
                              </p>
                         </a>
                    </li>
               <?php endif; ?>
          </ol>
     </nav>
</div>