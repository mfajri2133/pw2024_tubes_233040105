<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'pw2024_tubes_233040105';
$user = 'root';
$pass = '123123123';

try {
     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $json = '[
          {
               "name": "Civil War",
               "director": "Alex Garland",
               "producer": "Andrew Macdonald, Allon Reich, Gregory Goodman",
               "duration": 109,
               "description": "In the near future, a group of war journalists attempt to survive while reporting the truth as the United States stands on the brink of civil war.",
               "release_date": "2024-04-10",
               "trailer_url": "https://youtu.be/aDyQxtg0V2w?si=JmD6SO2mpxUMxkLl",
               "categories": [23, 15, 30]
          },
          {
               "name": "Godzilla x Kong: The New Empire",
               "director": "Adam Wingard",
               "producer": "Thomas Tull, Jon Jashni, Brian Rogers, Mary Parent, Alex Garcia, Eric McLeod",
               "duration": 115,
               "description": "Following their explosive showdown, Godzilla and Kong must reunite against a colossal undiscovered threat hidden within our world, challenging their very existence – and our own.",
               "release_date": "2024-04-27",
               "trailer_url": "https://youtu.be/lV1OOlGwExM?si=Pgp6CT7elevyvBaF",
               "categories": [16, 33, 15]
          },
          {
               "name": "Pacific Rim",
               "director": "Guillermo del Toro",
               "producer": "Guillermo del Toro, Thomas Tull, Jon Jashni, Mary Parent",
               "duration": 131,
               "description": "As war between humankind and monstrous sea creatures wages on, a former pilot and a trainee are paired up to drive a seemingly obsolete special weapon in a desperate effort to save the world.",
               "release_date": "2013-07-11",
               "trailer_url": "https://youtu.be/5guMumPFBag?si=OsKd0Im3zXnXvyQU",
               "categories": [16, 15, 33]
          },
          {
               "name": "Iron Man 3",
               "director": "Shane Black",
               "producer": "Kevin Feige",
               "duration": 130,
               "description": "When Tony Stark’s world is torn apart by a formidable terrorist called the Mandarin, he starts an odyssey of rebuilding and retribution.",
               "release_date": "2013-04-18",
               "trailer_url": "https://youtu.be/Ke1Y3P9D0Bc?si=9rVnsg46_BqYW2jF",
               "categories": [16, 33, 15]
          },
          {
               "name": "Avatar: The Way of Water",
               "director": "James Cameron",
               "producer": "James Cameron, Jon Landau",
               "duration": 192,
               "description": "Set more than a decade after the events of the first film, learn the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.",
               "release_date": "2022-12-14",
               "trailer_url": "https://youtu.be/d9MyW72ELq0?si=yVg1QQN7UBQ3GaGJ",
               "categories": [16, 33, 15]
          },
          {
               "name": "Love",
               "director": "Gaspar Noé",
               "producer": "Vincent Maraval, Brahim Chioua, Gaspar Noé, Edouard Weil, Genevieve Lemal, Rodrigo Teixeira",
               "duration": 134,
               "description": "Murphy is an American living in Paris who enters a highly sexually and emotionally charged relationship with the unstable Electra. Unaware of the seismic effect it will have on their relationship, they invite their pretty neighbor into their bed.",
               "release_date": "2015-07-06",
               "trailer_url": "https://youtu.be/mR4JLD84RBo?si=sUUPLmFbJFoauFOR",
               "categories": [12, 23]
          },
          {
               "name": "American Gangster",
               "director": "Ridley Scott",
               "producer": "Ridley Scott, Brian Grazer",
               "duration": 157,
               "description": "Following the death of his employer and mentor, Bumpy Johnson, Frank Lucas establishes himself as the number one importer of heroin in the Harlem district of Manhattan. He does so by buying heroin directly from the source in South East Asia and he comes up with a unique way of importing the drugs into the United States. Partly based on a true story.",
               "release_date": "2007-11-02",
               "trailer_url": "https://youtu.be/BV_nssS6Zkg?si=RsU71vdIDEXPn_9A",
               "categories": [10, 23]
          }
     ]';

     // Decode JSON
     $movies = json_decode($json, true);

     if (is_array($movies)) {
          foreach ($movies as $movie) {
               // Insert movie data into movies table
               $stmt = $pdo->prepare("INSERT INTO movies (name, director, producer, duration, description, release_date, trailer_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
               $stmt->execute([
                    $movie['name'],
                    $movie['director'],
                    $movie['producer'],
                    $movie['duration'],
                    $movie['description'],
                    $movie['release_date'],
                    $movie['trailer_url']
               ]);

               // Get the last inserted movie ID
               $movie_id = $pdo->lastInsertId();

               // Insert categories into movie_categories table
               if (isset($movie['categories']) && is_array($movie['categories'])) {
                    foreach ($movie['categories'] as $category_id) {
                         $stmt = $pdo->prepare("INSERT INTO movie_categories (movie_id, category_id) VALUES (?, ?)");
                         $stmt->execute([$movie_id, $category_id]);
                    }
               }
          }

          echo "Movies and categories inserted successfully.";
     } else {
          echo "Failed to decode JSON.";
     }
} catch (PDOException $e) {
     echo 'Connection failed: ' . $e->getMessage();
}
