<?php
require 'core/db.php';

$sql = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $sql);

echo "Data pengguna di database:\n";
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row['id'] . ", Nama: " . $row['nama'] . ", Email: " . $row['email'] . ", Password Hash: " . $row['password'] . "\n";
}

mysqli_close($conn);
?>