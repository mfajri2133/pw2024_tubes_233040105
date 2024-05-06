<?php
$conn = mysqli_connect('localhost', 'root', '123123123', 'tubes_pw2024_233040105');

if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
