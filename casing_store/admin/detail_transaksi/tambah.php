<?php
include '../../config/koneksi.php';

// Ambil data transaksi dan produk untuk dropdown
$transaksi = mysqli_query($conn, "SELECT id FROM transaksi");
$produk = mysqli_query($conn, "SELECT id, nama_produk FROM produk");

// Simpan data detail transaksi
if (isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];
    $subtotal = $_POST['subtotal'];

    mysqli_query($conn, "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah, subtotal) VALUES ('$id_transaksi', '$id_produk', '$jumlah', '$subtotal')");
    header("Location: tampil_detail_transaksi.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h3 class="mb-4">Tambah Detail Transaksi</h3>
    <form method="POST" class="shadow p-4 rounded bg-light">
        <div class="mb-3">
            <label for="id_transaksi" class="form-label">ID Transaksi</label>
            <select name="id_transaksi" id="id_transaksi" class="form-select" required>
                <option value="">-- Pilih ID Transaksi --</option>
                <?php while ($t = mysqli_fetch_assoc($transaksi)) : ?>
                    <option value="<?= $t['id'] ?>"><?= $t['id'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_produk" class="form-label">Produk</label>
            <select name="id_produk" id="id_produk" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                <?php while ($p = mysqli_fetch_assoc($produk)) : ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nama_produk'] ?> (ID: <?= $p['id'] ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="tampil_detail_transaksi.php" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>
