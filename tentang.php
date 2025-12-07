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
    <title>Tentang Saya - CV Saya</title> <!-- Judul halaman yang muncul di tab browser -->
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
            <li><a href="tentang.php" class="active">Tentang Saya</a></li> <!-- Link ke halaman ini (aktif) -->
            <li><a href="pendidikan.php">Pendidikan</a></li> <!-- Link ke halaman pendidikan -->
            <li><a href="pengalaman.php">Pengalaman</a></li> <!-- Link ke halaman pengalaman -->
            <li><a href="kontak.php">Kontak</a></li> <!-- Link ke halaman kontak -->
            <li><a href="artikel.php">Artikel</a></li> <!-- Link ke halaman artikel -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <!-- Kartu informasi pribadi -->
        <section class="card">
            <h2>Tentang Saya</h2> <!-- Judul seksi informasi pribadi -->
            <!-- Paragraf berisi informasi pribadi -->
            <p>
                Saya Rizky Setiawan, saya bersekolah di SMK NEGERI 1 BAWANG yang memilih jurusan Pengembangan Perangkat Lunank dan Gim(PPLG), saya masuk pada tahun pelajaran 2024/2025. Dan saya lulusan dari SMP NEGERI 1 BANJARNEGARA. Saya memilih jurusan ini supaya dapat mendapatkan pengalaman baru dalam mempelajari tentang dunia pemrograman dan juga dorongan dari orang tua.
            </p>
        </section>

        <!-- Kartu keahlian -->
        <section class="card">
            <h2>Keahlian</h2> <!-- Judul seksi keahlian -->
            <!-- Daftar keahlian dalam format list -->
            <ul class="skills">
                <li>PHP</li> <!-- Keahlian dalam PHP -->
                <li>HTML</li> <!-- Keahlian dalam HTML -->
                <li>CSS</li> <!-- Keahlian dalam CSS -->
                <li>JavaScript</li> <!-- Keahlian dalam JavaScript -->
            </ul>
        </section>
    </main>

    <!-- Link ke file JavaScript eksternal untuk fungsi interaktif -->
    <script src="script.js"></script>
</body>
</html>