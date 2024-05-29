<nav class="bg-[#181a1b] dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b !border-[#fff] dark:border-gray-600 shadow">
     <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href=<?= base_url("/views/index.php") ?> class="flex items-center space-x-3 rtl:space-x-reverse">
               <div class="self-center text-3xl font-bold whitespace-nowrap dark:text-white text-[#007bff] poppins">F<span class="text-white">Web Movie</span></div>
          </a>

          <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
               <?php if (login_check()) : ?>
                    <div class="flex items-center">
                         <button type="button" class="flex text-sm " data-dropdown-offset-skidding="80" data-dropdown-placement="left" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                              <div>
                                   <span class="sr-only">Open user menu</span>
                                   <?php if (isset($_SESSION['user']['img_profile_path']) && !empty($_SESSION['user']['img_profile_path'])) : ?>
                                        <img class="w-9 h-9 rounded-full object-cover" src=<?= base_url($_SESSION['user']['img_profile_path']) ?> alt="user photo">
                                   <?php else : ?>
                                        <img class="w-9 h-9 rounded-full object-cover" src=<?= base_url("/uploads/profile-pict/default-user-picture.png") ?> alt="Profile image">
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
                                             <a href=<?= base_url('/views/dashboard.php') ?> class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Admin View</a>
                                        </li>
                                   <?php else : ?>
                                        <li>
                                             <a href="<?= base_url('/views/profile-user.php') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                                        </li>
                                   <?php endif; ?>
                                   <li>
                                        <a href=<?= base_url("/lib/logout.php") ?> class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Log out</a>
                                   </li>
                              </ul>
                         </div>
                    </div>
               <?php else : ?>
                    <a href="<?= base_url("/views/login.php") ?>" class="text-white bg-[#007bff] hover:bg-[#fff] hover:text-[#007bff]  font-medium rounded-lg text-sm px-4 py-2 text-center ">Sign In</a>
               <?php endif; ?>
               <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <div class="w-5 h-5" aria-hidden="true">
                         <i class="fa-solid fa-bars-staggered text-[#007bff] "></i>
                    </div>
               </button>
          </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 poppins" id="navbar-sticky">
               <ul class="flex flex-col sm:p-4 py-0 px-4 mt-4 justify-center lg:items-center content-center font-medium border border-[#fff]  rounded-lg bg-[#181a1b] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                         <form id="search-form" class="max-w-lg sm:max-w-md">
                              <label for="movie-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                              <div class="relative">
                                   <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                   </div>
                                   <input id="movie-search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Movie" required />
                                   <div id="search-results" class="absolute bg-white w-full mt-1 rounded-lg shadow-lg overflow-hidden z-10 hidden">
                                        <!-- Hasil Pencaharain akan muncul disini -->
                                   </div>
                              </div>
                         </form>
                    </li>
                    <li>
                         <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-white rounded  md:border-0  md:p-0 md:w-auto ">Menu <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                              </svg></button>
                         <!-- Dropdown menu -->
                         <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                              <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                   <li>
                                        <a href="<?= base_url('/views/index.php') ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Home</a>
                                   </li>
                                   <li>
                                        <a href="<?= base_url('/views/movies.php') ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Movies</a>
                                   </li>
                                   <li>
                                        <a href="<?= base_url('/views/categories.php') ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Categories</a>
                                   </li>
                              </ul>
                         </div>
                    </li>
               </ul>
          </div>
     </div>
</nav>