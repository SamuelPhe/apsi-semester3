<?php
include 'koneksi.php';
header('Content-Type: application/json');

$sekolah = $_GET['sekolah'] ?? '';
$kelas   = $_GET['kelas'] ?? '';
$mapel   = $_GET['mapel'] ?? '';
$id = intval($_GET['id_jadwal'] ?? 0);

$q = mysqli_query($koneksi, "
  SELECT 
    j.tanggal_ulangan,
    j.status_pekerjaan,
    j.detail_ulangan,
    CONCAT(u.username,' (',u.user_id,')') AS pic
  FROM jadwal_ulangan j
  LEFT JOIN users u ON u.user_id = j.user_id
  WHERE j.id_jadwal = $id
  LIMIT 1
");

echo json_encode(mysqli_fetch_assoc($q));
