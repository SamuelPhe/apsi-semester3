<?php
session_start();
include 'koneksi.php';
include 'log_helper.php';

if (!isset($_GET['sekolah'])) {
    header("Location: index.php?menu=schedule");
    exit;
}

$sekolah = mysqli_real_escape_string($koneksi, $_GET['sekolah']);

/* 🔥 HAPUS FILE TERKAIT */
$qFiles = mysqli_query($koneksi, "
  SELECT f.path_file
  FROM file_soal f
  JOIN jadwal_ulangan j ON j.id_jadwal = f.id_jadwal
  WHERE j.sekolah = '$sekolah'
");

while ($f = mysqli_fetch_assoc($qFiles)) {
  $path = __DIR__ . '/uploads/' . $f['path_file'];
  if (file_exists($path)) unlink($path);
}

/* 🔥 HAPUS DATA FILE */
mysqli_query($koneksi, "
  DELETE f FROM file_soal f
  JOIN jadwal_ulangan j ON j.id_jadwal = f.id_jadwal
  WHERE j.sekolah = '$sekolah'
");

/* 🔥 HAPUS JADWAL */
mysqli_query($koneksi, "
  DELETE FROM jadwal_ulangan WHERE sekolah = '$sekolah'
");

log_perubahan(
  $koneksi,
  'Schedule',
  'DELETE',
  "Menghapus seluruh jadwal dan file sekolah $sekolah"
);

header("Location: index.php?menu=schedule");
exit;
