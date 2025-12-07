<?php
session_start();
require_once '../db.php';

// Cek jika user belum login, redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Ambil semua pesan dari database, diurutkan dari yang terbaru
$stmt = $pdo->query("SELECT * FROM messages ORDER BY received_at DESC");
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pesan - Admin</title>
    <link rel="stylesheet" href="../style.css"> 
    <style>
        .content {
            display: block;
        }
        .message-card {
            border-left: 5px solid var(--primary-color);
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .message-meta {
            font-size: 0.9rem;
            color: var(--text-secondary-color);
        }
        .message-body {
            white-space: pre-wrap; /* Menjaga format teks */
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul>
            <li><a href="manage_article.php">Manajemen Artikel</a></li>
            <li><a href="pesan.php" class="active">Pesan Masuk</a></li>
            <li><a href="../index.php" target="_blank">Lihat Website</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main class="content">
        <section class="card">
            <h2>Pesan Masuk</h2>
        </section>

        <?php if (empty($messages)): ?>
            <section class="card">
                <p>Belum ada pesan yang masuk.</p>
            </section>
        <?php else: ?>
            <?php foreach ($messages as $msg): ?>
                <article class="card message-card">
                    <div class="message-header">
                        <strong><?php echo htmlspecialchars($msg['name']); ?></strong>
                        <span class="message-meta"><?php echo date('d F Y, H:i', strtotime($msg['received_at'])); ?></span>
                    </div>
                    <p class="message-meta">Email: <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>"><?php echo htmlspecialchars($msg['email']); ?></a></p>
                    <hr style="margin: 1rem 0; border-color: var(--border-color);">
                    <div class="message-body">
                        <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>

    </main>

    <script src="../script.js"></script>
</body>
</html>