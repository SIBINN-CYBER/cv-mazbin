<?php
// Mulai sesi PHP untuk mengelola data sesi pengguna
session_start();
// Sertakan file koneksi database dari direktori induk
require_once '../db.php';

// Cek apakah pengguna sudah login, jika ya maka redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");  // Redirect ke halaman dashboard
    exit;                              // Hentikan eksekusi skrip
}

// Variabel untuk menyimpan pesan error
$error = '';

// Cek apakah form telah disubmit (metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil username dan password dari form
    $username = $_POST['username'];      // Ambil username dari input form
    $password = $_POST['password'];      // Ambil password dari input form

    // Validasi apakah username dan password tidak kosong
    if (empty($username) || empty($password)) {
        $error = 'Username dan password tidak boleh kosong.';  // Set pesan error
    } else {
        // Siapkan perintah SQL untuk mencari pengguna berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        // Eksekusi perintah dengan username yang dimasukkan
        $stmt->execute([$username]);
        // Ambil data pengguna
        $user = $stmt->fetch();

        // Verifikasi password menggunakan password_verify (untuk password yang di-hash)
        if ($user && password_verify($password, $user['password'])) {
            // Jika verifikasi berhasil, set variabel sesi
            $_SESSION['user_id'] = $user['id'];      // Simpan ID pengguna ke sesi
            $_SESSION['username'] = $user['username'];  // Simpan username ke sesi
            header("Location: dashboard.php");        // Redirect ke dashboard
            exit;                                    // Hentikan eksekusi skrip
        } else {
            // Cek untuk password yang belum di-hash (untuk login pertama kali)
            if ($user && $user['password'] === 'password123' && $password === 'password123') {
                // Hash password baru dan update ke database
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // Hash password dengan algoritma default
                $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");  // Siapkan query update
                $update_stmt->execute([$hashed_password, $user['id']]);  // Eksekusi update password

                $_SESSION['user_id'] = $user['id'];      // Set ID pengguna ke sesi
                $_SESSION['username'] = $user['username'];  // Set username ke sesi
                header("Location: dashboard.php");        // Redirect ke dashboard
                exit;                                    // Hentikan eksekusi skrip
            }
            // Jika semua verifikasi gagal, set pesan error
            $error = 'Username atau password salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Metadata halaman -->
    <meta charset="UTF-8"> <!-- Menentukan karakter set ke UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mengatur responsifitas desain -->
    <title>Admin Login</title> <!-- Judul halaman yang muncul di tab browser -->
    <!-- Link ke file CSS utama dari direktori induk -->
    <link rel="stylesheet" href="../style.css">

    <!-- CSS internal untuk styling halaman login -->
    <style>
        /* Override beberapa style untuk halaman login */
        body {
            justify-content: center;   /* Rata tengah horizontal */
            align-items: center;       /* Rata tengah vertikal */
            min-height: 100vh;         /* Minimal tinggi layar penuh */
        }
        /* Gaya untuk konten login */
        .content {
            margin-left: 0;            /* Hilangkan margin kiri */
            width: 100%;               /* Lebar penuh */
            max-width: 400px;          /* Maksimal lebar 400px */
        }
        /* Gaya untuk kartu login */
        .login-card {
            width: 100%;               /* Lebar penuh kartu */
        }
        /* Sembunyikan sidebar di halaman login */
        .sidebar {
            display: none; /* Sembunyikan sidebar di halaman login */
        }
    </style>
</head>
<body>
    <!-- Konten utama halaman login -->
    <main class="content">
        <section class="card login-card">
            <h2>Admin Login</h2> <!-- Judul halaman login -->

            <?php if ($error): ?>
                <!-- Tampilkan pesan error jika ada -->
                <p style="color: #ff6b6b; margin-bottom: 1rem;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <!-- Form login -->
            <form method="POST" action="index.php" class="contact-form">
                <!-- Grup input username -->
                <div class="form-group">
                    <label for="username">Username</label> <!-- Label untuk input username -->
                    <input type="text" id="username" name="username" required> <!-- Input teks untuk username (wajib) -->
                </div>

                <!-- Grup input password -->
                <div class="form-group">
                    <label for="password">Password</label> <!-- Label untuk input password -->
                    <input type="password" id="password" name="password" required> <!-- Input password untuk password (wajib) -->
                </div>

                <!-- Tombol submit -->
                <button type="submit" class="btn">Login</button> <!-- Tombol untuk login -->
            </form>
        </section>
    </main>

    <!-- Link ke file JavaScript eksternal dari direktori induk -->
    <script src="../script.js"></script>
</body>
</html>
