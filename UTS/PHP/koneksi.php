<?php
$db_host = '127.0.0.1';
$db_username = 'root';      // Ganti dengan username database Anda
$db_password = '';          // Ganti dengan password database Anda  
$db_name = 'baweanique_db'; // Ganti dengan nama database Anda
$charset = 'utf8mb4';


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
  $pdo = new PDO($dsn, $db_username, $db_password, $options); // <--- THIS defines $pdo
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
?>