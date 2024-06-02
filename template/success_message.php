<?php
include_once '../controller/toast_handler.php';
$success_message = get_success_message();
if ($success_message) :
?>

     <div id="toast-undo" class="flex z-40 transition-all duration-300 items-center w-full max-w-xs p-4 text-white bg-green-500 rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 fixed bottom-[-50px] right-5" role="alert">
          <div class="mr-2 rounded-full border p-1 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:bg-gray-800">
               <i class="text-white fa-solid fa-check"></i>
          </div>
          <div class="text-sm font-normal">
               <?= $success_message ?>
          </div>
          <div class="flex items-center ms-auto space-x-2 rtl:space-x-reverse">
               <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-500 text-white rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-undo" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <i class="fa-solid fa-xmark text-sm"></i>
               </button>
          </div>
     </div>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               let toast = document.getElementById('toast-undo');
               setTimeout(() => {
                    toast.classList.replace('bottom-[-50px]', 'bottom-5');
               }, 100);

               setTimeout(() => {
                    toast.classList.add('toast-hidden');
                    setTimeout(() => {
                         toast.remove();
                    }, 600); // Mengatur waktu animasi
               }, 4000); // Mengatur waktu toast menghilang
          });
     </script>
<?php endif; ?>