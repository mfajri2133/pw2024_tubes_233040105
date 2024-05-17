<?php
include_once '../lib/user.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$users = getAdmin($search);

header('Content-Type: application/json');
echo json_encode($users);
