<?php
session_start();
if (!isset($_SESSION['users']) || $_SESSION['users']['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/koneksi.php';

$pesan = "";

// Ambil daftar user untuk dropdown
$users = mysqli_query($conn, "SELECT id, nama FROM users");

// Proses simpan data
if (isset($_POST['simpan'])) {
    $id_user = $_POST['id_user'];
    $aktivitas = mysqli_real_escape_string($conn, $_POST['aktivitas']);
    $tanggal = date('Y-m-d H:i:s');

    $query = "INSERT INTO aktivitas_log (id_user, aktivitas, tanggal) 
              VALUES ('$id_user', '$aktivitas', '$tanggal')";

    if (mysqli_query($conn, $query)) {
        $pesan = "Data berhasil ditambahkan.";
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Aktivitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h3 class="mb-3">Tambah Aktivitas Login</h3>

    <?php if ($pesan): ?>
        <div class="alert alert-info"><?= $pesan ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="id_user" class="form-label">Nama User</label>
            <select name="id_user" class="form-select" required>
                <option value="">-- Pilih User --</option>
                <?php while ($u = mysqli_fetch_assoc($users)) : ?>
                    <option value="<?= $u['id'] ?>"><?= $u['nama'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="aktivitas" class="form-label">Aktivitas</label>
            <input type="text" name="aktivitas" class="form-control" placeholder="Contoh: Login Berhasil" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>
