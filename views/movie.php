<title>Movie movie | FWeb</title>
<?php include_once 'components/layout-top.php' ?>
<?php include_once '../lib/general.php' ?>
<?php include_once '../lib/connection.php' ?>
<?php include_once '../lib/movie.php' ?>
<?php include_once '../lib/category.php' ?>

<?php
$movies = fetchMovies();
$categories = fetchCategories();

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
               <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-72 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 sm:w-[294px]" placeholder="Search for movie movie name" data-action="search">
          </div>
     </div>

     <div class="sm:overflow-x-auto md:overflow-x-auto lg:overflow-x-auto">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
               <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr>
                         <th scope="col" class="px-6 py-3 sm:px-8 text-center border-b border-r w-40 sm:w-72">
                              Poster
                         </th>
                         <th scope="col" class="px-6 py-3 sm:px-8 text-center border-b border-r w-64 sm:w-72">
                              Title
                         </th>
                         <th scope="col" class="px-6 py-3 sm:px-8 text-center border-b border-r w-64 sm:w-72">
                              Release date
                         </th>
                         <th scope="col" class="px-4 py-3 text-center w-32 border-b ">
                              <button type="button" data-modal-target="addModal" data-modal-show="addModal" class="bg-blue-600 p-2 text-xs mx-auto rounded-md text-white flex items-center">
                                   <i class="fa-solid fa-plus me-1"></i>
                                   <span>
                                        Add
                                   </span>
                              </button>
                         </th>
                    </tr>
               </thead>
               <tbody id="table-body">
                    <?php if (empty($movies)) : ?>
                         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                              <td colspan="4" class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white text-center">
                                   No data found
                              </td>
                         </tr>
                    <?php else : ?>
                         <?php foreach ($movies as $movie) : ?>
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-40 sm:w-72">
                                        <div>
                                             <img src="<?= base_url($movie['poster_path'])  ?>" alt="Poster">
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base "><?= htmlspecialchars($movie['name']) ?></div>
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base ">
                                                  <?php
                                                  $release_date = new DateTime($movie['release_date']);
                                                  echo $release_date->format('j F Y');
                                                  ?>
                                             </div>
                                        </div>
                                   </td>
                                   <td class="px-4 py-3 text-center w-32">
                                        <button type="button" data-modal-target="editModal<?= $movie['id'] ?>" data-modal-show="editModal<?= $movie['id'] ?>" class="bg-green-600 rounded-full w-10 h-10 text-xs text-white">
                                             <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" data-modal-target="deleteModal<?= $movie['id'] ?>" data-modal-show="deleteModal<?= $movie['id'] ?>" class="bg-red-600 rounded-full w-10 h-10 text-xs text-white">
                                             <i class="fa-solid fa-trash"></i>
                                        </button>
                                   </td>
                              </tr>

                              <!-- Modal Menghapus -->
                              <div id="deleteModal<?= $movie['id'] ?>" tabindex="-1" class="fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto">
                                   <div class="relative w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                             <!-- Modal header -->
                                             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                  <h3 class="text-xl font-medium text-gray-900 dark:text-white">Delete admin</h3>
                                                  <button type="button" class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteModal<?= $movie['id'] ?>">
                                                       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                       </svg>
                                                       <span class="sr-only">Close modal</span>
                                                  </button>
                                             </div>
                                             <!-- Modal body -->
                                             <form action="<?= base_url('/controller/movie.php?action=delete') ?>" method="POST" class="m-0">
                                                  <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                                  <div class="p-4 md:p-5 space-y-4">
                                                       <p class="text-gray-800 dark:text-white text-sm">Are you sure you want to remove the <b><?= htmlspecialchars($movie['name']) ?></b> movie?</p>
                                                  </div>
                                                  <!-- Modal footer -->
                                                  <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                       <button type="submit" class="text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ya</button>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>

                              <!-- Modal edit -->
                              <div id="editModal<?= $movie['id'] ?>" tabindex="-1" class="modal fixed inset-0 z-50 hidden flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto">
                                   <div class="relative w-full max-w-[38rem] max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                             <!-- Modal header -->
                                             <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                  <h3 class="text-xl font-medium text-gray-900 dark:text-white">Update movie</h3>
                                                  <button type="button" class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editModal<?= $movie['id'] ?>">
                                                       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                       </svg>
                                                       <span class="sr-only">Close modal</span>
                                                  </button>
                                             </div>

                                             <!-- Modal body -->
                                             <form action="<?= base_url('/controller/movie.php?action=update') ?>" method="POST" class="m-0" enctype="multipart/form-data">
                                                  <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                                  <div class="p-5">
                                                       <div class="grid grid-cols-3 sm:grid-cols-2 gap-2 mb-4">
                                                            <div>
                                                                 <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                                                 <input type="text" id="name" name="name" value="<?= htmlspecialchars($movie['name']) ?>" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            </div>
                                                            <div>
                                                                 <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                                                                 <input type="number" id="duration" name="duration" value="<?= htmlspecialchars($movie['duration']) ?>" required placeholder=" (in minutes)" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            </div>
                                                            <?php
                                                            // Ambil tanggal dari database
                                                            $release_date = $movie['release_date'];

                                                            // Konversi tanggal dari format YYYY-MM-DD ke format lain, misalnya MM/DD/YYYY
                                                            $date = new DateTime($release_date);
                                                            $formatted_date = $date->format('m/d/Y');
                                                            ?>
                                                            <div class="sm:col-span-2">
                                                                 <label for="release_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release Date</label>
                                                                 <div class="relative max-w-sm">
                                                                      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                                           <i class="fa-regular fa-calendar-days"></i>
                                                                      </div>
                                                                      <input datepicker datepicker-buttons datepicker-autoselect-today type="text" id="release_date" name="release_date" value="<?= $formatted_date ?>" required class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="grid grid-cols-2 gap-2 mb-4">
                                                            <div>
                                                                 <label for="director" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Director</label>
                                                                 <input type="text" id="director" name="director" value="<?= htmlspecialchars($movie['director']) ?>" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            </div>
                                                            <div>
                                                                 <label for="producer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producer</label>
                                                                 <input type="text" id="producer" name="producer" value="<?= htmlspecialchars($movie['producer']) ?>" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            </div>
                                                       </div>

                                                       <?php
                                                       $movieCategoryIds = fetchMovieCategoryIds($movie['id']);
                                                       ?>

                                                       <div class="mb-4">
                                                            <div>
                                                                 <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category <p class="text-xs text-red-600 font-normal">*bisa memilih lebih dari 1</p></label>
                                                                 <select id="categories" name="categories[]" required multiple class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                      <?php foreach ($categories as $category) : ?>
                                                                           <option value="<?= $category['id'] ?>" <?= in_array($category['id'], $movieCategoryIds) ? 'selected' : '' ?>><?= $category['name'] ?></option>
                                                                      <?php endforeach; ?>
                                                                 </select>
                                                            </div>
                                                       </div>

                                                       <div class="mb-4">
                                                            <label for="poster_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster Image</label>
                                                            <input id="poster_path" name="poster_path" type="file" accept=".png, .jpg, .jpeg" class="block w-full file:!text-xs file:!bg-blue-400 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help">
                                                            <p class="mt-1 text-xs text-red-600 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX 5MB).</p>
                                                       </div>

                                                       <div class="mb-4">
                                                            <label for="trailer_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Trailer</label>
                                                            <input type="url" id="trailer_url" name="trailer_url" placeholder="https://example.com" pattern="https://.*" value="<?= isset($movie['trailer_url']) ? htmlspecialchars($movie['trailer_url']) : '' ?>" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                       </div>

                                                       <div class="mb-4">
                                                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie Description</label>
                                                            <textarea id="description" name="description" rows="4" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write description movie here..."><?= htmlspecialchars($movie['description']) ?></textarea>
                                                       </div>

                                                       <div class="flex justify-end">
                                                            <button type="submit" id="submit-button" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                 Update Movie
                                                            </button>
                                                       </div>
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
</div>

<!-- Modal Menambahkan -->
<div id="addModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
     <div class="relative p-4 w-full max-w-[38rem] max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
               <!-- Modal header -->
               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                         Add New Movie
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addModal">
                         <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                         </svg>
                         <span class="sr-only">Close modal</span>
                    </button>
               </div>
               <!-- Modal body -->
               <form method="POST" action="../controller/movie.php?action=create" class="m-0" enctype="multipart/form-data">
                    <div class="p-5">
                         <div class="grid grid-cols-3 sm:grid-cols-2 gap-2 mb-4">
                              <div>
                                   <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tittle</label>
                                   <input type="text" id="name" name="name" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div>
                                   <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                                   <input type="number" id="duration" name="duration" required placeholder=" (in minutes)" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div class="sm:col-span-2">
                                   <label for="release_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release date</label>
                                   <div class="relative max-w-sm">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                             <i class="fa-regular fa-calendar-days"></i>
                                        </div>
                                        <input datepicker datepicker-buttons datepicker-autoselect-today required type="text" id="release_date" name="release_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                   </div>
                              </div>
                         </div>

                         <div class="grid grid-cols-2 gap-2 mb-4">
                              <div>
                                   <label for="director" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Director</label>
                                   <input type="text" id="director" name="director" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                              <div>
                                   <label for="producer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producer</label>
                                   <input type="text" id="producer" name="producer" required class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                              </div>
                         </div>

                         <div class="mb-4">
                              <div>
                                   <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category <p class="text-xs text-red-600 font-normal">*bisa memilih lebih dari 1</p></label>

                                   <select id="categories" name="categories[]" required multiple class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <?php foreach ($categories as $category) : ?>
                                             <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                         </div>

                         <div class="mb-4">
                              <label for="poster_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster Image</label>
                              <input id="poster_path" required name="poster_path" type="file" accept=".png, .jpg, .jpeg" class="block w-full file:!text-xs file:!bg-blue-400 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 " aria-describedby="file_input_help">
                              <p class="mt-1 text-xs text-red-600 dark:text-gray-300" id="file_input_help">JPEG, PNG or JPG (MAX 5MB).</p>
                         </div>

                         <div class="mb-4">
                              <label for="trailer_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Trailer (Youtube)</label>
                              <input type="url" id="trailer_url" name="trailer_url" placeholder="https://youtube.com" pattern="https://.*" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                         </div>

                         <div class="mb-4">
                              <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie Description</label>
                              <textarea id="description" required name="description" rows="4" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write description movie here..."></textarea>
                         </div>

                         <div class="flex justify-end">
                              <button type=" submit" id="submit-button" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
<script src="../node_modules/flowbite/dist/datepicker.js"></script>
<script src="<?= base_url('/js/modal.js') ?>"></script>
<script>
     const formatDate = (dateString) => {
          const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          const date = new Date(dateString);
          const day = date.getDate();
          const monthIndex = date.getMonth();
          const year = date.getFullYear();
          return `${day} ${months[monthIndex]} ${year}`;
     };
     // Ajax search untuk kategori
     $(document).ready(function() {
          // Ketika input search diisi
          $("#table-search").on("input", function() {
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
                    success: function(response) {
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
                              response.forEach(function(movie) {
                                   var movieRow = `
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-40 sm:w-72">
                                        <div>
                                             <img src="${movie.poster_path ? '<?= base_url() ?>' + movie.poster_path : '<?= base_url('/uploads/profile-pict/default-user-picture.png') ?>'}" alt="Movie Poster" >
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base ">${movie.name}</div>
                                        </div>
                                   </td>
                                   <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white border-r w-64 sm:w-72">
                                        <div class="ps-3">
                                             <div class="text-base">${formatDate(movie.release_date)}</div>
                                        </div>
                                   </td>
                                   <td class="px-4 py-3 text-center w-32">
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
                    error: function(xhr, status, error) {
                         // Log error ke console
                         console.error("Error: " + error);
                         console.error("Status: " + status);
                         console.dir(xhr);
                    },
               });
          });

          // Ketika tombol edit diklik
          $(document).on("click", ".edit-button", function() {
               // Ambil target modal yang akan ditampilkan
               var target = $(this).data("modal-target");
               // Tampilkan modal dan overlay
               $("#" + target)
                    .removeClass("hidden")
                    .addClass("flex items-center justify-center");
               $("#overlay").removeClass("hidden");
          });

          // Ketika tombol delete diklik
          $(document).on("click", ".delete-button", function() {
               // Ambil target modal yang akan ditampilkan
               var target = $(this).data("modal-target");
               // Tampilkan modal dan overlay
               $("#" + target)
                    .removeClass("hidden")
                    .addClass("flex items-center justify-center");
               $("#overlay").removeClass("hidden");
          });

          // Ketika tombol close modal diklik
          $(document).on("click", ".close-modal", function() {
               // Ambil target modal yang akan ditutup
               var target = $(this).data("modal-hide");
               // Tutup modal dan overlay
               $("#" + target).addClass("hidden");
               $("#overlay").addClass("hidden");
               // Reset formulir
          });
     });
</script>




<?php include_once 'components/layout-bottom.php' ?>