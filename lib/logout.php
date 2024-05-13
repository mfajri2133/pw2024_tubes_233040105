<?php
include_once '../helpers/users.php';
start_session();


$is_admin = ($_SESSION['user'])['is_admin'];
session_destroy();

if ($is_admin == 1) {
     redirect_to("login");
} else {
     redirect_to("index");
}
