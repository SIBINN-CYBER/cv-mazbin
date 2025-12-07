<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
// Jika tidak ada sesi login (user_id tidak diset), redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");  // Redirect ke halaman login
    exit;                         // Hentikan eksekusi skrip
}

// Sertakan file koneksi database dari direktori induk
require_once '../db.php';

// Set variabel awal untuk judul halaman dan data artikel
$page_title = 'Tambah Artikel Baru';  // Judul halaman default untuk mode tambah
$article = ['id' => '', 'title' => '', 'content' => ''];  // Data artikel default (kosong)
$is_edit = false;  // Status mode (edit atau tambah), default tambah

// Cek apakah ini mode edit (parameter ID ada di URL)
if (isset($_GET['id'])) {
    $is_edit = true;              // Set status mode ke edit
    $article_id = $_GET['id'];    // Ambil ID artikel dari parameter URL

    // Siapkan perintah SQL untuk mengambil artikel berdasarkan ID
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    // Eksekusi perintah dengan ID artikel
    $stmt->execute([$article_id]);
    // Ambil data artikel
    $article = $stmt->fetch();

    // Jika artikel tidak ditemukan, kembali ke dashboard
    if (!$article) {
        header("Location: dashboard.php");  // Redirect ke dashboard
        exit;                            // Hentikan eksekusi skrip
    }
    $page_title = 'Edit Artikel';  // Ganti judul halaman untuk mode edit
}

// Proses form saat disubmit (metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $title = $_POST['title'];    // Ambil judul artikel dari form
    $content = $_POST['content']; // Ambil konten artikel dari form

    // Validasi apakah judul dan konten tidak kosong
    if (empty($title) || empty($content)) {
        $error = "Judul dan konten tidak boleh kosong.";  // Set pesan error jika validasi gagal
    } else {
        if ($is_edit) {
            // Jika dalam mode edit, update artikel yang ada
            $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ? WHERE id = ?");  // Siapkan query update
            $stmt->execute([$title, $content, $article_id]);  // Eksekusi update dengan data baru
        } else {
            // Jika dalam mode tambah, masukkan artikel baru
            $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");  // Siapkan query insert
            $stmt->execute([$title, $content]);  // Eksekusi insert dengan data baru
        }
        // Kembali ke dashboard setelah berhasil menyimpan
        header("Location: dashboard.php");  // Redirect ke dashboard
        exit;                            // Hentikan eksekusi skrip
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <!-- Judul halaman yang berisi judul dinamis -->
    <title><?php echo $page_title; ?> - CV Digital</title>
    <!-- Link ke file CSS utama dari direktori induk -->
    <link rel="stylesheet" href="../style.css">

    <!-- CSS internal untuk styling khusus halaman ini -->
    <style>
        /* Gaya untuk konten halaman manajemen artikel */
        .content {
            display: block; /* Ganti perilaku flex menjadi block */
            width: calc(100% - var(--sidebar-width)); /* Lebar bersih (kurangi lebar sidebar) */
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
            <li><a href="manage_article.php" class="active">Manajemen Artikel</a></li> <!-- Link ke halaman ini (aktif) -->
            <li><a href="pesan.php">Pesan Masuk</a></li> <!-- Link ke pesan masuk -->
            <li><a href="../index.php" target="_blank">Lihat Website</a></li> <!-- Link ke website utama -->
            <li><a href="logout.php">Logout</a></li> <!-- Link untuk logout -->
        </ul>
    </nav>

    <!-- Konten utama halaman -->
    <main class="content">
        <section class="card">
            <h2><?php echo $page_title; ?></h2> <!-- Tampilkan judul halaman dinamis -->

            <?php if (isset($error)): ?>
                <!-- Tampilkan pesan error jika ada -->
                <p style="color: #ff6b6b; margin-bottom: 1rem;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <!-- Form untuk tambah/edit artikel -->
            <form method="POST" action="manage_article.php<?php echo $is_edit ? '?id='.$article_id : ''; ?>" class="contact-form">
                <!-- Grup input judul artikel -->
                <div class="form-group">
                    <label for="title">Judul</label> <!-- Label untuk input judul -->
                    <!-- Input teks untuk judul artikel, nilai default dari data artikel -->
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
                </div>

                <!-- Grup input konten artikel -->
                <div class="form-group">
                    <label for="content">Konten</label> <!-- Label untuk input konten -->
                    <!-- Textarea untuk konten artikel, nilai default dari data artikel -->
                    <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                </div>

                <!-- Tombol submit (berbeda untuk mode edit/tambah) -->
                <button type="submit" class="btn"><?php echo $is_edit ? 'Update Artikel' : 'Simpan Artikel'; ?></button>
                <!-- Link untuk batal -->
                <a href="dashboard.php" style="margin-left: 1rem; color: var(--text-secondary-color-dark);">Batal</a>
            </form>
        </section>
    </main>

    <!-- Link ke file JavaScript eksternal dari direktori induk -->
    <script src="../script.js"></script>
</body>
</html>
