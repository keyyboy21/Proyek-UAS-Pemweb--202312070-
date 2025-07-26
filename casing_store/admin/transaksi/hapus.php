<?php
include '../../config/koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM transaksi WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Transaksi berhasil dihapus');window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus transaksi');window.location='index.php';</script>";
}
?>
