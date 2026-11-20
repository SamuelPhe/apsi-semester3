<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role    = $_SESSION['role'] ?? 'guru';

/*
=================================
ADMIN → HAPUS SEMUA HISTORY
GURU  → HAPUS MILIK SENDIRI
=================================
*/
if ($role === 'admin') {

    // ADMIN: hapus semua history
    mysqli_query($koneksi, "DELETE FROM log_perubahan");
    $_SESSION['success'] = "Semua history berhasil dihapus.";

} else {

    // GURU: hanya milik sendiri
    $stmt = mysqli_prepare(
        $koneksi,
        "DELETE FROM log_perubahan WHERE user_id = ?"
    );
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = "History kamu berhasil dihapus.";
}

header("Location: index.php?menu=history");
exit;
