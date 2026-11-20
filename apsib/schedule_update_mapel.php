<?php
session_start();
include 'koneksi.php';
include 'log_helper.php';

header('Content-Type: application/json');

$sekolah   = $_POST['sekolah'] ?? '';
$oldMapel  = $_POST['old_mapel'] ?? '';
$newMapel  = $_POST['new_mapel'] ?? '';

if (!$sekolah || !$oldMapel || !$newMapel) {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    exit;
}

$query = "
UPDATE jadwal_ulangan
SET mata_pelajaran = ?
WHERE sekolah = ?
AND mata_pelajaran = ?
";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'sss', $newMapel, $sekolah, $oldMapel);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true]);
    log_perubahan(
    $koneksi,
    'Schedule',
    'UPDATE',
    "Mengubah nama mapel di sekolah $sekolah dari $oldMapel menjadi $newMapel"
    );

} else {
    echo json_encode([
        'success' => false,
        'message' => mysqli_error($koneksi)
    ]);
}