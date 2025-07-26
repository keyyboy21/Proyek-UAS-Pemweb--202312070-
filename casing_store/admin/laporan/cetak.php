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
    <title>Cetak Laporan</title>
    <style>
        body { font-family: Arial; font-size: 14px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: center; }
    </style>
</head>
<body onload="window.print()">
    <h2>LAPORAN TRANSAKSI</h2>
    <p style="text-align:center;">
        Periode: <?= date('d M Y', strtotime($mulai)) ?> s/d <?= date('d M Y', strtotime($sampai)) ?>
    </p>

    <table>
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
            <?php $no=1; $total=0; while ($row = mysqli_fetch_assoc($result)): 
                $total += $row['total'];
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
                <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
