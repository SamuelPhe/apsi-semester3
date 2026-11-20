<?php
include 'koneksi.php';

$bulan = (int) $_GET['bulan'];
$tahun = (int) $_GET['tahun'];

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    die('Akses ditolak');
}

/* =========================
   SUMMARY AKSI
========================= */
$summary = mysqli_query($koneksi, "
  SELECT aksi, COUNT(*) total
  FROM log_perubahan
  WHERE MONTH(waktu) = $bulan
    AND YEAR(waktu) = $tahun
  GROUP BY aksi
");

/* =========================
   REKAP MODUL
========================= */
$modul = mysqli_query($koneksi, "
  SELECT modul, aksi, COUNT(*) total
  FROM log_perubahan
  WHERE MONTH(waktu) = $bulan
    AND YEAR(waktu) = $tahun
  GROUP BY modul, aksi
");

/* =========================
   USER TERAKTIF
========================= */
$user = mysqli_query($koneksi, "
  SELECT u.username, u.role, COUNT(*) total
  FROM log_perubahan l
  JOIN users u ON l.user_id = u.user_id
  WHERE MONTH(l.waktu) = $bulan
    AND YEAR(l.waktu) = $tahun
  GROUP BY u.username, u.role
  ORDER BY total DESC
");
?>
