<title>Profile | FWeb</title>
<?php include_once 'components/layout-user-top.php' ?>



<div class="bg-white  py-8 px-44 sm:px-8 min-h-full w-full ">
     <div class="border-2 rounded-md mb-8">
          <div class="grid grid-cols-2 sm:grid-cols-1 p-6">
               <div class="sm:mb-4">
                    <div class="font-semibold text-lg">Personal Information</div>
                    <p class="text-sm">Update your personal detail here</p>
               </div>

               <div class="border-2 rounded-md sm:border-none sm:rounded-none">
                    <div class="p-5 sm:p-0">
                         <form action=<?= base_url("/controller/profile.php?action=update") ?> method="POST" enctype="multipart/form-data">
                              <div class="mb-4">
                                   <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                   <input type="username" id="username" name="username" required value="<?= $_SESSION['user']['username'] ?>" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="mb-4">
                                   <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                   <input type="text" id="name" name="name" required value="<?= $_SESSION['user']['name'] ?>" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="mb-4">
                                   <label for="img_profile_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Image</label>
                                   <input id="img_profile_path" name="img_profile_path" type="file" accept=".png, .jpg, .jpeg" class="block w-full file:!text-xs file:!bg-blue-400 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 " aria-describedby="file_input_help">
                                   <p class="mt-1 text-xs text-red-600 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX 5MB).</p>
                              </div>
                              <p id="error" class="text-xs text-red-600"></p>

                              <div class="flex justify-end mt-2 sm:mt-4 gap-2 sm:grid sm:grid-cols-1">
                                   <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                              </div>

                         </form>
                         <?php if (isset($_SESSION['user']['img_profile_path']) && !empty($_SESSION['user']['img_profile_path'])) : ?>
                              <form action=<?= base_url("/controller/profile.php?action=delete_profile_img") ?> method="POST" class="mt-2">
                                   <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
                                   <button type="submit" class=" w-full text-white bg-red-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Delete Profile Image</button>
                              </form>
                         <?php endif; ?>
                    </div>

               </div>
          </div>
     </div>

     <div class="border-2 rounded-md mb-8">
          <div class="grid grid-cols-2 sm:grid-cols-1 p-6">
               <div class="sm:mb-4">
                    <div class="font-semibold text-lg">Password</div>
                    <p class="text-sm">Update your password account here</p>
               </div>

               <div class="border-2 rounded-md sm:border-none sm:rounded-none">
                    <div class="p-5 sm:p-0">
                         <form id="change-password-form" action=<?= base_url("/controller/profile.php?action=change_password") ?> method="POST" onsubmit="return validateFormPassword()">
                              <div class="mb-4">
                                   <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
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
                                   <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
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
                                   <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                   <div class="relative w-full">
                                        <input type="password" id="confirm_password" name="confirm_password" required class="js-confirm-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                             <input class="hidden js-confirm-password-toggle" id="toggle-confirm-password" type="checkbox" />
                                             <label class="rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-confirm-password-label" for="toggle-confirm-password">
                                                  <i class="fas fa-eye"></i>
                                             </label>
                                        </div>
                                   </div>
                                   <p id="error-message" class="text-xs text-red-600"></p>
                              </div>

                              <div class="flex justify-end mt-2 sm:mt-4 sm:grid sm:grid-cols-1">
                                   <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>



<script src=<?= base_url('/js//password-toggle-hide.js') ?>></script>
<script src=<?= base_url('/js/profile.js') ?>></script>


<?php include_once 'components/layout-user-bottom.php' ?>