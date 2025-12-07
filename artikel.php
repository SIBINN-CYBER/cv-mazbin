<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
// Sertakan file koneksi database
require_once 'db.php';

// Variabel untuk menentukan apakah sedang dalam mode detail atau daftar artikel
$is_detail_view = false;

// Cek apakah ada parameter ID dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // --- TAMPILAN DETAIL (SATU ARTIKEL) ---
    $is_detail_view = true;        // Set variabel untuk mode detail
    $article_id = $_GET['id'];     // Ambil ID artikel dari parameter URL

    // Siapkan perintah SQL untuk mengambil artikel berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    // Eksekusi perintah dengan ID artikel
    $stmt->execute([$article_id]);
    // Ambil data artikel
    $article = $stmt->fetch();

    // Jika artikel dengan ID tersebut tidak ada, kembalikan ke daftar artikel
    if (!$article) {
        header("Location: artikel.php");  // Redirect ke halaman daftar artikel
        exit;                            // Hentikan eksekusi skrip
    }
} else {
    // --- TAMPILAN DAFTAR (SEMUA ARTIKEL) ---
    // Ambil semua artikel dari database, diurutkan dari yang terbaru
    $stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
    // Ambil semua hasil dalam bentuk array
    $articles = $stmt->fetchAll();
    // Hitung jumlah total artikel
    $total_articles = count($articles);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <!-- Judul halaman yang berubah tergantung mode (detail atau daftar) -->
    <title><?php echo $is_detail_view ? htmlspecialchars($article['title']) : 'Artikel'; ?> - CV Digital</title>
    <!-- Link ke file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="style.css">

    <!-- CSS internal untuk mengatur tampilan artikel -->
    <style>
        /* Gaya untuk konten artikel */
        .content {
            display: block; /* Ganti perilaku flex menjadi block */
        }
        /* Gaya untuk konten paragraf dalam artikel */
        .article-content p {
            white-space: pre-wrap; /* Menjaga format paragraf dan baris baru */
            line-height: 1.7;      /* Jarak antar baris lebih lebar */
        }
    </style>
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
            <li><a href="pengalaman.php">Pengalaman</a></li> <!-- Link ke halaman pengalaman -->
            <li><a href="kontak.php">Kontak</a></li> <!-- Link ke halaman kontak -->
            <li><a href="artikel.php" class="active">Artikel</a></li> <!-- Link ke halaman ini (aktif) -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <?php if ($is_detail_view): ?>
            <!-- Tampilan untuk satu artikel (mode detail) -->
            <article class="card">
                <!-- Judul artikel -->
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <!-- Informasi meta artikel (tanggal dan waktu publikasi) -->
                <p class="meta">Diposting pada <?php echo date('d F Y, H:i', strtotime($article['created_at'])); ?></p>
                <!-- Konten artikel -->
                <div class="article-content">
                    <!-- Tampilkan konten artikel dengan baris baru dipertahankan -->
                    <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                </div>
                <!-- Link untuk kembali ke daftar artikel -->
                <a href="artikel.php" style="margin-top: 2rem; display: inline-block; text-decoration: none; color: var(--primary-color);">&larr; Kembali ke Daftar Artikel</a>
            </article>

        <?php else: ?>
            <!-- Tampilan untuk daftar semua artikel -->
            <section class="card article-page-header">
                <h2>Artikel Terbaru</h2> <!-- Judul seksi daftar artikel -->
                <!-- Badge jumlah total artikel -->
                <span class="article-count-badge">Total Artikel: <?php echo $total_articles; ?></span>
            </section>

            <?php if (empty($articles)): ?>
                <!-- Tampilan jika tidak ada artikel -->
                <section class="card">
                    <p>Belum ada artikel yang dipublikasikan.</p> <!-- Pesan jika tidak ada artikel -->
                </section>
            <?php else: ?>
                <!-- Loop untuk menampilkan setiap artikel dalam daftar -->
                <?php foreach ($articles as $list_item): ?>
                    <article class="card article-card">
                        <h3>
                            <!-- Link ke halaman detail artikel -->
                            <a href="artikel.php?id=<?php echo $list_item['id']; ?>">
                                <!-- Judul artikel -->
                                <?php echo htmlspecialchars($list_item['title']); ?>
                            </a>
                        </h3>
                        <!-- Informasi meta artikel (tanggal publikasi) -->
                        <p class="meta">Diposting pada <?php echo date('d F Y', strtotime($list_item['created_at'])); ?></p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php endif; ?>
    </main>

    <!-- Link ke file JavaScript eksternal untuk fungsi interaktif -->
    <script src="script.js"></script>
</body>
</html>