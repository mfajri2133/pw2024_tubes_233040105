<nav class="fixed top-0 z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
     <div>
          <div class="flex items-center justify-between ">
               <div class="flex items-center justify-start rtl:justify-end px-3 py-3 lg:px-5 lg:pl-3">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                         <span class="sr-only">Open sidebar</span>
                         <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                         </svg>
                    </button>
                    <div class="flex ms-2 md:me-24">
                         <a href=<?= base_url('/views/dashboard.php') ?> class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">FWeb</a>
                    </div>
               </div>
               <div class="flex items-center">
                    <button type="button" class="flex text-sm " data-dropdown-offset-skidding="80" data-dropdown-placement="left" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                         <div class="px-5 py-3 hover:bg-gray-100">
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
                              <li>
                                   <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                              </li>
                              <?php if ($_SESSION['user']['is_admin'] === 1) : ?>
                                   <li>
                                        <a href=<?= base_url('/views/index.php') ?> class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">User View</a>
                                   </li>
                              <?php endif; ?>
                              <li>
                                   <a href=<?= base_url("/lib/logout.php") ?> class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Log out</a>
                              </li>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
</nav>