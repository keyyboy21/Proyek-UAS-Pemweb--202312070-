<?php
session_start();
if (!isset($_SESSION['users']) || $_SESSION['users']['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/koneksi.php';

// Ambil data aktivitas login + nama user
$query = "SELECT al.*, u.nama FROM aktivitas_log al 
          JOIN users u ON al.id_user = u.id 
          ORDER BY al.tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Aktivitas Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h3 class="mb-3">Data Aktivitas Login</h3>

    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Aktivitas</a>
    <a href="../dashboard.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Aktivitas</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['aktivitas']) ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
