<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id = $id");

if ($hapus) {
    header("Location: tampil_detail_transaksi.php");
    exit;
} else {
    echo "Gagal menghapus data.";
}
?>
