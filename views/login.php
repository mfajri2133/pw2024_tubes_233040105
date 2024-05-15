<?php
include_once '../helpers/users.php';
start_session();

if (login_check()) {
     redirect_to("dashboard");
}

fetch_post_data();
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login | FWeb</title>
     <link rel="stylesheet" href="../css/output.css">

</head>

<body>
     <div class="bg-gray-100 flex items-center justify-center h-screen">
          <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full sm:m-4">
               <h2 class="text-2xl font-bold mb-6 text-center ">Login</h2>

               <?php include_once '../template/error_message.php'; ?>

               <form action="../controller/process_login.php" method="POST">
                    <div class="mb-4">
                         <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                         <input type="email" id="email" name="email" autocomplete="email" value="<?php echo get_post_data("email") ?>" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>

               </form>
               <p class="mt-4 text-sm text-gray-600 text-center">Don’t have an account yet? <a href="#" class="text-indigo-600 hover:text-indigo-500">Sign up</a></p>
          </div>
     </div>
</body>

<script src="../js/password.js"></script>
<script src="../js/fontawesome-loader.js"></script>
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

</html>