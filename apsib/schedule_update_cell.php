<?php
session_start();
require_once __DIR__ . '/auth_guard.php';
requireLogin();
include 'koneksi.php';
include 'log_helper.php';

header('Content-Type: application/json');

$sekolah = $_POST['sekolah'] ?? '';
$kelas   = $_POST['kelas'] ?? '';
$mapel   = $_POST['mapel'] ?? '';
$mode    = $_POST['mode'] ?? 'update'; // 🆕
$pic     = $_SESSION['user_id'] ?? null;

if (!$sekolah || !$kelas || !$mapel) {
  echo json_encode(['success'=>false,'message'=>'Identitas cell tidak lengkap']);
  exit;
}

/*
====================================
RESET CELL
====================================
*/
if ($mode === 'reset') {

  $sql = "
    UPDATE jadwal_ulangan
    SET
      tanggal_ulangan = NULL,
      status_pekerjaan = 'not_started',
      detail_ulangan = NULL,
      user_id = ?
    WHERE sekolah = ?
      AND kelas = ?
      AND mata_pelajaran = ?
  ";

  $stmt = mysqli_prepare($koneksi, $sql);
  mysqli_stmt_bind_param($stmt, 'ssss', $pic, $sekolah, $kelas, $mapel);

  if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success'=>true]);
    log_perubahan(
    $koneksi,
    'Schedule',
    'UPDATE',
    "Reset jadwal $mapel - $kelas ($sekolah)"
  );

  } else {
    echo json_encode(['success'=>false,'message'=>mysqli_error($koneksi)]);
  }
  exit;
}

/*
====================================
UPDATE NORMAL (DENGAN HISTORY DETAIL)
====================================
*/

// ambil data lama dulu
$oldQ = mysqli_prepare(
  $koneksi,
  "SELECT tanggal_ulangan, status_pekerjaan, detail_ulangan
   FROM jadwal_ulangan
   WHERE sekolah=? AND kelas=? AND mata_pelajaran=?"
);
mysqli_stmt_bind_param($oldQ, 'sss', $sekolah, $kelas, $mapel);
mysqli_stmt_execute($oldQ);
$old = mysqli_fetch_assoc(mysqli_stmt_get_result($oldQ));

$oldTanggal = $old['tanggal_ulangan'];
$oldStatus  = $old['status_pekerjaan'];
$oldDetail  = $old['detail_ulangan'];

$tanggal = $_POST['tanggal'] ?? null;
$status  = $_POST['status'] ?? null;
$detail  = $_POST['detail'] ?? null;

// update data
$sql = "
UPDATE jadwal_ulangan
SET
  tanggal_ulangan = ?,
  status_pekerjaan = ?,
  detail_ulangan = ?,
  user_id = ?
WHERE sekolah = ?
  AND kelas = ?
  AND mata_pelajaran = ?
";

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param(
  $stmt,
  'sssssss',
  $tanggal,
  $status,
  $detail,
  $pic,
  $sekolah,
  $kelas,
  $mapel
);

if (mysqli_stmt_execute($stmt)) {

  // =============================
  // SUSUN DETAIL HISTORY
  // =============================
  $changes = [];

  // perubahan tanggal
  if ($oldTanggal != $tanggal) {
    $oldTgl = $oldTanggal ? date('d M Y', strtotime($oldTanggal)) : '-';
    $newTgl = $tanggal ? date('d M Y', strtotime($tanggal)) : '-';
    $changes[] = "Tanggal: $oldTgl → $newTgl";
  }

  // perubahan status
  if ($oldStatus != $status) {
    $changes[] = "Status: $oldStatus → $status";
  }

  // perubahan deskripsi (tanpa isi)
  if ($oldDetail != $detail) {
    $changes[] = "Deskripsi diubah";
  }

  // simpan log kalau ada perubahan
  if (!empty($changes)) {
    $detailLog =
      "Update jadwal $mapel - $kelas ($sekolah) | " .
      implode(' | ', $changes);

    log_perubahan(
      $koneksi,
      'Schedule',
      'UPDATE',
      $detailLog
    );
  }

  echo json_encode(['success'=>true]);

} else {
  echo json_encode(['success'=>false,'message'=>mysqli_error($koneksi)]);
}
