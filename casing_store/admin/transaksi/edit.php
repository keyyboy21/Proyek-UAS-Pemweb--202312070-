<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id"));
$produk = mysqli_query($conn, "SELECT * FROM produk");
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

if (isset($_POST['update'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $query_harga = mysqli_query($conn, "SELECT harga FROM produk WHERE id = $id_produk");
    $data_produk = mysqli_fetch_assoc($query_harga);
    $harga = $data_produk['harga'];

    $total = $harga * $jumlah;

    $query = "UPDATE transaksi SET 
        id_pelanggan='$id_pelanggan', 
        id_produk='$id_produk', 
        jumlah='$jumlah', 
        total='$total', 
        tanggal_transaksi='$tanggal' 
        WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Transaksi berhasil diupdate');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal update transaksi');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Transaksi</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <select name="id_pelanggan" class="form-select" required>
                <?php while ($p = mysqli_fetch_assoc($pelanggan)) : ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $transaksi['id_pelanggan'] ? 'selected' : '' ?>>
                        <?= $p['nama_pelanggan'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk</label>
            <select name="id_produk" class="form-select" required>
                <?php while ($pr = mysqli_fetch_assoc($produk)) : ?>
                    <option value="<?= $pr['id'] ?>" <?= $pr['id'] == $transaksi['id_produk'] ? 'selected' : '' ?>>
                        <?= $pr['nama_produk'] ?> (Rp<?= number_format($pr['harga']) ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" value="<?= $transaksi['jumlah'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $transaksi['tanggal_transaksi'] ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
