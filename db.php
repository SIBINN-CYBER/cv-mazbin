<?php
// Aktifkan penampilan error untuk debugging
ini_set('display_errors', 1);           // Aktifkan penampilan error
ini_set('display_startup_errors', 1);   // Aktifkan penampilan error saat startup
error_reporting(E_ALL);                 // Laporan semua jenis error

// File: db.php
// File konfigurasi untuk koneksi ke database MySQL menggunakan PDO

// Konfigurasi koneksi database
$host = 'localhost';         // Host database (alamat server database)
$dbname = 'psas2025';  // Nama database yang akan digunakan
$user = 'root';                 // Username untuk koneksi ke database
$pass = '';             // Password untuk koneksi ke database

try {
    // Membuat koneksi PDO ke database MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // String koneksi: mysql = driver, host = server, dbname = nama database, charset = set karakter UTF-8

    // Mengatur mode error PDO ke exception untuk penanganan error yang lebih baik
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Dengan mode ini, PDO akan melempar exception saat terjadi error

    // Mengatur mode fetch default ke associative array (array dengan kunci string)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // Dengan mode ini, hasil query akan dikembalikan sebagai array asosiatif

} catch (PDOException $e) {
    // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi skrip
    // Pada lingkungan produksi, sebaiknya jangan tampilkan detail error ke pengguna secara langsung
    die("Koneksi ke database gagal: " . $e->getMessage());
    // $e->getMessage() berisi pesan error spesifik dari PDO
}
?>
