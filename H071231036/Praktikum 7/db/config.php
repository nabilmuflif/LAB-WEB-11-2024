<?php
$host = 'localhost:3308';
$user = 'root';
$password = '';
$dbname = 'mahasiswa_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
