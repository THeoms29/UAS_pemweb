<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
}
session_start(); // Mulai sesi

// Hapus semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Alihkan ke halaman utama
header("location: " . BASE_URL . "PHP/Index.php");
exit;
?>