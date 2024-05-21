<title>Admin | FWeb</title>
<?php include_once 'components/layout-top.php' ?>

<?php include_once '../lib/general.php' ?>
<?php include_once '../lib/admin.php' ?>
<?php
$users = fetchAdmin();
?>

<div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>
<div class="bg-white shadow-md rounded-md p-8 w-full">
     <div class="flex items-center justify-end space-x-4 pb-4 bg-white dark:bg-gray-900">
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative">
               <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
               </div>
               <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-72 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 sm:w-[294px]" placeholder="Search for admin name or email">
          </div>
     </div>

     <div class="sm:overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
               <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr>
                         <th scope="col" class="px-6 py-3 sm:px-8 text-center border-b border-r w-64">
                              Name
                         </th>
                         <th scope="col" class="px-6 py-3 text-center border-b border-r w-64">
                              Email
                         </th>
                         <th scope="col" class="px-4 py-3 text-center w-24 border-b ">
                              <button type="button" data-modal-target="addModal" data-modal-show="addModal" class="bg-blue-600 p-2 text-xs mx-auto rounded-md text-white flex items-center">
                                   <i class="fa-solid fa-user-plus me-1"></i>
                                   <span>
                                        Add
                                   </span>
                              </button>
                         </th>
                    </tr>
               </thead>
               <tbody id="table-body">
                    <?php if (empty($users)) : ?>
                         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <td colspan="3" class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white text-center">
                                   No data found
                              </td>
                         </tr>
                    <?php else : ?>
                         <?php foreach ($users as $user) : ?>
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="px-6 py-3  flex items-center text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                        <?php if (!empty($user['img_profile_path'])) : ?>
                                             <img class="w-10 h-10 rounded-full object-cover" src="<?= base_url($user['img_profile_path']) ?>" alt="Profile image">
                                        <?php else : ?>
                                             <img class="w-10 h-10 rounded-full object-cover" src="<?= base_url('/uploads/profile-pict/default-user-picture.png') ?>" alt="Profile image">
                                        <?php endif; ?>
                                        <div class="ps-3">
                                             <div class="text-base "><?= htmlspecialchars($user['name']) ?></div>
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 bg-gray-50 border-r w-64 sm:w-72">
                                        <div class="font-normal text-gray-500"><?= htmlspecialchars($user['email']) ?></div>
                                   </td>
                                   <td class="px-4 py-3 text-center w-24">
                                        <?php if ($user['id'] == $_SESSION['user']['id']) : ?>
                                             <button type="button" data-modal-target="deleteAdminModal<?= $user['id'] ?>" data-modal-show="deleteAdminModal<?= $user['id'] ?>" class="bg-red-600 w-10 h-10 text-xs rounded-full text-white hidden">
                                                  <i class="fa-solid fa-user-slash"></i>
                                             </button>
                                        <?php else : ?>
                                             <button type="button" data-modal-target="deleteAdminModal<?= $user['id'] ?>" data-modal-show="deleteAdminModal<?= $user['id'] ?>" class="bg-red-600 w-10 h-10 text-xs rounded-full text-white">
                                                  <i class="fa-solid fa-user-slash"></i>
                                             </button>
                                        <?php endif; ?>
                                   </td>
                              </tr>

                              <!-- Modal Menghapus -->
                              <div id="deleteAdminModal<?= $user['id'] ?>" tabindex="-1" class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto">
                                   <div class="relative w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                             <!-- Modal header -->
                                             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                  <h3 class="text-xl font-medium text-gray-900 dark:text-white">Delete admin</h3>
                                                  <button type="button" class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteAdminModal<?= $user['id'] ?>">
                                                       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                       </svg>
                                                       <span class="sr-only">Close modal</span>
                                                  </button>
                                             </div>
                                             <!-- Modal body -->
                                             <form action="<?= base_url("/controller/admin.php?action=delete") ?>" method="POST" class="m-0">
                                                  <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                  <div class="p-4 md:p-5 space-y-4">
                                                       <p class="text-gray-800 dark:text-white text-sm">Are you sure you want to delete admin <b><?= htmlspecialchars($user['name']) ?></b>?</p>
                                                  </div>
                                                  <!-- Modal footer -->
                                                  <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                       <button type="submit" class="text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ya</button>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         <?php endforeach; ?>
                    <?php endif; ?>
               </tbody>
          </table>
     </div>

     <!-- Modal Menambahkan -->
     <div id="addModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-md max-h-full">
               <!-- Modal content -->
               <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                         <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                              Add New Admin
                         </h3>
                         <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addModal">
                              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                              </svg>
                              <span class="sr-only">Close modal</span>
                         </button>
                    </div>
                    <!-- Modal body -->
                    <form method="POST" action="<?= base_url('/controller/admin.php?action=create') ?>" onsubmit=" return handleFormSubmit(event)" class="m-0">
                         <div class="p-5">
                              <div class="mb-4">
                                   <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                   <input type="text" id="name" name="name" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="mb-4">
                                   <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                   <input type="email" id="email" name="email" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/modal.js"></script>
<script>
     // Ajax search
     // Event listener untuk input pada form search
     $(document).ready(function() {
          // Event ketika input search diisi
          $('#table-search').on('input', function() {
               // Ambil value dari input search
               var search = $(this).val();
               // Lakukan request AJAX
               $.ajax({
                    // Dengan url dan method dituju
                    url: '../controller/admin.php',
                    type: 'GET',
                    // Dengan tipe data JSON (JavaScript Object Notation)
                    dataType: 'json',
                    // Mengirimkan data search
                    data: {
                         search: search
                    },
                    // Jika sukses
                    success: function(response) {
                         // Kosongkan tbody
                         var tbody = $('#table-body');
                         tbody.empty();
                         // Looping data yang diterima
                         response.forEach(function(user) {
                              var userRow = `
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="px-6 py-4 flex items-center text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                        <img class="w-10 h-10 rounded-full object-cover" src="${user.img_profile_path ? '<?= base_url() ?>' + user.img_profile_path : '<?= base_url('/uploads/profile-pict/default-user-picture.png') ?>'}" alt="Profile image">
                                             <div class="ps-3">
                                                  <div class="text-base ">${user.name}</div>
                                             </div>
                                   </td>
                                   <td class="px-6 py-4 bg-gray-50 border-r sm:w-72">
                                        <div class="font-normal text-gray-500">${user.email}</div>
                                   </td>
                                   <td class="px-4 py-4 text-center w-24">
                                        ${user.id == <?= $_SESSION['user']['id'] ?> ? 
                                        `<button type="button" data-modal-target="deleteAdminModal${user.id}" data-modal-show="deleteAdminModal${user.id}" class="bg-gray-300 w-10 h-10 text-xs rounded-full text-gray-500 hidden">
                                             <i class="fa-solid fa-user-slash"></i>
                                        </button>` : 
                                        `<button type="button" data-modal-target="deleteAdminModal${user.id}" data-modal-show="deleteAdminModal${user.id}" class="delete-button bg-red-600 w-10 h-10 text-xs  rounded-full text-white">
                                             <i class="fa-solid fa-user-slash"></i>
                                        </button>`}
                                   </td>
                              </tr>`;
                              // tbody diisi dengan userRow yang ditemukan saat search
                              tbody.append(userRow);
                         });
                    },
                    // Jika error
                    error: function(xhr, status, error) {
                         // Log error ke console
                         console.error("Error: " + error);
                         console.error("Status: " + status);
                         console.dir(xhr);
                    }
               });
          });

          // Ketika tombol delete ditekan
          $(document).on('click', '.delete-button', function() {
               // Ambil target modal
               var target = $(this).data('modal-target');
               // Tampilkan modal dan overlay
               $('#' + target).removeClass('hidden').addClass('flex items-center justify-center');
               $('#overlay').removeClass('hidden');
          });

          // Ketika tombol close ditekan
          $(document).on('click', '.close-modal', function() {
               // Ambil target modal
               var target = $(this).data('modal-hide');
               // Sembunyikan modal dan overlay
               $('#' + target).addClass('hidden');
               $('#overlay').addClass('hidden');
          });
     });
</script>


<?php include_once 'components/layout-bottom.php' ?>