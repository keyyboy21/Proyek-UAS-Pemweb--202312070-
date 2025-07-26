<?php
include '../../config/koneksi.php';

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h3>Data User</h3>
    <a href="tambah.php" class="btn btn-success mb-3">Tambah User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while ($u = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['nama'] ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="hapus.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
