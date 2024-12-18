<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'aristino';

$conn = new mysqli($server, $user, $pass, $database);

if ($conn) {
    mysqli_query($conn, "SET NAMES 'utf8' ");
} else
    echo "Kết nối thất bại";