<?php
session_start();
include 'koneksi.php';

/* =========================
   AUTH: ADMIN ONLY
========================= */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    die('Akses ditolak');
}

/* =========================
   LOAD DOMPDF
========================= */
require_once __DIR__ . '/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

/* =========================
   PARAMETER
========================= */
$bulan = (int)($_GET['bulan'] ?? 0);
$tahun = (int)($_GET['tahun'] ?? 0);

if ($bulan < 1 || $bulan > 12 || $tahun < 2000) {
    die('Parameter tidak valid');
}

$namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));

/* =========================
   QUERY DATA
========================= */

// Ringkasan aksi
$qSummary = mysqli_query($koneksi, "
    SELECT aksi, COUNT(*) total
    FROM log_perubahan
    WHERE MONTH(waktu) = $bulan
      AND YEAR(waktu) = $tahun
    GROUP BY aksi
");

// Rekap modul
$qModul = mysqli_query($koneksi, "
    SELECT modul, aksi, COUNT(*) total
    FROM log_perubahan
    WHERE MONTH(waktu) = $bulan
      AND YEAR(waktu) = $tahun
    GROUP BY modul, aksi
");

// User teraktif
$qUser = mysqli_query($koneksi, "
    SELECT u.username, u.role, COUNT(*) total
    FROM log_perubahan l
    JOIN users u ON l.user_id = u.user_id
    WHERE MONTH(l.waktu) = $bulan
      AND YEAR(l.waktu) = $tahun
    GROUP BY u.username, u.role
    ORDER BY total DESC
");

/* =========================
   HITUNG TOTAL AKTIVITAS
========================= */
$totalAktivitas = 0;
while ($x = mysqli_fetch_assoc($qSummary)) {
    $totalAktivitas += $x['total'];
}
mysqli_data_seek($qSummary, 0);

/* =========================
   HTML PDF
========================= */
$html = "
<style>
@page {
    margin: 50px 40px;
}
body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
}
h1 {
    text-align: center;
    font-size: 18px;
    margin-bottom: 4px;
}
h2 {
    font-size: 14px;
    margin-top: 25px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    border: 1px solid #333;
    padding: 6px;
}
th {
    background: #eee;
}
hr {
    margin: 10px 0;
}
</style>

<div style='text-align:center'>
    <h1>EduSched</h1>
    <small>Sistem Informasi Manajemen Ulangan</small><br>
    <small>Bimbingan Belajar Focus Pontianak</small>
    <hr>
</div>

<p style='text-align:center'>
<b>LAPORAN AKTIVITAS SISTEM</b><br>
Periode: <b>$namaBulan $tahun</b><br>
Tanggal Cetak: " . date('d-m-Y') . "
</p>

<p>
Selama periode <b>$namaBulan $tahun</b>, sistem mencatat
<b>$totalAktivitas aktivitas</b> yang terdiri dari proses
pembuatan, perubahan, dan penghapusan data oleh pengguna sistem.
</p>

<h2>Ringkasan Aktivitas</h2>
<table>
<tr>
    <th>Aksi</th>
    <th>Total</th>
</tr>
";

while ($r = mysqli_fetch_assoc($qSummary)) {
    $html .= "
    <tr>
        <td>{$r['aksi']}</td>
        <td>{$r['total']}</td>
    </tr>";
}

$html .= "
</table>

<h2>Rekap Aktivitas per Modul</h2>
<table>
<tr>
    <th>Modul</th>
    <th>Aksi</th>
    <th>Total</th>
</tr>
";

while ($m = mysqli_fetch_assoc($qModul)) {
    $html .= "
    <tr>
        <td>{$m['modul']}</td>
        <td>{$m['aksi']}</td>
        <td>{$m['total']}</td>
    </tr>";
}

$html .= "
</table>

<h2>User Teraktif</h2>
<table>
<tr>
    <th>Username</th>
    <th>Role</th>
    <th>Total Aktivitas</th>
</tr>
";

while ($u = mysqli_fetch_assoc($qUser)) {
    $html .= "
    <tr>
        <td>{$u['username']}</td>
        <td>{$u['role']}</td>
        <td>{$u['total']}</td>
    </tr>";
}

$html .= "
</table>
";

/* =========================
   GENERATE PDF
========================= */
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

/* =========================
   PAGE NUMBER (BENAR)
========================= */
$canvas = $dompdf->getCanvas();
$font = $dompdf->getFontMetrics()->get_font("Helvetica", "normal");

$canvas->page_text(
    500,   // X (kanan bawah)
    820,   // Y (bawah halaman)
    "Halaman {PAGE_NUM} dari {PAGE_COUNT}",
    $font,
    9,
    [0,0,0]
);

/* =========================
   STREAM PDF (INLINE)
========================= */
$dompdf->stream(
    "Monthly_Report_{$namaBulan}_{$tahun}.pdf",
    ['Attachment' => false]
);
