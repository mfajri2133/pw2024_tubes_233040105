<?php include_once 'components/layout-top.php' ?>
<title>Dashboard | FWeb</title>

<div class="bg-white shadow-md rounded-md p-8 sm:w-auto w-full ">
     <h1>Selamat Datang Admin <?= $_SESSION['user']['name'] ?></h1>
</div>

<div id="change-password-modal" class="fixed z-[9999] inset-0 p-10 sm:p-3 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
     <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
               <!-- Modal header -->
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                         Change Default Password
                    </h3>
               </div>
               <!-- Modal body -->
               <form method="POST" action="<?= base_url('/controller/admin.php?action=change_default_password') ?>" class="m-0" onsubmit="return validateFormPassword()">
                    <div class="p-5">
                         <div class="mb-4">
                              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
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

                         <div class="flex justify-end">
                              <button type="submit" id="submit-button" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                   Save
                              </button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>

<script>
     document.addEventListener('DOMContentLoaded', function() {
          <?php if ($_SESSION['user']['is_new'] == 1) : ?>
               // Show the modal
               document.getElementById('change-password-modal').classList.remove('hidden');
          <?php endif; ?>
     });

     // Password Lama
     const passwordToggle = document.querySelector(".js-password-toggle");
     const passwordInput = document.querySelector(".js-password");
     const passwordLabel = document.querySelector(".js-password-label");

     passwordToggle.addEventListener("change", function() {
          if (passwordInput.type === "password") {
               passwordInput.type = "text";
               passwordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
          } else {
               passwordInput.type = "password";
               passwordLabel.innerHTML = '<i class="fas fa-eye"></i>';
          }
          passwordInput.focus();
     });

     // Konfirmasi Password Baru
     const confirmPasswordToggle = document.querySelector(
          ".js-confirm-password-toggle"
     );
     const confirmPasswordInput = document.querySelector(".js-confirm-password");
     const confirmPasswordLabel = document.querySelector(
          ".js-confirm-password-label"
     );

     confirmPasswordToggle.addEventListener("change", function() {
          if (confirmPasswordInput.type === "password") {
               confirmPasswordInput.type = "text";
               confirmPasswordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
          } else {
               confirmPasswordInput.type = "password";
               confirmPasswordLabel.innerHTML = '<i class="fas fa-eye"></i>';
          }
          confirmPasswordInput.focus();
     });

     function validateFormPassword() {
          var password = document.getElementById("password").value;
          var confirmPassword = document.getElementById("confirm_password").value;
          var errorMessage = "";

          if (password.length < 6) {
               errorMessage = "New password must be at least 6 characters long.";
          } else if (password !== confirmPassword) {
               errorMessage = "New password and confirm password do not match.";
          }

          if (errorMessage) {
               document.getElementById("error-message").innerText = errorMessage;
               return false;
          }
          return true;
     }
</script>


<?php include_once 'components/layout-bottom.php' ?>