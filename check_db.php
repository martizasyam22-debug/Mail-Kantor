<?php
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) { echo 'Koneksi gagal: ' . mysqli_connect_error(); exit; }
mysqli_select_db($conn, 'mail_kantor');
$result = mysqli_query($conn, 'SELECT * FROM pengguna');
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo 'ID: ' . $row['id'] . ', Email: ' . $row['email'] . ', Password: ' . $row['password'] . PHP_EOL;
    }
} else {
    echo 'Query gagal: ' . mysqli_error($conn);
}
mysqli_close($conn);
?>