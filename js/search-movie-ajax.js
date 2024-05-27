// Ajax search untuk kategori
$(document).ready(function () {
     // Ketika input search diisi
     $("#table-search").on("input", function () {
          // Ambil value dari input search
          var search = $(this).val();
          // Lakukan request ajax jika value tidak kosong
          $.ajax({
               // Menggunakan URL dari controller movie.php
               url: "../controller/movie.php?action=search",
               // Menggunakan method GET
               type: "GET",
               // Dengan tipe data JSON (JavaScript Object Notation)
               dataType: "json",
               // Mengirimkan data search ke server
               data: {
                    search: search,
               },
               // Jika request berhasil
               success: function (response) {
                    // Kosongkan tbody dari table
                    var tbody = $("#table-body");
                    tbody.empty();
                    // Looping data yang ditemukan dari server
                    if (response.length == 0) {
                         var notFoundRow = `
                                   <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 not-found">
                                        <td colspan="4" class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white text-center">
                                             No data found
                                        </td>
                                   </tr>`;
                         tbody.append(notFoundRow);
                    } else {
                         response.forEach(function (movie) {
                              var movieRow = `
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-40 sm:w-72">
                                        <div>
                                             <img src="../${movie.profile_path}" alt="poster" >
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base ">${movie.name}</div>
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base ">${movie.release_date}</div>
                                        </div>
                                   </td>
                                   <td class="px-4 py-3 text-center w-32 sm:flex sm:justify-center sm:items-center sm:space-x-2">
                                        <button type="button" data-modal-target="editModal${movie.id}" data-modal-show="editModal${movie.id}" class="bg-green-600 rounded-full w-10 h-10 text-xs text-white edit-button">
                                             <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" data-modal-target="deleteModal${movie.id}" data-modal-show="deleteModal${movie.id}" class="bg-red-600 rounded-full w-10 h-10 text-xs text-white delete-button">
                                             <i class="fa-solid fa-trash"></i>
                                        </button>
                                   </td>
                              </tr>`;
                              //  tbody diisi dengan data yang ditemukan saat search
                              tbody.append(movieRow);
                         });
                    }
               },
               // Jika request gagal
               error: function (xhr, status, error) {
                    // Log error ke console
                    console.error("Error: " + error);
                    console.error("Status: " + status);
                    console.dir(xhr);
               },
          });
     });

     // Ketika tombol edit diklik
     $(document).on("click", ".edit-button", function () {
          // Ambil target modal yang akan ditampilkan
          var target = $(this).data("modal-target");
          // Tampilkan modal dan overlay
          $("#" + target)
               .removeClass("hidden")
               .addClass("flex items-center justify-center");
          $("#overlay").removeClass("hidden");
     });

     // Ketika tombol delete diklik
     $(document).on("click", ".delete-button", function () {
          // Ambil target modal yang akan ditampilkan
          var target = $(this).data("modal-target");
          // Tampilkan modal dan overlay
          $("#" + target)
               .removeClass("hidden")
               .addClass("flex items-center justify-center");
          $("#overlay").removeClass("hidden");
     });

     // Ketika tombol close modal diklik
     $(document).on("click", ".close-modal", function () {
          // Ambil target modal yang akan ditutup
          var target = $(this).data("modal-hide");
          // Tutup modal dan overlay
          $("#" + target).addClass("hidden");
          $("#overlay").addClass("hidden");
          // Reset formulir
     });
});
