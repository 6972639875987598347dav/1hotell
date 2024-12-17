<?php
$servername = "localhost";
$username = "root"; // Sesuaikan username database Anda
$password = ""; // Sesuaikan password database Anda
$dbname = "db_hotel"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
