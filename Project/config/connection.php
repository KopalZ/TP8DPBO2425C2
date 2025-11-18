<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "tp_mvc25";

// Buat koneksi baru
$conn = new mysqli($servername, $username, $password, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// Definisikan BASE_URL
// UBAH "/tp_mvc25" jika folder proyek Anda berbeda
define('BASE_URL', '/TP%208');
?>