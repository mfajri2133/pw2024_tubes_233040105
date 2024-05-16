<?php include_once 'components/layout-top.php' ?>



<div class="grid grid-cols-2 sm:grid-cols-1">
     <div class="flex items-center justify-center sm:mb-4 ">
          <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full ">
               <h4 class="font-bold mb-6 text-center ">Mengubah Informasi Akun</h4>

               <?php include_once '../template/error_message.php'; ?>

               <form action="../controller/change_profile.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                         <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                         <input type="email" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                         <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                         <input type="text" id="name" name="name" value="<?= $_SESSION['user']['name'] ?>" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                         <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " for="img_profile_path">Foto Profile</label>
                         <input id="img_profile_path" name="img_profile_path" type="file" accept=".png, .jpg, .jpeg" class="block w-full file:!text-xs file:!bg-blue-300 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 " aria-describedby="file_input_help">
                         <p class="mt-1 text-xs text-red-600 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX 5MB).</p>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ubah</button>
               </form>
          </div>
     </div>

     <div class="flex items-center justify-center">
          <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full ">
               <h4 class="font-bold mb-6 text-center">Mengubah Password</h4>

               <?php include_once '../template/error_message.php'; ?>

               <form id="change-password-form" action="../controller/change_password.php" method="POST">
                    <div class="mb-4">
                         <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Lama</label>
                         <div class="relative w-full">
                              <input type="password" id="password" name="password" required class="js-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-password-toggle" id="toggle-password" type="checkbox" />
                                   <label class="rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle-password">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>
                         </div>
                    </div>
                    <div class="mb-4">
                         <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Baru</label>
                         <div class="relative w-full">
                              <input type="password" id="new_password" name="new_password" required class="js-new-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-new-password-toggle" id="toggle-new-password" type="checkbox" />
                                   <label class="rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-new-password-label" for="toggle-new-password">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>
                         </div>
                    </div>
                    <div class="mb-4">
                         <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password Baru</label>
                         <div class="relative w-full">
                              <input type="password" id="confirm_password" name="confirm_password" required class="js-confirm-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-confirm-password-toggle" id="toggle-confirm-password" type="checkbox" />
                                   <label class="rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-confirm-password-label" for="toggle-confirm-password">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>
                         </div>
                    </div>


                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ubah</button>
               </form>
          </div>
     </div>
</div>


</div>
</body>

<script src="../js/password.js"></script>

<?php include_once 'components/layout-bottom.php' ?>