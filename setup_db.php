<?php
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) { die('Koneksi gagal: ' . mysqli_connect_error()); }

mysqli_select_db($conn, 'mail_kantor');

// Buat tabel jika belum ada
$sql_create = "CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $sql_create);

// Insert pengguna
$sql_insert = "INSERT IGNORE INTO pengguna (nama, email, password) VALUES ('Admin', 'admin@kantor.com', 'admin123')";
mysqli_query($conn, $sql_insert);

echo 'Setup selesai.';

mysqli_close($conn);
?>