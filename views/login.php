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
                         <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                         <input type="email" id="email" name="email" autocomplete="email" value="<?php echo get_post_data("email") ?>" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                         <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                         <div class="relative w-full">
                              <input type="password" id="password" name="password" autocomplete="current-password" required class="js-password mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 pr-12">

                              <div class="absolute inset-y-0 right-0 flex items-center px-2">
                                   <input class="hidden js-password-toggle " id="toggle" type="checkbox" />
                                   <label class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label " for="toggle">
                                        <i class="fas fa-eye"></i>
                                   </label>
                              </div>

                         </div>
                    </div>
                    <div>
                         <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Login</button>
                    </div>
               </form>
               <p class="mt-4 text-sm text-gray-600 text-center">Don’t have an account yet? <a href="#" class="text-indigo-600 hover:text-indigo-500">Sign up</a></p>
          </div>
     </div>
</body>
<script>
     const passwordToggle = document.querySelector('.js-password-toggle')

     passwordToggle.addEventListener('change', function() {
          const password = document.querySelector('.js-password'),
               passwordLabel = document.querySelector('.js-password-label')

          if (password.type === 'password') {
               password.type = 'text'
               passwordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>'
          } else {
               password.type = 'password'
               passwordLabel.innerHTML = '<i class="fas fa-eye"></i>'
          }

          password.focus()
     })
</script>


<script src="../js/fontawesome-loader.js"></script>
<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

</html>