<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id      = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];
$role    = $_SESSION['role'] ?? 'guru';

if ($id > 0) {

    // =============================
    // ADMIN → BOLEH HAPUS APA SAJA
    // =============================
    if ($role === 'admin') {
        $stmt = mysqli_prepare(
            $koneksi,
            "DELETE FROM log_perubahan WHERE id_perubahan = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $id);
    }

    // =============================
    // GURU → HANYA MILIK SENDIRI
    // =============================
    else {
        $stmt = mysqli_prepare(
            $koneksi,
            "DELETE FROM log_perubahan 
             WHERE id_perubahan = ? AND user_id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
    }

    mysqli_stmt_execute($stmt);
}

header("Location: index.php?menu=history");
exit;
