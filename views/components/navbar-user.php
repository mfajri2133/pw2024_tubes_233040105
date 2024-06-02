<nav class="bg-[#181a1b] sticky w-full z-50 top-0 start-0 border-b !border-gray-500 shadow">
     <div class="flex items-center sm:flex-wrap justify-between py-4 px-11 md:px-7 sm:px-5">
          <a href="<?= base_url("/views/index.php") ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
               <div class="self-center text-3xl font-bold whitespace-nowrap dark:text-white text-[#007bff] mochiy">F<span class="text-white karla">Movie</span></div>
          </a>

          <div class="flex items-center content-center space-x-3 md:order-2 xl:order-2 lg:order-2 rtl:space-x-reverse">
               <div class="uppercase text-white font-medium text-sm poppins sm:hidden">
                    <a href="<?= base_url('/views/movies.php') ?>" class=" tracking-widest mx-3 sm:hidden ">All Movies</a>
                    <a href="<?= base_url('/views/categories.php') ?>" class=" mx-3 tracking-widest sm:hidden ">Categories</a>
                    <a href="<?= base_url('/views/years.php') ?>" class=" mx-3 tracking-widest sm:hidden ">Years</a>
               </div>

               <?php if (login_check()) : ?>
                    <div class="flex items-center ms-3">
                         <button type="button" class="flex text-sm" data-dropdown-toggle="dropdown-user" data-dropdown-offset-skidding="100" data-dropdown-placement="left" aria-expanded="false">
                              <div class="">
                                   <span class="sr-only">Open user menu</span>
                                   <?php if (isset($_SESSION['user']['img_profile_path']) && !empty($_SESSION['user']['img_profile_path'])) : ?>
                                        <img class="w-9 h-9 rounded-full object-cover" src="<?= base_url($_SESSION['user']['img_profile_path']) ?>" alt="user photo">
                                   <?php else : ?>
                                        <img class="w-9 h-9 rounded-full object-cover" src="<?= base_url("/uploads/profile-pict/default-user-picture.png") ?>" alt="Profile image">
                                   <?php endif; ?>
                              </div>
                         </button>
                         <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 w-40" id="dropdown-user">
                              <div class="px-4 py-3" role="none">
                                   <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        <?= $_SESSION['user']['name'] ?>
                                   </p>
                                   <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        <?= $_SESSION['user']['username'] ?>
                                   </p>
                              </div>
                              <ul class="py-1" role="none">
                                   <?php if ($_SESSION['user']['is_admin'] === 1) : ?>
                                        <li>
                                             <a href="<?= base_url('/views/profile.php') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                                        </li>
                                        <li>
                                             <a href="<?= base_url('/views/dashboard.php') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Admin View</a>
                                        </li>
                                   <?php else : ?>
                                        <li>
                                             <a href="<?= base_url('/views/profile-user.php') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                                        </li>
                                   <?php endif; ?>
                                   <li>
                                        <a href="<?= base_url("/lib/logout.php") ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Log out</a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               <?php else : ?>
                    <a href="<?= base_url("/views/login.php") ?>" class="text-white  font-medium text-sm ms-3 tracking-widest uppercase poppins">Sign In</a>
               <?php endif; ?>
               <button data-collapse-toggle="navbar-sticky" type="button" class="h-10 items-center justify-center text-sm text-gray-500 hidden sm:flex" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <div class="flex items-center justify-center w-full h-full">
                         <i class="fa-solid fa-bars-staggered text-[#007bff]"></i>
                    </div>
               </button>
          </div>

          <div class="sm:order-last sm:w-full sm:mt-2.5">
               <form id="search-form" class="m-0 md:w-[200px] sm:w-full w-[500px]">
                    <div class="relative">
                         <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                              </svg>
                         </div>
                         <input id="movie-search" class="block w-full px-4 py-2 ps-10 text-sm text-white border-transparent focus:border-transparent focus:border-b-gray-500 focus:ring-transparent bg-[#181a1b]" placeholder="Search" />
                         <div id="search-results" class="absolute bg-white w-full mt-1 shadow-lg overflow-hidden z-10 hidden">
                              <!-- Hasil Pencaharain akan muncul disini -->
                         </div>
                    </div>
               </form>
          </div>

          <div class="items-center justify-between hidden sm:w-full sm:mt-4" id="navbar-sticky">
               <ul class="flex w-full sm:flex-col  py-0 gap-4  justify-center lg:items-center content-center bg-[#181a1b]  rtl:space-x-reverse flex-row ">
                    <a href="<?= base_url('/views/movies.php') ?>" class=" tracking-widest text-center hidden uppercase text-white font-medium  text-sm poppins sm:block">All Movies</a>
                    <a href="<?= base_url('/views/categories.php') ?>" class="  text-center tracking-widest hidden uppercase text-white font-medium  text-sm poppins sm:block">Categories</a>
                    <a href="<?= base_url('/views/years.php') ?>" class="  text-center tracking-widest hidden uppercase text-white font-medium  text-sm poppins sm:block">Years</a>
               </ul>
          </div>
     </div>

</nav>