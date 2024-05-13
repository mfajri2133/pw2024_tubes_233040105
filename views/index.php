<?php
include_once '../helpers/users.php';
start_session();


?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Index</title>
     <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
     <div class="bg-white shadow-md rounded-md p-8 max-w-md w-full">
          <h2 class="text-2xl font-bold mb-6 text-center">Index user</h2>
          <h1>selamat datang dihalaman index</h1>

          <?php if (login_check()) : ?>
               <a href="../lib/logout.php" class="w-full bg-red-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Logout</a>
          <?php else : ?>
               <a href="../views/login.php" class="w-full bg-red-500 text-black font-semibold py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">login</a>
          <?php endif; ?>

     </div>
</body>

</html>