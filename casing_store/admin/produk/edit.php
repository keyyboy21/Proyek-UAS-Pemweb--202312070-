<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id=$id"));
$kategori = mysqli_query($conn, "SELECT * FROM kategori_produk");

if (isset($_POST['update'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori_id = $_POST['kategori_id'];

    $query = "UPDATE produk SET 
                nama_produk='$nama', 
                harga='$harga', 
                stok='$stok', 
                kategori_id='$kategori_id' 
              WHERE id=$id";
    mysqli_query($conn, $query);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Produk</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <?php while ($row = mysqli_fetch_assoc($kategori)) {
                    $selected = $row['id'] == $data['kategori_id'] ? 'selected' : '';
                    echo "<option value='{$row['id']}' $selected>{$row['nama_kategori']}</option>";
                } ?>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
