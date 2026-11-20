


<?php
function log_perubahan($koneksi, $modul, $aksi, $detail) {
    if (!isset($_SESSION['user_id'])) return;

    $user_id = $_SESSION['user_id'];

    mysqli_query($koneksi, "
        INSERT INTO log_perubahan (user_id, modul, aksi, detail_perubahan)
        VALUES ('$user_id', '$modul', '$aksi', '$detail')
    ");
}


