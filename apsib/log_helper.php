<?php
function log_perubahan($koneksi, $modul, $aksi, $detail) {
    if (empty($_SESSION['user_id'])) {
        return false;
    }

    $user_id = (string) $_SESSION['user_id'];
    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO log_perubahan (user_id, modul, aksi, detail_perubahan) VALUES (?, ?, ?, ?)"
    );

    if (!$stmt) {
        error_log('EduSched: gagal menyiapkan log perubahan: ' . mysqli_error($koneksi));
        return false;
    }

    mysqli_stmt_bind_param($stmt, 'ssss', $user_id, $modul, $aksi, $detail);
    $success = mysqli_stmt_execute($stmt);

    if (!$success) {
        error_log('EduSched: gagal menyimpan log perubahan: ' . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    return $success;
}
