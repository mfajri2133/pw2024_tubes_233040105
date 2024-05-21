// Ajax search untuk kategori
$(document).ready(function () {
     $(document).ready(function () {
          // Ketika input search diisi
          $("#table-search").on("input", function () {
               // Ambil value dari input search
               var search = $(this).val();
               // Lakukan request ajax jika value tidak kosong
               if (search) {
                    $.getJSON(
                         "../controller/category.php?action=search",
                         { search: search },
                         function (response) {
                              // Kosongkan tbody dari table
                              var tbody = $("#table-body").empty();
                              // Looping data yang ditemukan dari server
                              $.each(response, function (index, category) {
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
                         }
                    ).fail(function (xhr, status, error) {
                         // Log error ke console
                         console.error("Error: " + error);
                         console.error("Status: " + status);
                         console.dir(xhr);
                    });
               }
          });

          // Function to show modal
          function showModal(target) {
               $("#" + target)
                    .removeClass("hidden")
                    .addClass("flex items-center justify-center");
               $("#overlay").removeClass("hidden");
          }

          // Function to hide modal
          function hideModal(target) {
               $("#" + target).addClass("hidden");
               $("#overlay").addClass("hidden");
               resetForm($("#" + target));
          }

          // Event delegation for edit and delete buttons
          $(document).on("click", ".edit-button, .delete-button", function () {
               var target = $(this).data("modal-target");
               showModal(target);
          });

          // Close modal when clicking close button or overlay
          $(document).on("click", ".close-modal, #overlay", function () {
               var target =
                    $(this).data("modal-hide") ||
                    $(".modal:visible").attr("id");
               hideModal(target);
          });
     });
});
