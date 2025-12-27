<?php
require 'core/db.php';

echo "<h1>Test Database Connection</h1>";

// Test koneksi
if ($conn) {
    echo "<p>Koneksi database berhasil!</p>";
} else {
    echo "<p>Koneksi database gagal: " . mysqli_connect_error() . "</p>";
    exit;
}

// Test query pengguna
echo "<h2>Data Pengguna:</h2>";
$result = mysqli_query($conn, "SELECT * FROM pengguna");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . ", Nama: " . $row['nama'] . ", Email: " . $row['email'] . ", Password: " . $row['password'] . "<br>";
    }
} else {
    echo "Error query pengguna: " . mysqli_error($conn) . "<br>";
}

// Test query surat_masuk
echo "<h2>Data Surat Masuk:</h2>";
$result = mysqli_query($conn, "SELECT * FROM surat_masuk");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . ", Dari: " . $row['dari'] . ", Perihal: " . $row['perihal'] . ", Status: " . $row['status'] . "<br>";
    }
} else {
    echo "Error query surat_masuk: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
?>