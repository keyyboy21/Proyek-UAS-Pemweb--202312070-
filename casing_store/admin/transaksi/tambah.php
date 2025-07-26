<?php
include '../../config/koneksi.php';

$produk = mysqli_query($conn, "SELECT * FROM produk");
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

if (isset($_POST['simpan'])) {
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    $query_harga = mysqli_query($conn, "SELECT harga FROM produk WHERE id = $id_produk");
    $data_produk = mysqli_fetch_assoc($query_harga);
    $harga = $data_produk['harga'];

    $total = $harga * $jumlah;

    $query = "INSERT INTO transaksi (id_pelanggan, id_produk, jumlah, total, tanggal_transaksi) 
              VALUES ('$id_pelanggan', '$id_produk', '$jumlah', '$total', '$tanggal')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Transaksi berhasil ditambahkan');window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan transaksi');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Tambah Transaksi</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <select name="id_pelanggan" class="form-select" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php while ($p = mysqli_fetch_assoc($pelanggan)) : ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nama_pelanggan'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk</label>
            <select name="id_produk" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                <?php while ($pr = mysqli_fetch_assoc($produk)) : ?>
                    <option value="<?= $pr['id'] ?>"><?= $pr['nama_produk'] ?> (Rp<?= number_format($pr['harga']) ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
