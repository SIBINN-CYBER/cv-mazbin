<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
// Jika tidak ada sesi login (user_id tidak diset), kembalikan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");  // Redirect ke halaman login
    exit;                         // Hentikan eksekusi skrip
}

// Sertakan file koneksi database dari direktori induk
require_once '../db.php';

// Ambil nama admin dari session, jika tidak ada maka gunakan 'Admin' sebagai default
$username = $_SESSION['username'] ?? 'Admin';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <title>Admin Dashboard</title> <!-- Judul halaman yang muncul di tab browser -->
    <!-- Link ke file CSS utama dari direktori induk -->
    <link rel="stylesheet" href="../style.css">

    <!-- CSS internal untuk styling dashboard -->
    <style>
        /* Gaya untuk konten dashboard */
        .content {
            display: block;  /* Ganti dari flex menjadi block */
        }
        /* Gaya untuk grid dashboard */
        .dashboard-grid {
            display: grid;                                    /* Gunakan grid layout */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Kolom otomatis dengan lebar min 250px */
            gap: 1.5rem;                                     /* Jarak antar item */
            margin-top: 2rem;                                /* Jarak atas dari grid */
        }
        /* Gaya untuk kartu dashboard */
        .dashboard-card {
            background-color: var(--surface-color);          /* Warna latar belakang dari variabel CSS */
            padding: 1.5rem;                                 /* Padding dalam kartu */
            border-radius: 8px;                              /* Sudut melengkung */
            border: 1px solid var(--border-color);           /* Border dengan warna dari variabel CSS */
            text-decoration: none;                            /* Hilangkan garis bawah */
            color: var(--text-color);                         /* Warna teks dari variabel CSS */
            transition: transform 0.2s ease, box-shadow 0.2s ease; /* Transisi untuk efek hover */
        }
        /* Gaya hover untuk kartu dashboard */
        .dashboard-card:hover {
            transform: translateY(-5px);                      /* Geser ke atas saat hover */
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);         /* Bayangan lebih dalam saat hover */
        }
        /* Gaya untuk judul dalam kartu dashboard */
        .dashboard-card h3 {
            color: var(--primary-color);                     /* Warna teks dari warna utama */
            margin-bottom: 0.5rem;                           /* Jarak bawah dari judul */
        }
        /* Gaya untuk teks dalam kartu dashboard */
        .dashboard-card p {
            color: var(--text-secondary-color);              /* Warna teks sekunder dari variabel CSS */
            font-size: 0.9rem;                               /* Ukuran huruf lebih kecil */
        }
    </style>
</head>
<body>
    <!-- Navigasi sidebar admin -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3> <!-- Judul panel admin -->
        </div>
        <!-- Menu navigasi admin -->
        <ul>
            <li><a href="manage_article.php">Manajemen Artikel</a></li> <!-- Link ke manajemen artikel -->
            <li><a href="pesan.php">Pesan Masuk</a></li> <!-- Link ke pesan masuk -->
            <li><a href="../index.php" target="_blank">Lihat Website</a></li> <!-- Link ke website utama -->
            <li><a href="logout.php">Logout</a></li> <!-- Link untuk logout -->
        </ul>
    </nav>

    <!-- Konten utama dashboard -->
    <main class="content">
        <!-- Kartu sambutan -->
        <section class="card">
            <!-- Tampilkan nama admin dalam sambutan -->
            <h2>Selamat Datang, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>Pilih salah satu menu di bawah atau di samping untuk mulai mengelola website Anda.</p> <!-- Instruksi untuk pengguna -->
        </section>

        <!-- Grid untuk kartu-kartu dashboard -->
        <div class="dashboard-grid">
            <!-- Kartu manajemen artikel -->
            <a href="manage_article.php" class="dashboard-card">
                <h3>Manajemen Artikel</h3> <!-- Judul kartu -->
                <p>Tambah, edit, atau hapus artikel di website Anda.</p> <!-- Deskripsi fungsi -->
            </a>
            <!-- Kartu pesan masuk -->
            <a href="pesan.php" class="dashboard-card">
                <h3>Pesan Masuk</h3> <!-- Judul kartu -->
                <p>Lihat semua pesan yang dikirim oleh pengunjung.</p> <!-- Deskripsi fungsi -->
            </a>
        </div>
    </main>
</body>
</html>