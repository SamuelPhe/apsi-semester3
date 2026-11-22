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
$idJadwal = (int) ($_POST['id_jadwal'] ?? 0);
$mode    = $_POST['mode'] ?? (!empty($_POST['reset']) ? 'reset' : 'update');

if ($sekolah === '' || $kelas === '' || $mapel === '') {
    scheduleJsonResponse([
        'success' => false,
        'message' => 'Identitas jadwal tidak lengkap. Tutup modal lalu buka kembali jadwalnya.'
    ], 422);
}

/*
 * Reset tetap menerima kombinasi sekolah/kelas/mapel karena tombol Reset
 * lama tidak mengirim id_jadwal.
 */
if ($mode === 'reset') {
    if ($idJadwal > 0) {
        $sql = "
            UPDATE jadwal_ulangan
            SET tanggal_ulangan = NULL,
                status_pekerjaan = 'not_started',
                detail_ulangan = NULL,
                user_id = ?
            WHERE id_jadwal = ?
              AND sekolah = ? AND kelas = ? AND mata_pelajaran = ?
        ";
        $stmt = mysqli_prepare($koneksi, $sql);
        if (!$stmt) {
            scheduleJsonResponse(['success' => false, 'message' => 'Query reset gagal disiapkan.'], 500);
        }
        mysqli_stmt_bind_param($stmt, 'sisss', $pic, $idJadwal, $sekolah, $kelas, $mapel);
    } else {
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
    }

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

/*
 * Cari jadwal menggunakan primary key bila tersedia. Sel kosong pada tabel
 * tidak mempunyai id_jadwal, sehingga pencarian dilanjutkan memakai identitas
 * sekolah/kelas/mapel.
 */
$old = null;
if ($idJadwal > 0) {
    $oldQ = mysqli_prepare(
        $koneksi,
        "SELECT id_jadwal, tanggal_ulangan, status_pekerjaan, detail_ulangan
         FROM jadwal_ulangan
         WHERE id_jadwal = ?
           AND sekolah = ? AND kelas = ? AND mata_pelajaran = ?
         LIMIT 1"
    );

    if (!$oldQ) {
        scheduleJsonResponse(['success' => false, 'message' => 'Data jadwal gagal diperiksa.'], 500);
    }

    mysqli_stmt_bind_param($oldQ, 'isss', $idJadwal, $sekolah, $kelas, $mapel);
    if (!mysqli_stmt_execute($oldQ)) {
        mysqli_stmt_close($oldQ);
        scheduleJsonResponse(['success' => false, 'message' => 'Data jadwal gagal diperiksa.'], 500);
    }
    $oldResult = mysqli_stmt_get_result($oldQ);
    $old = $oldResult ? mysqli_fetch_assoc($oldResult) : null;
    mysqli_stmt_close($oldQ);
}

if (!$old) {
    $oldQ = mysqli_prepare(
        $koneksi,
        "SELECT id_jadwal, tanggal_ulangan, status_pekerjaan, detail_ulangan
         FROM jadwal_ulangan
         WHERE sekolah = ? AND kelas = ? AND mata_pelajaran = ?
         ORDER BY id_jadwal ASC
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
}

$isNewSchedule = !$old;
$idJadwal = $isNewSchedule ? 0 : (int) $old['id_jadwal'];

// Status selesai hanya sah jika file soal sudah tersedia.
if ($status === 'completed') {
    if ($idJadwal < 1) {
        scheduleJsonResponse([
            'success' => false,
            'message' => 'Status Selesai hanya dapat dipilih setelah file soal diunggah.'
        ], 422);
    }

    $fileQ = mysqli_prepare(
        $koneksi,
        "SELECT COUNT(*) AS total FROM file_soal WHERE id_jadwal = ?"
    );

    if (!$fileQ) {
        scheduleJsonResponse(['success' => false, 'message' => 'Status file soal gagal diperiksa.'], 500);
    }

    mysqli_stmt_bind_param($fileQ, 'i', $idJadwal);
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

if ($isNewSchedule) {
    // Kotak pada matriks belum memiliki baris database: buat jadwal baru.
    // id_soal merupakan kolom legacy NOT NULL; relasi file menggunakan id_jadwal.
    $stmt = mysqli_prepare(
        $koneksi,
        "INSERT INTO jadwal_ulangan
            (id_soal, user_id, kelas, mata_pelajaran, status_pekerjaan,
             detail_ulangan, tanggal_ulangan, sekolah)
         VALUES ('', ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        scheduleJsonResponse(['success' => false, 'message' => 'Query pembuatan jadwal gagal disiapkan.'], 500);
    }

    mysqli_stmt_bind_param(
        $stmt,
        'sssssss',
        $pic,
        $kelas,
        $mapel,
        $status,
        $detail,
        $tanggal,
        $sekolah
    );

    if (!mysqli_stmt_execute($stmt)) {
        $message = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        error_log('EduSched schedule insert failed: ' . $message);
        scheduleJsonResponse(['success' => false, 'message' => 'Jadwal baru gagal dibuat. Periksa struktur database dan log server.'], 500);
    }

    $idJadwal = (int) mysqli_insert_id($koneksi);
    mysqli_stmt_close($stmt);

    log_perubahan(
        $koneksi,
        'Schedule',
        'CREATE',
        "Membuat jadwal $mapel - $kelas ($sekolah)"
    );

    scheduleJsonResponse([
        'success' => true,
        'id_jadwal' => $idJadwal,
        'created' => true
    ]);
}

// Jadwal telah ada: perbarui berdasarkan primary key.
$sql = "
    UPDATE jadwal_ulangan
    SET tanggal_ulangan = ?,
        status_pekerjaan = ?,
        detail_ulangan = ?,
        user_id = ?
    WHERE id_jadwal = ?
";

$stmt = mysqli_prepare($koneksi, $sql);
if (!$stmt) {
    scheduleJsonResponse(['success' => false, 'message' => 'Query penyimpanan gagal disiapkan.'], 500);
}

mysqli_stmt_bind_param(
    $stmt,
    'ssssi',
    $tanggal,
    $status,
    $detail,
    $pic,
    $idJadwal
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

scheduleJsonResponse([
    'success' => true,
    'id_jadwal' => $idJadwal,
    'created' => false
]);
