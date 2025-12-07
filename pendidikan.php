<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <title>Pendidikan - CV Saya</title> <!-- Judul halaman yang muncul di tab browser -->
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigasi sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <!-- Gambar profil di sidebar -->
            <img src="foto.jpeg" alt="Foto Profil" class="sidebar-profile-pic">
            <h3>CV Digital</h3> <!-- Judul aplikasi di sidebar -->
        </div>
        <!-- Menu navigasi -->
        <ul>
            <li><a href="index.php">Beranda</a></li> <!-- Link ke halaman beranda -->
            <li><a href="tentang.php">Tentang Saya</a></li> <!-- Link ke halaman tentang -->
            <li><a href="pendidikan.php" class="active">Pendidikan</a></li> <!-- Link ke halaman ini (aktif) -->
            <li><a href="pengalaman.php">Pengalaman</a></li> <!-- Link ke halaman pengalaman -->
            <li><a href="kontak.php">Kontak</a></li> <!-- Link ke halaman kontak -->
            <li><a href="artikel.php">Artikel</a></li> <!-- Link ke halaman artikel -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <!-- Kartu riwayat pendidikan -->
        <section class="card">
            <h2>Riwayat Pendidikan</h2> <!-- Judul seksi riwayat pendidikan -->

            <!-- Timeline pendidikan -->
            <div class="timeline">
                <!-- Item pertama dalam timeline -->
                <div class="timeline-item">
                    <h3>SMK NEGERI 1 BAWANG</h3> <!-- Nama institusi pendidikan -->
                    <p><strong>Rekayasa Perangkat Lunak (RPL/PPLG)</strong> | 2024 - Sekarang</p> <!-- Jurusan dan periode -->
                    <p>Mempelajari pengembangan aplikasi, sistem basis data, dan rekayasa perangkat lunak.</p> <!-- Deskripsi singkat -->
                </div>

                <!-- Item kedua dalam timeline -->
                <div class="timeline-item">
                    <h3>SMP NEGERI 1 BANJARNEGARA</h3> <!-- Nama institusi pendidikan -->
                    <p>2021 - 2024</p> <!-- Periode pendidikan -->
                </div>

                <!-- Item ketiga dalam timeline -->
                <div class="timeline-item">
                    <h3>SD NEGERI 1 KALILUNJAR</h3> <!-- Nama institusi pendidikan -->
                    <p>2015 - 2021</p> <!-- Periode pendidikan -->
                </div>
            </div>
        </section>
    </main>

    <!-- Link ke file JavaScript eksternal untuk fungsi interaktif -->
    <script src="script.js"></script>
</body>
</html>