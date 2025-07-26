<?php
$host = "localhost";
$user = "root";
$pass = "keyyboy14";
$db   = "db_casing_hp";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
