<?php
// Update password pengguna menjadi plain text
$conn_temp = mysqli_connect('localhost', 'root', '');

if (!$conn_temp) {
    die("Koneksi MySQL gagal: " . mysqli_connect_error());
}

mysqli_select_db($conn_temp, 'mail_kantor');

// Update password menjadi plain text
$sql_update = "UPDATE pengguna SET password = 'admin123' WHERE email = 'admin@kantor.com'";
if (mysqli_query($conn_temp, $sql_update)) {
    echo "Password berhasil diubah menjadi plain text.";
} else {
    echo "Error: " . mysqli_error($conn_temp);
}

mysqli_close($conn_temp);
?>