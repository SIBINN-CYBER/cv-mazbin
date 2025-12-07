<?php
// Sertakan file koneksi database
require_once 'db.php';

try {
    // Query SQL untuk membuat tabel messages jika belum ada
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,           -- Kolom ID otomatis bertambah tiap entri baru
        name VARCHAR(100) NOT NULL,                  -- Nama pengirim pesan (maksimal 100 karakter)
        email VARCHAR(100) NOT NULL,                 -- Email pengirim pesan (maksimal 100 karakter)
        message TEXT NOT NULL,                       -- Isi pesan (tipe TEXT tanpa batas karakter)
        received_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Waktu penerimaan pesan (otomatis terisi saat data dimasukkan)
    )";

    // Eksekusi perintah SQL untuk membuat tabel
    $pdo->exec($sql);

    // Tampilkan pesan sukses jika tabel berhasil dibuat atau sudah ada
    echo "Tabel 'messages' berhasil dibuat atau sudah ada.";

} catch (PDOException $e) {
    // Tangkap exception jika terjadi kesalahan saat membuat tabel
    // Hentikan eksekusi skrip dan tampilkan pesan error
    die("Gagal membuat tabel: " . $e->getMessage());
}
?>