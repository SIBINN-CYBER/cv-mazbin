<?php
session_start();
// Memastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Memastikan ada ID artikel yang dikirim
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

require_once '../db.php';

$article_id = $_GET['id'];

// Hapus artikel dari database
$stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
$stmt->execute([$article_id]);

// Kembali ke dashboard setelah berhasil menghapus
header("Location: dashboard.php");
exit;
?>
