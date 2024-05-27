<?php
include_once "../helpers/users.php";
start_session();

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="../css/output.css">
     <link rel="stylesheet" href="../css/support.css">
</head>


<body>
     <?php include_once "components/navbar-user.php" ?>
     <?php include_once '../template/success_message.php'; ?>
     <?php include_once '../template/error_message.php'; ?>