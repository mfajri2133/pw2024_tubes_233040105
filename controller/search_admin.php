<?php
include_once base_url('/lib/user.php');

$search = isset($_GET['search']) ? $_GET['search'] : '';
$users = fetchAdmin($search);

header('Content-Type: application/json');
echo json_encode($users);
