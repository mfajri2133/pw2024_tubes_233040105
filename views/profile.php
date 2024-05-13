<?php
include_once "../helpers/users.php";
start_session();

if (!login_check()) {
     redirect_to("login");
} else {
     if (!is_admin()) {
          redirect_to("index");
     }
}

fetch_post_data();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard Admin | FWeb</title>
     <link rel="stylesheet" href="../css/output.css">

</head>


<body>
     <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
          <div class="px-3 py-3 lg:px-5 lg:pl-3">
               <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                         <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                              <span class="sr-only">Open sidebar</span>
                              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                              </svg>
                         </button>
                         <div class="flex ms-2 md:me-24">
                              <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">FWeb</span>
                         </div>
                    </div>
                    <div class="flex items-center">
                         <div class="flex items-center">
                              <div>
                                   <button type="button" class="flex text-sm  rounded-full  hover:bg-gray-200" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                                        <p class="self-center px-3">
                                             <?= $_SESSION['user']['name'] ?>
                                        </p>
                                   </button>
                              </div>
                              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 w-40" id="dropdown-user">
                                   <ul class="py-1" role="none">
                                        <li>
                                             <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                                        </li>
                                        <li>
                                             <a href="../lib/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Log out</a>
                                        </li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </nav>

     <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform  bg-white border-r border-gray-200  dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
          <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
               <ul class="space-y-2 font-medium">
                    <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <div class="w-5 h-5 content-center text-center">
                                   <i class="fa-solid fa-film"></i>
                              </div>
                              <span class="ms-3">Movie Category</span>
                         </a>
                    </li>
                    <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <div class="w-5 h-5 content-center text-center">
                                   <i class="fa-regular fa-file-video"></i>
                              </div>
                              <span class="flex-1 ms-3 whitespace-nowrap">Movies</span>
                         </a>
                    </li>
                    <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <div class="w-5 h-5 content-center text-center">
                                   <i class="fa-solid fa-user"></i>
                              </div>
                              <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                         </a>
                    </li>
                    <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <div class="w-5 h-5 content-center text-center">
                                   <i class="fa-solid fa-users-gear"></i>
                              </div>
                              <span class="flex-1 ms-3 whitespace-nowrap">Admin</span>
                         </a>
                    </li>
                    <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                              <div class="w-5 h-5 content-center text-center">
                                   <i class="fa-solid fa-user-gear"></i>
                              </div>
                              <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>
                         </a>
                    </li>
               </ul>
          </div>
     </aside>

     <div class="p-4 ml-64 sm:ml-0 bg-gray-100 ">
          <div class="p-4  border-gray-200  rounded-lg dark:border-gray-700 mt-14 h-screen grid grid-cols-2" style="height: calc(100vh - 5.5rem);">
               <div class="flex items-center justify-center ">
                    <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full sm:m-4">
                         <h4 class="font-bold mb-6 text-center ">Mengubah Informasi Akun</h4>

                         <?php include_once '../template/error_message.php'; ?>

                         <form action="../controller/change_profile.php" method="POST" enctype="multipart/form-data">
                              <div class="mb-4">
                                   <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                   <input type="email" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                              </div>
                              <div class="mb-4">
                                   <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                   <input type="text" id="name" name="name" value="<?= $_SESSION['user']['name'] ?>" class="js-password mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 pr-12">
                              </div>
                              <div class="mb-4">
                                   <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-white " for="img_profile_path">Foto Profile</label>
                                   <input id="img_profile_path" name="img_profile_path" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 " aria-describedby="file_input_help">
                                   <p class="mt-1 text-sm text-red-600 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX 5MB).</p>
                              </div>
                              <div>
                                   <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Ubah</button>
                              </div>
                         </form>
                    </div>
               </div>


          </div>
     </div>
</body>

<script src="../js/fontawesome-loader.js"></script>
<!-- <script src="../js/navbar_admin.js"></script> -->
<script>
     // Ambil elemen-elemen yang dibutuhkan
     const sidebar = document.getElementById('logo-sidebar');
     const sidebarToggleButton = document.querySelector('[data-drawer-toggle="logo-sidebar"]');

     // Fungsi untuk membuka sidebar
     function openSidebar() {
          sidebar.classList.remove('-translate-x-full');
     }

     // Fungsi untuk menutup sidebar
     function closeSidebar() {
          sidebar.classList.add('-translate-x-full');
     }

     // Tambahkan event listener pada tombol sidebar
     sidebarToggleButton.addEventListener('click', () => {
          if (sidebar.classList.contains('-translate-x-full')) {
               openSidebar();
          } else {
               closeSidebar();
          }
     });

     // Tambahkan event listener untuk menutup sidebar saat layar diubah menjadi tampilan dekstop
     window.addEventListener('resize', () => {
          if (window.innerWidth >= 768) {
               openSidebar();
          } else {
               closeSidebar(); // tambahkan penutupan sidebar saat lebar layar kurang dari 768px
          }
     });

     // Tambahkan event listener untuk menutup sidebar saat layar berubah menjadi tampilan mobile
     if (window.innerWidth < 768) {
          closeSidebar();
     }
</script>

<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

</html>