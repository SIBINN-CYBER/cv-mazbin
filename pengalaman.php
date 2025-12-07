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
    <title>Pengalaman - CV Saya</title> <!-- Judul halaman yang muncul di tab browser -->
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
            <li><a href="pendidikan.php">Pendidikan</a></li> <!-- Link ke halaman pendidikan -->
            <li><a href="pengalaman.php" class="active">Pengalaman</a></li> <!-- Link ke halaman ini (aktif) -->
            <li><a href="kontak.php">Kontak</a></li> <!-- Link ke halaman kontak -->
            <li><a href="artikel.php">Artikel</a></li> <!-- Link ke halaman artikel -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <!-- Kartu pengalaman proyek dan pelatihan -->
        <section class="card">
            <h2>Pengalaman Proyek & Pelatihan</h2> <!-- Judul seksi pengalaman -->

            <!-- Timeline pengalaman -->
            <div class="timeline">
                <!-- Timeline pengalaman (duplikasi - mungkin untuk styling tertentu) -->
                <div class="timeline">
                    <!-- Item pertama dalam timeline pengalaman -->
                    <div class="timeline-item">
                        <h3>Program Kalkulator C#</h3> <!-- Nama proyek -->
                        <ul> <!-- Daftar detail pengalaman -->
                            <li>Membuat program C# yaitu kalkulator sederhana dengan antarmuka pengguna dasar.</li> <!-- Detail proyek -->
                        </ul>
                    </div>

                    <!-- Item kedua dalam timeline pengalaman -->
                    <div class="timeline-item">
                        <h3>Proyek Aplikasi Login</h3> <!-- Nama proyek -->
                        <ul> <!-- Daftar detail pengalaman -->
                            <li>Membuat proyek aplikasi halaman login untuk studi kasus sebuah kebun binatang.</li> <!-- Detail proyek -->
                        </ul>
                    </div>

                    <!-- Item ketiga dalam timeline pengalaman -->
                    <div class="timeline-item">
                        <h3>Pelatihan Coding & Database</h3> <!-- Nama pelatihan -->
                        <ul> <!-- Daftar detail pelatihan -->
                            <li>Mengikuti pelatihan intensif tentang implementasi coding dan database siap pakai.</li> <!-- Detail pelatihan -->
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Link ke file JavaScript eksternal untuk fungsi interaktif -->
    <script src="script.js"></script>
</body>
</html>