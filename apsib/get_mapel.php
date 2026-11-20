<?php
include 'koneksi.php';
header('Content-Type: application/json');

$sekolah = $_GET['sekolah'] ?? '';

if (!$sekolah) {
  echo json_encode([]);
  exit;
}

$q = mysqli_query($koneksi,"
  SELECT DISTINCT mata_pelajaran
  FROM jadwal_ulangan
  WHERE sekolah = '".mysqli_real_escape_string($koneksi,$sekolah)."'
  ORDER BY mata_pelajaran
");

$data = [];
while ($r = mysqli_fetch_assoc($q)) {
  $data[] = $r['mata_pelajaran'];
}

echo json_encode($data);
