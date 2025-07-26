<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id = $id");
$data = mysqli_fetch_assoc($query);

// Ambil data untuk dropdown
$produk = mysqli_query($conn, "SELECT * FROM produk");
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");

if (isset($_POST['update'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Ambil harga produk
    $harga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM produk WHERE id = $id_produk"));
    $subtotal = $jumlah * $harga['harga'];

    $update = mysqli_query($conn, "UPDATE detail_transaksi SET 
        id_transaksi = '$id_transaksi', 
        id_produk = '$id_produk', 
        jumlah = '$jumlah', 
        subtotal = '$subtotal' 
        WHERE id = '$id'");

    if ($update) {
        header("Location: tampil_detail_transaksi.php");
        exit;
    } else {
        echo "Gagal mengupdate data";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h3>Edit Detail Transaksi</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Transaksi</label>
            <select name="id_transaksi" class="form-control" required>
                <?php while ($tr = mysqli_fetch_assoc($transaksi)) : ?>
                    <option value="<?= $tr['id'] ?>" <?= $tr['id'] == $data['id_transaksi'] ? 'selected' : '' ?>>
                        <?= $tr['id'] ?> - <?= $tr['tanggal_transaksi'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Produk</label>
            <select name="id_produk" class="form-control" required>
                <?php while ($pr = mysqli_fetch_assoc($produk)) : ?>
                    <option value="<?= $pr['id'] ?>" <?= $pr['id'] == $data['id_produk'] ? 'selected' : '' ?>>
                        <?= $pr['nama_produk'] ?> - Rp<?= number_format($pr['harga']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="tampil_detail_transaksi.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>
