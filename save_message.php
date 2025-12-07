<?php
// Sertakan file koneksi database
require_once 'db.php';

// Set header HTTP untuk merespons sebagai JSON
header('Content-Type: application/json');

// Ambil data JSON yang dikirim dari JavaScript melalui metode POST
$data = json_decode(file_get_contents('php://input'), true);
// file_get_contents('php://input') membaca data mentah dari body permintaan POST
// json_decode dengan parameter true mengubah JSON menjadi array asosiatif PHP

// Validasi data - cek apakah ada field yang kosong
if (empty($data['nama']) || empty($data['email']) || empty($data['pesan'])) {
    // Kirim respons error dalam format JSON jika ada field yang kosong
    echo json_encode(['success' => false, 'message' => 'Semua field harus diisi.']);
    exit;  // Hentikan eksekusi skrip
}

// Validasi format email menggunakan filter_var
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    // Kirim respons error dalam format JSON jika format email tidak valid
    echo json_encode(['success' => false, 'message' => 'Format email tidak valid.']);
    exit;  // Hentikan eksekusi skrip
}

try {
    // Siapkan statement SQL untuk memasukkan data ke tabel messages
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    // Gunakan prepared statement untuk mencegah SQL injection
    // Tanda ? adalah placeholder untuk nilai yang akan dimasukkan nanti

    // Eksekusi statement dengan data yang sudah divalidasi
    $stmt->execute([$data['nama'], $data['email'], $data['pesan']]);
    // Data dimasukkan secara berurutan sesuai urutan placeholder di query

    // Kirim respons sukses dalam format JSON
    echo json_encode(['success' => true, 'message' => 'Pesan berhasil disimpan.']);

} catch (PDOException $e) {
    // Tangkap exception jika terjadi kesalahan database
    // Kirim respons error dalam format JSON
    // Sebaiknya jangan tampilkan $e->getMessage() langsung ke pengguna di lingkungan produksi
    // karena bisa membocorkan informasi sensitif tentang struktur database
    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan pesan ke database.']);
    // Pesan error umum digunakan untuk mencegah penyerang mendapatkan informasi detail
}
?>