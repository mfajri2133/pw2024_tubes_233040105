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

     <title>Sign in | FWeb</title>
     <link rel="stylesheet" href="<?= base_url("/css/output.css") ?>">
     <link rel="stylesheet" href="<?= base_url("/css/support.css") ?>">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Mochiy+Pop+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
     <div class="bg-[#181a1b] flex flex-col items-center justify-center px-5 h-screen">
          <div class="text-center mb-4">
               <a href="<?= base_url("/views/index.php") ?>" class="">
                    <span class="self-center text-3xl font-bold dark:text-white text-[#007bff] mochiy">F<span class="text-white karla">Movie</span></span>
               </a>
          </div>

          <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full sm:m-4">
               <h2 class="text-2xl font-bold mb-6 text-center ">Sign in</h2>

               <?php include_once '../template/error_message.php'; ?>
               <?php include_once '../template/success_message.php'; ?>

               <form action="<?= base_url("/controller/auth.php?action=login") ?>" method="POST">
                    <div class="mb-4">
                         <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                         <input type="username" id="username" name="username" autocomplete="username" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                         <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                         <div class="relative w-full">

                              <input type="password" id="password" name="password" autocomplete="current-password" required class="js-password block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pr-12">
                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-password-toggle " id="toggle" type="checkbox" />
                                   <label class=" px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>
                         </div>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>

               </form>
               <p class="mt-4 text-sm text-gray-600 text-center">Don’t have an account yet? <a href="register.php" class="text-indigo-600 hover:text-indigo-500">Sign up</a></p>
          </div>
     </div>

     <?php include_once 'components/footer.php' ?>

</body>

<script src=<?= base_url("/js/password-toggle-hide.js") ?>></script>
<script src=<?= base_url("/js/fontawesome-loader.js") ?>></script>
<script src=<?= base_url("/node_modules/flowbite/dist/flowbite.min.js") ?>></script>


</html>