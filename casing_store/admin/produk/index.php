<?php include '../../config/koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Data Produk</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $produk = mysqli_query($conn, "
                SELECT produk.*, kategori_produk.nama_kategori 
                FROM produk 
                JOIN kategori_produk ON produk.kategori_id = kategori_produk.id
            ");
            while($row = mysqli_fetch_assoc($produk)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_produk']}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>{$row['stok']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' onclick='return confirm(\"Yakin?\")' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
