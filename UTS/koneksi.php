<?php
$host = "localhost";
$user = "root";
$pass = "12345678";
$db   = "baweanique_db"; // ini nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>