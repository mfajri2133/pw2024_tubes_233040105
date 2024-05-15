<?php
include_once "../helpers/users.php";
start_session();

if (!login_check()) {
     redirect_to("login");
} else {
     if (!is_admin()) {
          redirect_to("index");
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard Admin | FWeb</title>
     <link rel="stylesheet" href="../css/output.css">

</head>


<body>
     <?php include_once "components/navbar.php" ?>

     <?php include_once "components/sidebar.php" ?>


     <div class="p-4 ml-64 sm:ml-0 bg-gray-100 relative mt-14" style="min-height: calc(100vh - 3.5rem);">

          <?php include_once '../template/success_message.php'; ?>
          <?php include_once "components/bredcrumb.php" ?>