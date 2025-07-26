# Aplikasi Web Penjualan Casing HP

## 1. Cara Instalasi Aplikasi

### Persyaratan Sistem

* Web Server: Apache (XAMPP, Laragon, dll)
* PHP versi >= 7.4
* MySQL versi >= 5.7
* Browser modern (Chrome, Firefox, Edge)

### Langkah Instalasi

1. **Clone atau download project**

   * Ekstrak dan tempatkan folder aplikasi di dalam direktori `htdocs/` (untuk XAMPP) atau folder web server Anda.

2. **Konfigurasi Database**

   * Buka phpMyAdmin
   * Buat database baru, misalnya `db_penjualan`
   * Import file SQL `db_penjualan.sql` ke database tersebut

3. **Konfigurasi Koneksi Database**

   * Buka file `config/koneksi.php`
   * Ubah konfigurasi sesuai database Anda:

     ```php
     $conn = mysqli_connect("localhost", "root", "", "db_penjualan");
     ```

4. **Jalankan Aplikasi**

   * Akses via browser: `http://localhost/casing_store/login.php`

## 2. Struktur Database

### Tabel-Tabel:

1. **users** – menyimpan data admin

   * id, nama, username, password
2. **kategori\_produk** – kategori casing (e.g. iPhone, Samsung)

   * id, nama\_kategori
3. **produk** – daftar casing yang dijual

   * id, nama\_produk, kategori\_id (FK), harga, stok
4. **pelanggan** – data akun pelanggan

   * id, nama, email, password, alamat
5. **transaksi** – riwayat transaksi

   * id, id\_pelanggan (FK), tanggal, total
6. **detail\_transaksi** – produk dalam transaksi

   * id, id\_transaksi (FK), id\_produk (FK), jumlah, subtotal
7. **keranjang** – daftar belanja sebelum checkout

   * id, id\_pelanggan (FK), id\_produk (FK), jumlah
8. **laporan\_penjualan** – ringkasan transaksi

   * id, id\_transaksi (FK), tanggal, total
9. **ulasan** – review dari pelanggan

   * id, id\_pelanggan (FK), id\_produk (FK), komentar, rating
10. **pembayaran** – bukti pembayaran pelanggan

* id, id\_transaksi (FK), metode, status, bukti

### Relasi Antar Tabel:

* `produk.kategori_id` → `kategori_produk.id`
* `transaksi.id_pelanggan` → `pelanggan.id`
* `detail_transaksi.id_transaksi` → `transaksi.id`
* `detail_transaksi.id_produk` → `produk.id`
* `keranjang.id_pelanggan` → `pelanggan.id`
* `keranjang.id_produk` → `produk.id`
* `laporan_penjualan.id_transaksi` → `transaksi.id`
* `ulasan.id_pelanggan` → `pelanggan.id`
* `ulasan.id_produk` → `produk.id`
* `pembayaran.id_transaksi` → `transaksi.id`

### Diagram ERD

![ERD](.ERD_UAS.png)

## 3. Cara Menggunakan Aplikasi

### Login

* Admin:

  * Login menggunakan `username` dan `password` dari tabel `users`
  * Redirect ke halaman `admin/dashboard.php`
* Pelanggan:

  * Login menggunakan `email` dan `password` dari tabel `pelanggan`
  * Redirect ke halaman `pelanggan/dashboard.php`

### Fitur Utama

#### Admin:

* CRUD Kategori Produk
* CRUD Produk
* CRUD Pelanggan
* Kelola Transaksi dan Laporan Penjualan
* Lihat dan Hapus Ulasan

#### Pelanggan:

* Login dan Ubah Profil
* Lihat Produk
* Tambah ke Keranjang
* Checkout dan Upload Bukti Pembayaran
* Lihat Riwayat Transaksi
* Beri Ulasan pada Produk

### Navigasi

* Menu Sidebar untuk akses ke setiap modul
* Tombol Logout tersedia di navbar kanan atas

---

