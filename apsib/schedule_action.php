<?php
header('Content-Type: application/json; charset=utf-8');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function createScheduleResponse(array $payload, int $statusCode = 200): void {
    http_response_code($statusCode);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

// This endpoint is called through fetch(), so return JSON rather than redirecting.
if (($_SESSION['login'] ?? false) !== true || empty($_SESSION['user_id'])) {
    createScheduleResponse([
        'success' => false,
        'message' => 'Sesi login berakhir. Silakan masuk kembali.'
    ], 401);
}

if (($_SESSION['role'] ?? '') !== 'admin') {
    createScheduleResponse([
        'success' => false,
        'message' => 'Hanya admin yang dapat membuat sekolah dan jadwal baru.'
    ], 403);
}

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/log_helper.php';

$action = $_POST['action'] ?? '';
if ($action !== 'create_schedule') {
    createScheduleResponse(['success' => false, 'message' => 'Permintaan pembuatan jadwal tidak valid.'], 400);
}

$sekolah = trim((string) ($_POST['sekolah'] ?? ''));
$jumlahKelas = filter_var($_POST['jumlah_kelas'] ?? null, FILTER_VALIDATE_INT);
$jumlahMapel = filter_var($_POST['jumlah_mapel'] ?? null, FILTER_VALIDATE_INT);
$userId = (string) $_SESSION['user_id'];

$schoolLength = function_exists('mb_strlen') ? mb_strlen($sekolah, 'UTF-8') : strlen($sekolah);

if ($sekolah === '' || $schoolLength > 50) {
    createScheduleResponse([
        'success' => false,
        'message' => 'Nama sekolah wajib diisi dan maksimal 50 karakter.'
    ], 422);
}

if ($jumlahKelas === false || $jumlahKelas < 1 || $jumlahKelas > 50) {
    createScheduleResponse([
        'success' => false,
        'message' => 'Jumlah kelas harus antara 1 sampai 50.'
    ], 422);
}

if ($jumlahMapel === false || $jumlahMapel < 1 || $jumlahMapel > 50) {
    createScheduleResponse([
        'success' => false,
        'message' => 'Jumlah mata pelajaran harus antara 1 sampai 50.'
    ], 422);
}

// Hindari dua kelompok jadwal dengan nama sekolah yang sama.
$check = mysqli_prepare($koneksi, "SELECT id_jadwal FROM jadwal_ulangan WHERE sekolah = ? LIMIT 1");
if (!$check) {
    error_log('EduSched create schedule: failed to prepare duplicate check: ' . mysqli_error($koneksi));
    createScheduleResponse(['success' => false, 'message' => 'Pemeriksaan nama sekolah gagal.'], 500);
}

mysqli_stmt_bind_param($check, 's', $sekolah);
if (!mysqli_stmt_execute($check)) {
    mysqli_stmt_close($check);
    createScheduleResponse(['success' => false, 'message' => 'Pemeriksaan nama sekolah gagal.'], 500);
}
$existing = mysqli_stmt_get_result($check);
$schoolExists = $existing && mysqli_fetch_assoc($existing);
mysqli_stmt_close($check);

if ($schoolExists) {
    createScheduleResponse([
        'success' => false,
        'message' => 'Nama sekolah tersebut sudah memiliki jadwal. Gunakan menu Edit Jadwal Sekolah untuk menambah kelas atau mata pelajaran.'
    ], 409);
}

// id_soal dan user_id adalah kolom NOT NULL pada skema saat ini.
// id_soal dikosongkan sampai file soal ditautkan; user_id diisi dari akun admin.
$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO jadwal_ulangan
        (id_soal, user_id, kelas, mata_pelajaran, sekolah)
     VALUES ('', ?, ?, ?, ?)"
);

if (!$stmt) {
    error_log('EduSched create schedule: failed to prepare insert: ' . mysqli_error($koneksi));
    createScheduleResponse(['success' => false, 'message' => 'Query pembuatan jadwal gagal disiapkan.'], 500);
}

if (!mysqli_begin_transaction($koneksi)) {
    mysqli_stmt_close($stmt);
    createScheduleResponse(['success' => false, 'message' => 'Database tidak dapat memulai proses pembuatan sekolah.'], 500);
}

$created = 0;
$failed = false;
$failureMessage = '';

for ($k = 1; $k <= $jumlahKelas && !$failed; $k++) {
    $kelas = "Kelas $k";

    for ($m = 1; $m <= $jumlahMapel; $m++) {
        $mapel = "Mapel $m";

        mysqli_stmt_bind_param($stmt, 'ssss', $userId, $kelas, $mapel, $sekolah);

        if (!mysqli_stmt_execute($stmt)) {
            $failed = true;
            $failureMessage = mysqli_stmt_error($stmt);
            break;
        }

        $created++;
    }
}

mysqli_stmt_close($stmt);

if ($failed) {
    mysqli_rollback($koneksi);
    error_log('EduSched create schedule failed: ' . $failureMessage);
    createScheduleResponse([
        'success' => false,
        'message' => 'Jadwal sekolah gagal dibuat. Tidak ada data yang disimpan. Periksa log server.'
    ], 500);
}

if (!mysqli_commit($koneksi)) {
    mysqli_rollback($koneksi);
    createScheduleResponse([
        'success' => false,
        'message' => 'Perubahan jadwal gagal dikonfirmasi oleh database.'
    ], 500);
}

log_perubahan(
    $koneksi,
    'Schedule',
    'CREATE',
    "Menambahkan sekolah $sekolah dengan $jumlahKelas kelas, $jumlahMapel mata pelajaran ($created jadwal)"
);

createScheduleResponse([
    'success' => true,
    'message' => 'Sekolah dan jadwal berhasil dibuat.',
    'created_count' => $created
]);
