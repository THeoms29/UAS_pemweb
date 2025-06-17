<?php
$db_host = 'localhost';
$db_username = 'root';      // Ganti dengan username database Anda
$db_password = '';          // Ganti dengan password database Anda  
$db_name = 'baweanique_db'; // Ganti dengan nama database Anda

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>