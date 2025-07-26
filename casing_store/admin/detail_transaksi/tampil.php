<?php
include '../../config/koneksi.php';

// Ambil data detail_transaksi beserta nama produk dan info transaksi
$query = "SELECT dt.*, p.nama_produk, t.tanggal_transaksi 
          FROM detail_transaksi dt 
          JOIN produk p ON dt.id_produk = p.id 
          JOIN transaksi t ON dt.id_transaksi = t.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h3 class="mb-4">Data Detail Transaksi</h3>
    <a href="tambah_detail_transaksi.php" class="btn btn-success mb-3">Tambah Data</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['id_transaksi'] ?></td>
                    <td><?= $row['tanggal_transaksi'] ?></td>
                    <td><?= $row['id_produk'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= number_format($row['subtotal']) ?></td>
                    <td>
                        <a href="edit_detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_detail_transaksi.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
