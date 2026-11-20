<?php
session_start();
include 'log_helper.php';
include 'koneksi.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

if ($action !== 'create_schedule') {
  echo json_encode(['success' => false, 'message' => 'Action invalid']);
  exit;
}

$sekolah = trim($_POST['sekolah'] ?? '');
$jumlahKelas = (int)($_POST['jumlah_kelas'] ?? 0);
$jumlahMapel = (int)($_POST['jumlah_mapel'] ?? 0);

if (!$sekolah || $jumlahKelas < 1 || $jumlahMapel < 1) {
  echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
  exit;
}

$stmt = mysqli_prepare(
  $koneksi,
  "INSERT INTO jadwal_ulangan (sekolah, kelas, mata_pelajaran) VALUES (?, ?, ?)"
);

for ($k = 1; $k <= $jumlahKelas; $k++) {
  $kelas = "Kelas $k";

  for ($m = 1; $m <= $jumlahMapel; $m++) {
    $mapel = "Mapel $m";

    mysqli_stmt_bind_param($stmt, 'sss', $sekolah, $kelas, $mapel);
    mysqli_stmt_execute($stmt);
  }
}

log_perubahan(
  $koneksi,
  'Schedule',
  'CREATE',
  "Menambahkan jadwal baru untuk sekolah $sekolah ($jumlahKelas kelas, $jumlahMapel mapel)"
);

mysqli_stmt_close($stmt);



echo json_encode(['success' => true]);