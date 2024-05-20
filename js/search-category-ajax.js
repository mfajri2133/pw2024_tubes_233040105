// Ajax search untuk kategori
$(document).ready(function () {
     // Ketika input search diisi
     $("#table-search").on("input", function () {
          // Ambil value dari input search
          var search = $(this).val();
          // Lakukan request ajax jika value tidak kosong
          $.ajax({
               // Menggunakan URL dari controller category.php
               url: "../controller/category.php?action=search",
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
                    response.forEach(function (category) {
                         var categoryRow = `
                         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white border-r sm:w-72">
                                   <div class="ps-3">
                                        <div class="text-base ">${category.name}</div>
                                   </div>
                              </td>
                              <td class="px-4 py-4 text-center w-24">
                                   <button type="button" data-modal-target="editModal${category.id}" data-modal-show="editModal${category.id}" class="bg-green-600 rounded-full w-10 h-10 text-xs text-white edit-button">
                                        <i class="fa-solid fa-pen"></i>
                                   </button>
                                   <button type="button" data-modal-target="deleteModal${category.id}" data-modal-show="deleteModal${category.id}" class="bg-red-600 rounded-full w-10 h-10 text-xs text-white delete-button">
                                        <i class="fa-solid fa-trash"></i>
                                   </button>
                              </td>
                         </tr>`;
                         //  tbody diisi dengan data yang ditemukan saat search
                         tbody.append(categoryRow);
                    });
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
     });
});

$(document).ready(function () {
     // Ketika tombol close modal diklik
     $(document).on("click", ".close-modal", function () {
          // Ambil target modal yang akan ditutup
          var target = $(this).data("modal-hide");
          // Tutup modal dan overlay
          $("#" + target).addClass("hidden");
          $("#overlay").addClass("hidden");
          // Reset formulir
          resetForm($("#" + target));
     });

     // Fungsi untuk mereset formulir
     function resetForm(modal) {
          // Dapatkan semua elemen input dalam modal
          var inputs = modal.find("input");
          // Untuk setiap elemen input, set nilai defaultnya
          inputs.each(function () {
               $(this).val($(this).prop("defaultValue"));
          });
     }
});
