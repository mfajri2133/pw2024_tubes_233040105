<?php
include_once '../helpers/users.php';
start_session();

if (login_check()) {
     redirect_to("dashboard");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign up | FWeb</title>
     <link rel="stylesheet" href="<?= base_url("/css/output.css") ?>">

</head>

<body>
     <div class="bg-gray-100 flex items-center justify-center h-screen">
          <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full sm:m-4">
               <h2 class="text-2xl font-bold mb-6 text-center ">Sign up</h2>

               <?php include_once "../template/error_message.php" ?>
               <?php include_once "../template/success_message.php" ?>

               <form action="../controller/auth.php?action=register" method="POST" onsubmit="return validateForm()">

                    <div class="mb-4">
                         <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                         <input type="name" id="name" name="name" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                         <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                         <input type="username" id="username" name="username" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                         <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
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
                         <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                         <div class="relative w-full">
                              <input type="password" id="confirm_password" name="confirm_password" required class="js-new-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-new-password-toggle" id="toggle-new-password" type="checkbox" />
                                   <label class="rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-new-password-label" for="toggle-new-password">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>
                         </div>
                         <p id="error-message" class="text-xs text-red-600"></p>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
               </form>
               <p class="mt-4 text-sm text-gray-600 text-center">Already have an account? <a href="login.php" class="text-indigo-600 hover:text-indigo-500">Sign in</a></p>
          </div>
     </div>
</body>


<script src="<?= base_url("/js/password-toggle-hide.js") ?>"></script>
<script src="<?= base_url("/js/validate-form-password.js") ?> "></script>
<script src="<?= base_url("/js/fontawesome-loader.js") ?>"></script>
<script src="<?= base_url("/node_modules/flowbite/dist/flowbite.min.js") ?>"></script>

</html>