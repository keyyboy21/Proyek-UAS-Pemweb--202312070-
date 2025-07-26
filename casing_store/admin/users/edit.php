<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama_lengkap'];
    $level = $_POST['level'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET username='$username', nama='$nama', password='$password', role='$level' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET username='$username', nama='$nama', role='$level' WHERE id=$id");
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h3>Edit User</h3>

    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="<?= $data['username'] ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= $data['nama'] ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label>Password Baru (Kosongkan jika tidak ganti)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control">
                <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="kasir" <?= $data['role'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
                <option value="customer" <?= $data['role'] == 'customer' ? 'selected' : '' ?>>Kasir</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
