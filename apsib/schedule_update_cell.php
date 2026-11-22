<?php
header('Content-Type: application/json; charset=utf-8');

session_start();
require_once __DIR__ . '/auth_guard.php';

function scheduleJsonResponse(array $payload, int $statusCode = 200): void {
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

// Endpoint AJAX harus mengembalikan JSON, bukan redirect ke halaman login.
if (($_SESSION['login'] ?? false) !== true || empty($_SESSION['user_id'])) {
    scheduleJsonResponse([
        'success' => false,
        'message' => 'Sesi login berakhir. Silakan masuk kembali.'
    ], 401);
}

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/log_helper.php';

$sekolah = trim((string) ($_POST['sekolah'] ?? ''));
$kelas   = trim((string) ($_POST['kelas'] ?? ''));
$mapel   = trim((string) ($_POST['mapel'] ?? ''));
$pic     = (string) $_SESSION['user_id'];
$mode    = $_POST['mode'] ?? (!empty($_POST['reset']) ? 'reset' : 'update');

if ($sekolah === '' || $kelas === '' || $mapel === '') {
    scheduleJsonResponse([
        'success' => false,
        'message' => 'Identitas jadwal tidak lengkap. Tutup modal lalu buka kembali jadwalnya.'
    ], 422);
}

if ($mode === 'reset') {
    $sql = "
        UPDATE jadwal_ulangan
        SET tanggal_ulangan = NULL,
            status_pekerjaan = 'not_started',
            detail_ulangan = NULL,
            user_id = ?
        WHERE sekolah = ? AND kelas = ? AND mata_pelajaran = ?
    ";

    $stmt = mysqli_prepare($koneksi, $sql);
    if (!$stmt) {
        scheduleJsonResponse(['success' => false, 'message' => 'Query reset gagal disiapkan.'], 500);
    }

    mysqli_stmt_bind_param($stmt, 'ssss', $pic, $sekolah, $kelas, $mapel);
    if (!mysqli_stmt_execute($stmt)) {
        $message = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        error_log('EduSched schedule reset failed: ' . $message);
        scheduleJsonResponse(['success' => false, 'message' => 'Jadwal gagal di-reset. Periksa log server.'], 500);
    }

    mysqli_stmt_close($stmt);
    log_perubahan($koneksi, 'Schedule', 'UPDATE', "Reset jadwal $mapel - $kelas ($sekolah)");
    scheduleJsonResponse(['success' => true]);
}

$tanggal = trim((string) ($_POST['tanggal'] ?? ''));
$status  = trim((string) ($_POST['status'] ?? ''));
$detail  = trim((string) ($_POST['detail'] ?? ''));

if ($tanggal === '' || $status === '') {
    scheduleJsonResponse(['success' => false, 'message' => 'Tanggal dan status wajib diisi.'], 422);
}

if (!in_array($status, ['not_started', 'in_progress', 'completed'], true)) {
    scheduleJsonResponse(['success' => false, 'message' => 'Status jadwal tidak valid.'], 422);
}

$date = DateTime::createFromFormat('!Y-m-d', $tanggal);
if (!$date || $date->format('Y-m-d') !== $tanggal) {
    scheduleJsonResponse(['success' => false, 'message' => 'Format tanggal tidak valid.'], 422);
}

$oldQ = mysqli_prepare(
    $koneksi,
    "SELECT tanggal_ulangan, status_pekerjaan, detail_ulangan
     FROM jadwal_ulangan
     WHERE sekolah = ? AND kelas = ? AND mata_pelajaran = ?
     LIMIT 1"
);

if (!$oldQ) {
    scheduleJsonResponse(['success' => false, 'message' => 'Data jadwal gagal diperiksa.'], 500);
}

mysqli_stmt_bind_param($oldQ, 'sss', $sekolah, $kelas, $mapel);
if (!mysqli_stmt_execute($oldQ)) {
    mysqli_stmt_close($oldQ);
    scheduleJsonResponse(['success' => false, 'message' => 'Data jadwal gagal diperiksa.'], 500);
}

$oldResult = mysqli_stmt_get_result($oldQ);
$old = $oldResult ? mysqli_fetch_assoc($oldResult) : null;
mysqli_stmt_close($oldQ);

if (!$old) {
    scheduleJsonResponse(['success' => false, 'message' => 'Jadwal tidak ditemukan. Muat ulang halaman lalu coba lagi.'], 404);
}

// Status selesai hanya sah jika file soal sudah tersedia.
if ($status === 'completed') {
    $fileQ = mysqli_prepare(
        $koneksi,
        "SELECT COUNT(*) AS total
         FROM file_soal f
         INNER JOIN jadwal_ulangan j ON j.id_jadwal = f.id_jadwal
         WHERE j.sekolah = ? AND j.kelas = ? AND j.mata_pelajaran = ?"
    );

    if (!$fileQ) {
        scheduleJsonResponse(['success' => false, 'message' => 'Status file soal gagal diperiksa.'], 500);
    }

    mysqli_stmt_bind_param($fileQ, 'sss', $sekolah, $kelas, $mapel);
    mysqli_stmt_execute($fileQ);
    $fileResult = mysqli_stmt_get_result($fileQ);
    $fileRow = $fileResult ? mysqli_fetch_assoc($fileResult) : null;
    mysqli_stmt_close($fileQ);

    if ((int) ($fileRow['total'] ?? 0) < 1) {
        scheduleJsonResponse([
            'success' => false,
            'message' => 'Status Selesai hanya dapat dipilih setelah file soal diunggah.'
        ], 422);
    }
}

$sql = "
    UPDATE jadwal_ulangan
    SET tanggal_ulangan = ?,
        status_pekerjaan = ?,
        detail_ulangan = ?,
        user_id = ?
    WHERE sekolah = ? AND kelas = ? AND mata_pelajaran = ?
";

$stmt = mysqli_prepare($koneksi, $sql);
if (!$stmt) {
    scheduleJsonResponse(['success' => false, 'message' => 'Query penyimpanan gagal disiapkan.'], 500);
}

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

if (!mysqli_stmt_execute($stmt)) {
    $message = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    error_log('EduSched schedule update failed: ' . $message);
    scheduleJsonResponse(['success' => false, 'message' => 'Detail jadwal gagal disimpan. Periksa log server.'], 500);
}

mysqli_stmt_close($stmt);

$changes = [];
if (($old['tanggal_ulangan'] ?? null) != $tanggal) {
    $oldTgl = !empty($old['tanggal_ulangan']) ? date('d M Y', strtotime($old['tanggal_ulangan'])) : '-';
    $newTgl = date('d M Y', strtotime($tanggal));
    $changes[] = "Tanggal: $oldTgl → $newTgl";
}
if (($old['status_pekerjaan'] ?? null) != $status) {
    $changes[] = "Status: " . ($old['status_pekerjaan'] ?? '-') . " → $status";
}
if (($old['detail_ulangan'] ?? null) != $detail) {
    $changes[] = 'Deskripsi diubah';
}

if ($changes) {
    $detailLog = "Update jadwal $mapel - $kelas ($sekolah) | " . implode(' | ', $changes);
    log_perubahan($koneksi, 'Schedule', 'UPDATE', $detailLog);
}

scheduleJsonResponse(['success' => true]);
