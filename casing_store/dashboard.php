<?php
session_start();
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['users'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Casing Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Casing Store</span>
        <span class="navbar-text ms-auto me-3">
            Login sebagai: <strong><?= htmlspecialchars($user['nama']) ?></strong> (<?= $user['role'] ?>)
        </span>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h2>Dashboard</h2>
    <p>Selamat datang, <strong><?= htmlspecialchars($user['nama']) ?></strong>! Silakan pilih menu di bawah ini:</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-primary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manajemen Produk</h5>
                    <p class="card-text">Lihat, tambah, ubah atau hapus produk casing HP.</p>
                    <a href="admin/produk/index.php" class="btn btn-primary w-100">Kelola Produk</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manajemen Kategori</h5>
                    <p class="card-text">Atur kategori produk untuk casing.</p>
                    <a href="admin/kategori/index.php" class="btn btn-success w-100">Kelola Kategori</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Transaksi</h5>
                    <p class="card-text">Lihat daftar transaksi pembelian casing.</p>
                    <a href="admin/transaksi/index.php" class="btn btn-warning w-100">Lihat Transaksi</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-info h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Laporan</h5>
                    <p class="card-text">Cetak laporan penjualan produk.</p>
                    <a href="admin/laporan/index.php" class="btn btn-info w-100">Lihat Laporan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-secondary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Manajemen User</h5>
                    <p class="card-text">Kelola akun user/admin sistem.</p>
                    <a href="admin/users/index.php" class="btn btn-secondary w-100">Kelola User</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
