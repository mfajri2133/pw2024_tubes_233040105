<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav class="bg-[#181a1b] dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b !border-[#fff] dark:border-gray-600 shadow">
     <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href=<?= base_url("/views/index.php") ?> class="flex items-center space-x-3 rtl:space-x-reverse">
               <div class="self-center text-3xl font-bold whitespace-nowrap dark:text-white text-[#007bff] spacemono">F<span class="text-white">Web Movie</span></div>
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
                    <a href="<?= base_url("/views/login.php") ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
               <?php endif; ?>
               <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <div class="w-5 h-5" aria-hidden="true">
                         <i class="fa-solid fa-bars-staggered text-[#007bff] "></i>
                    </div>
               </button>
          </div>
          <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 spacemono" id="navbar-sticky">
               <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-[#fff] rounded-lg bg-[#181a1b] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                         <a href="<?= base_url('/views/index.php') ?>" class="block py-2 px-3 text-[#ffffffb3] rounded md:p-0 hover:text-[#007bff] <?php echo $current_page == 'index' ? 'text-[#007bff]' : ''; ?>">Home</a>
                    </li>
                    <li>
                         <a href="<?= base_url('/views/about.php') ?>" class="block py-2 px-3 text-[#ffffffb3] rounded md:p-0 <?php echo $current_page == 'about' ? 'text-[#007bff]' : ''; ?>">About</a>
                    </li>
                    <li>
                         <a href="<?= base_url('/views/services.php') ?>" class="block py-2 px-3 text-[#ffffffb3] rounded md:p-0 <?php echo $current_page == 'services' ? 'text-[#007bff]' : ''; ?>">Services</a>
                    </li>
                    <li>
                         <a href="<?= base_url('/views/contact.php') ?>" class="block py-2 px-3 text-[#ffffffb3] rounded md:p-0 <?php echo $current_page == 'contact' ? 'text-[#007bff]' : ''; ?>">Contact</a>
                    </li>
               </ul>
          </div>
     </div>
</nav>