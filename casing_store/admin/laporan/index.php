<?php
include '../../config/koneksi.php';

$mulai = $_GET['mulai'] ?? '';
$sampai = $_GET['sampai'] ?? '';

$where = '';
if ($mulai && $sampai) {
    $where = "WHERE DATE(t.tanggal_transaksi) BETWEEN '$mulai' AND '$sampai'";
}

$query = "
    SELECT t.*, p.nama_produk, pl.nama_pelanggan AS nama 
    FROM transaksi t 
    JOIN produk p ON t.id_produk = p.id 
    JOIN pelanggan pl ON t.id_pelanggan = pl.id 
    $where
    ORDER BY t.tanggal_transaksi DESC
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h3>Laporan Transaksi</h3>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="date" name="mulai" value="<?= $mulai ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Sampai Tanggal</label>
            <input type="date" name="sampai" value="<?= $sampai ?>" class="form-control">
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Tampilkan</button>
            <?php if ($mulai && $sampai): ?>
                <a href="cetak.php?mulai=<?= $mulai ?>&sampai=<?= $sampai ?>" target="_blank" class="btn btn-danger">Cetak PDF</a>
            <?php endif; ?>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; $total_semua = 0; while ($row = mysqli_fetch_assoc($result)): 
                $total_semua += $row['total'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nama_produk'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                <td><?= $row['tanggal_transaksi'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th colspan="2">Rp <?= number_format($total_semua, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
