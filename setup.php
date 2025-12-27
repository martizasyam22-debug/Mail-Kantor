<?php
// Setup ulang database
$conn_temp = mysqli_connect('localhost', 'root', '');

if (!$conn_temp) {
    die("Koneksi MySQL gagal: " . mysqli_connect_error());
}

// Buat database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS mail_kantor";
mysqli_query($conn_temp, $sql_create_db);

// Pilih database
mysqli_select_db($conn_temp, 'mail_kantor');

// Buat tabel pengguna
$sql_pengguna = "CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
mysqli_query($conn_temp, $sql_pengguna);

// Buat tabel surat_masuk
$sql_masuk = "CREATE TABLE IF NOT EXISTS surat_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(50),
    dari VARCHAR(100) NOT NULL,
    perihal VARCHAR(255) NOT NULL,
    tanggal_surat DATE,
    tanggal_terima DATE NOT NULL,
    status ENUM('Baru', 'Dibaca') DEFAULT 'Baru'
)";
mysqli_query($conn_temp, $sql_masuk);

// Buat tabel surat_keluar
$sql_keluar = "CREATE TABLE IF NOT EXISTS surat_keluar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_surat VARCHAR(50) NOT NULL,
    tanggal_kirim DATE NOT NULL,
    kepada VARCHAR(100) NOT NULL,
    perihal VARCHAR(255) NOT NULL,
    file_lampiran VARCHAR(255)
)";
mysqli_query($conn_temp, $sql_keluar);

// Insert pengguna
$password_hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // hash untuk 'admin123'
$sql_insert_user = "INSERT IGNORE INTO pengguna (nama, email, password) VALUES ('Admin', 'admin@kantor.com', '$password_hash')";
mysqli_query($conn_temp, $sql_insert_user);

// Insert surat masuk
$sql_insert_masuk = "INSERT IGNORE INTO surat_masuk (nomor_surat, dari, perihal, tanggal_surat, tanggal_terima, status) VALUES
('001/SM/2025', 'PT ABC', 'Undangan Rapat', '2025-12-20', '2025-12-25', 'Baru'),
('002/SM/2025', 'Bank XYZ', 'Konfirmasi Transfer', '2025-12-22', '2025-12-26', 'Dibaca'),
('003/SM/2025', 'Kementerian', 'Pemberitahuan', '2025-12-24', '2025-12-27', 'Baru')";
mysqli_query($conn_temp, $sql_insert_masuk);

echo "Setup database selesai!";
mysqli_close($conn_temp);
?>