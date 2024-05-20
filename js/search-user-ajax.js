// search_users.js

$(document).ready(function() {
     // Event listener untuk input pada form search
     $('#table-search').on('input', function() {
         // Ambil value dari input search
         var search = $(this).val();
         // Lakukan AJAX request
         $.ajax({
             // Menggunakan URL dari search_users.php
             url: '<?= base_url('/controller/search_users.php') ?>',
             // Dengan tipe data GET
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
                 // Looping data yang ditemukan
                 response.forEach(function(user) {
                     var userRow = `
                         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                             <td class="px-6 py-4 flex items-center text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                 <img class="w-10 h-10 rounded-full object-cover" src="${user.img_profile_path ? '<?= base_url() ?>' + user.img_profile_path : '<?php base_url('/uploads/profile-pict/default-user-picture.png') ?>'}" alt="Profile image">
                                 <div class="ps-3">
                                     <div class="text-base ">${user.name}</div>
                                 </div>
                             </td>
                             <td class="px-6 py-4 bg-gray-50 border-r sm:w-72">
                                 <div class="font-normal text-gray-500">${user.email}</div>
                             </td>
                             <td class="px-4 py-4 text-center w-24">
                                 ${user.id == <?= $_SESSION['user']['id'] ?> ? 
                                 `<button type="button" data-modal-target="deleteModal${user.id}" data-modal-show="deleteModal${user.id}" class="bg-gray-300 w-10 h-10 text-xs rounded-full text-gray-500 hidden">
                                     <i class="fa-solid fa-user-slash"></i>
                                 </button>` : 
                                 `<button type="button" data-modal-target="deleteModal${user.id}" data-modal-show="deleteModal${user.id}" class="delete-button bg-red-600 w-10 h-10 text-xs  rounded-full text-white">
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
 