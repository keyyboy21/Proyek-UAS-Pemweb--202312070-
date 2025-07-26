<?php
ob_start(); // TAMBAHKAN INI
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config/koneksi.php';
$error = "";

if (isset($_POST['login'])) {
    echo "Form terkirim<br>"; // Boleh tetap ada jika ob_start() aktif

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_input = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    echo "Hasil ditemukan: " . mysqli_num_rows($result) . "<br>";

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $hash = $user['password'];

        echo "Password Input: $password_input<br>";
        echo "Password Hash: $hash<br>";

        if (password_verify($password_input, $hash)) {
            echo "Login berhasil<br>";
            $_SESSION['users'] = [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
ob_end_flush(); // TAMBAHKAN INI
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Casing Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center">Login Admin</h4>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3 small text-muted">© Casing Store 2025</p>
        </div>
    </div>
</div>
</body>
</html>
