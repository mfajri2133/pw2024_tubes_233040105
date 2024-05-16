<?php include_once 'components/layout-top.php' ?>
<?php include_once '../lib/user.php' ?>
<?php
$users = getUsers();
?>


<div class="bg-white shadow-md rounded-md p-8 w-full">
     <div class="flex items-center justify-end space-x-4 pb-4 bg-white dark:bg-gray-900">
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative">
               <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
               </div>
               <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 sm:w-full" placeholder="Search for users name">
          </div>
     </div>

     <div class="sm:overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
               <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr>
                         <th scope="col" class="px-6 py-7 sm:px-8 text-center border-b border-r">
                              Name
                         </th>
                         <th scope="col" class="px-6 py-3 text-center border-b border-r">
                              Email
                         </th>
                         <th scope="col" class="px-4 py-3 text-center w-32 border-b ">
                              Action
                         </th>
                    </tr>
               </thead>
               <tbody id="user-table-body">
                    <?php foreach ($users as $user) : ?>
                         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <td class="px-6 py-4  flex items-center text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                   <?php if (!empty($user['img_profile_path'])) : ?>
                                        <img class="w-10 h-10 rounded-full object-cover" src="<?= base_url($user['img_profile_path']) ?>" alt="Profile image">
                                   <?php else : ?>
                                        <img class="w-10 h-10 rounded-full object-cover" src="../uploads/default-user-picture.png" alt="Profile image">
                                   <?php endif; ?>
                                   <div class="ps-3">
                                        <div class="text-base "><?= htmlspecialchars($user['name']) ?></div>
                                   </div>
                              </td>
                              <td class="px-6 py-4 bg-gray-50 border-r sm:w-72">
                                   <div class="font-normal text-gray-500"><?= htmlspecialchars($user['email']) ?></div>
                              </td>
                              <td class="px-4 py-4 text-center w-24">
                                   <button type="button" data-modal-target="deleteUserModal<?= $user['id'] ?>" data-modal-show="deleteUserModal<?= $user['id'] ?>" class="bg-red-500 p-2 text-xs mx-1.5 rounded-full text-white">
                                        <i class="fa-solid fa-user-slash"></i>
                                   </button>
                              </td>
                         </tr>

                         <div id="deleteUserModal<?= $user['id'] ?>" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                              <div class="relative w-full max-w-md max-h-full">
                                   <!-- Modal content -->
                                   <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                             <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                                  Delete User
                                             </h3>
                                             <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteUserModal<?= $user['id'] ?>">
                                                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                  </svg>
                                                  <span class="sr-only">Close modal</span>
                                             </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="../controller/delete_user.php" method="POST">
                                             <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                             <div class="p-4 md:p-5 space-y-4">
                                                  <p class="text-gray-800 dark:text-white text-sm">Anda yakin ingin menghapus user <?= htmlspecialchars($user['name']) ?>?</p>
                                             </div>

                                             <!-- Modal footer -->
                                             <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                  <button type="submit" class=" text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ya</button>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </tbody>
          </table>
     </div>

     <nav aria-label="Page navigation" class="pt-3">
          <ul class="flex items-center justify-end -space-x-px h-8 text-sm">
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                         <span class="sr-only">Previous</span>
                         <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                         </svg>
                    </a>
               </li>
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
               </li>
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
               </li>
               <li>
                    <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
               </li>
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
               </li>
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
               </li>
               <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                         <span class="sr-only">Next</span>
                         <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                         </svg>
                    </a>
               </li>
          </ul>
     </nav>
</div>


<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
          // Event delegation for search
          $('#table-search-users').on('input', function() {
               var search = $(this).val();
               $.ajax({
                    url: '../controller/search_users.php',
                    type: 'GET',
                    data: {
                         search: search
                    },
                    success: function(response) {
                         var tbody = $('#user-table-body');
                         tbody.empty();
                         response.forEach(function(user) {
                              var userRow = `<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 flex items-center text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                <img class="w-10 h-10 rounded-full object-cover" src="${user.img_profile_path ? '<?= base_url() ?>' + user.img_profile_path : '../uploads/user-2935527_1920.png'}" alt="Profile image">
                                <div class="ps-3">
                                    <div class="text-base ">${user.name}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-gray-50 border-r sm:w-72">
                                <div class="font-normal text-gray-500">${user.email}</div>
                            </td>
                            <td class="px-4 py-4 text-center w-24">
                                <button type="button" data-modal-target="deleteUserModal${user.id}" data-modal-show="deleteUserModal${user.id}" class="delete-button bg-red-500 p-2 text-xs mx-1.5 rounded-full text-white">
                                    <i class="fa-solid fa-user-slash"></i>
                                </button>
                            </td>
                        </tr>
                        <div id="deleteUserModal${user.id}" tabindex="-1" class="absolute top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                            Delete User
                                        </h3>
                                        <button type="button" class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteUserModal${user.id}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <form action="../controller/delete_user.php" method="POST">
                                        <input type="hidden" name="id" value="${user.id}">
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-gray-800 dark:text-white text-sm">Anda yakin ingin menghapus user ${user.name}?</p>
                                        </div>
                                        <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit" class="text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ya</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>`;
                              tbody.append(userRow);
                         });
                    }
               });
          });

          // Event delegation for opening modal
          $(document).on('click', '.delete-button', function() {
               var target = $(this).data('modal-target');
               $('#' + target).removeClass('hidden');
          });

          // Event delegation for closing modal
          $(document).on('click', '.close-modal', function() {
               var target = $(this).data('modal-hide');
               $('#' + target).addClass('hidden');
          });
     });
</script>


<?php include_once 'components/layout-bottom.php' ?>