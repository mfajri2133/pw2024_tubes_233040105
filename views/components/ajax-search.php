<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     $(document).ready(function() {
          $('#movie-search').on('input', function() {
               var query = $(this).val();
               if (query.length > 0) {
                    $.ajax({
                         url: '../controller/general.php',
                         type: 'GET',
                         dataType: 'json',
                         data: {
                              search_type: 'movie',
                              query: query,
                              limit: 5,
                              offset: 0
                         },
                         success: function(response) {
                              var resultsContainer = $('#search-results');
                              resultsContainer.empty();
                              if (response.length === 0) {
                                   resultsContainer.append('<p class="text-black p-3">No movies found.</p>');
                              } else {
                                   response.forEach(function(movie) {
                                        var movieCard = `
                              <a href="movie_detail.php?id=${movie.id}" class="block p-3 hover:bg-gray-200">
                                   <div class="flex items-center">
                                        <img class="w-10 h-10 object-cover rounded" src="<?= base_url('${movie.poster_path}') ?>" alt="${movie.name}" />
                                        <div class="ml-3">
                                             <h3 class="text-sm font-bold">${movie.name} (${new Date(movie.release_date).getFullYear()})</h3>
                                        </div>
                                   </div>
                              </a>`;
                                        resultsContainer.append(movieCard);
                                   });
                                   resultsContainer.append('<a href="search_results.php?query=' + query + '" class="block text-center text-blue-500 p-3 hover:bg-gray-200">See All</a>');
                              }
                              resultsContainer.removeClass('hidden');
                         },
                         error: function(xhr, status, error) {
                              console.error("Error: " + error);
                              console.error("Status: " + status);
                              console.dir(xhr);
                         }
                    });
               } else {
                    $('#search-results').addClass('hidden');
               }
          });

          $(document).on('click', function(event) {
               if (!$(event.target).closest('#search-results').length && !$(event.target).is('#search-results')) {
                    $('#search-results').addClass('hidden');
               } else {
                    $('#search-results').removeClass('hidden');
               }
          });
     });
</script>