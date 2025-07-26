<?php
include '../../config/koneksi.php';
$query = "
    SELECT transaksi.*, pelanggan.nama_pelanggan, produk.nama_produk 
    FROM transaksi 
    JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id 
    JOIN produk ON transaksi.id_produk = produk.id
    ORDER BY transaksi.tanggal_transaksi DESC
";
$transaksi = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <!-- GANTI DENGAN CDN BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Data Transaksi</h2>
    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Transaksi</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td><?= $row['tanggal_transaksi'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
