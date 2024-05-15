<?php
// Tentukan halaman aktif
$current_page = "dashboard"; // Ganti dengan halaman yang sedang aktif

// Daftar halaman dan teks breadcrumb
$pages = [
     "dashboard" => "Dashboard",
     "profile" => "Profile",
     "roles" => "Roles",
     "admin" => "Admin",
     "users" => "Users"
     // "movies" => "Movies",
     // "category_movies" => "Movie Category",
];

?>

<div class="bg-white shadow-md rounded-md p-6 h-fit w-fit mb-4">
     <nav class="flex align-middle" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
               <?php foreach ($pages as $page_key => $page_text) : ?>
                    <?php if ($page_key === $current_page) : ?>
                         <li aria-current="page">
                              <div class="flex items-center">
                                   <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                   </svg>
                                   <span class="ms-1 text-xs font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?= $page_text ?></span>
                              </div>
                         </li>
                    <?php else : ?>
                         <li class="inline-flex items-center">
                              <a href="#" class="inline-flex items-center text-xs font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                   <?= $page_text ?>
                              </a>
                         </li>
                    <?php endif; ?>
               <?php endforeach; ?>
          </ol>
     </nav>
</div>