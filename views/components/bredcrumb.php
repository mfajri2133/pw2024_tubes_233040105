<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
$page_names = [
     'movie_category' => 'Movie Category',
     'movies' => 'Movies',
     'user' => 'Users',
     'admin' => 'Admin',
     'roles' => 'Roles',
     'profile' => 'Profile',
     // Tambahkan halaman lain jika perlu
];
$current_page_name = isset($page_names[$current_page]) ? $page_names[$current_page] : 'Dashboard';
?>

<div class="bg-white shadow-md rounded-md py-4 px-5 h-fit w-fit mb-4">
     <nav class="flex align-middle" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
               <!-- Breadcrumb untuk Dashboard -->
               <li class="inline-flex items-center">
                    <a href="<?= base_url('/views/dashboard.php') ?>" class="inline-flex items-center text-xs font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                         <i class="fa-solid fa-house"></i>
                         <p class="ms-3">
                              Dashboard
                         </p>
                    </a>
               </li>
               <!-- Breadcrumb untuk halaman saat ini -->
               <?php if ($current_page_name !== 'Dashboard') : ?>
                    <li>
                         <div class="flex items-center">
                              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                              </svg>
                              <span class="ms-1 text-xs font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?= htmlspecialchars($current_page_name) ?></span>
                         </div>
                    </li>
               <?php endif; ?>
          </ol>
     </nav>
</div>