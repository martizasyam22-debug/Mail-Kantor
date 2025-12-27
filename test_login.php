<?php
require 'core/db.php';

$email = 'admin@kantor.com';
$password = 'admin123';

$sql = "SELECT id, nama, email, password FROM pengguna WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        echo "Login berhasil! Selamat datang " . $user['nama'];
    } else {
        echo "Password salah.";
    }
} else {
    echo "Email tidak ditemukan.";
}

mysqli_close($conn);
?>