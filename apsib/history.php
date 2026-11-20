<style>
/* ===============================
   HISTORY – PREMIUM LIVE UI
================================ */

.history-card {
    background: linear-gradient(180deg,#ffffff,#f9fafb);
    border-radius: 26px;
    box-shadow:
        0 25px 60px rgba(79,70,229,.15),
        inset 0 1px 0 rgba(255,255,255,.9);
    padding: 26px;
    position: relative;
    overflow: hidden;
}

/* soft glow */
.history-card::before {
    content:"";
    position:absolute;
    inset:0;
    background:
      radial-gradient(circle at top right, rgba(99,102,241,.12), transparent 55%);
    pointer-events:none;
}

/* ===============================
   TABLE
================================ */
.history-table {
    width:100%;
    border-collapse:separate;
    border-spacing:0 14px;
}

.history-table thead th {
    background: rgba(238,242,255,.9);
    backdrop-filter: blur(6px);
    color:#4338ca;
    font-size:13px;
    font-weight:800;
    border:none;
    padding:16px;
    text-transform:uppercase;
    letter-spacing:.04em;
}

/* row */
.history-table tbody tr {
    background: linear-gradient(180deg,#ffffff,#f8fafc);
    border-radius:18px;
    box-shadow:0 14px 30px rgba(0,0,0,.08);
    transition:.35s cubic-bezier(.4,0,.2,1);
    position:relative;
}

.history-table tbody tr:hover {
    transform:translateY(-6px) scale(1.01);
    box-shadow:0 28px 70px rgba(79,70,229,.28);
}

/* cell */
.history-table tbody td {
    border:none;
    padding:18px;
    vertical-align:middle;
}

/* ===== HIDE HORIZONTAL SCROLLBAR (HISTORY) ===== */
.history-card .table-responsive {
    overflow-x: hidden;
}

/* pastikan tabel tidak maksa lebar */
.history-table {
    table-layout: fixed;
}

/* biar kolom deskripsi bisa wrap */
.history-desc {
    white-space: normal;
    word-break: break-word;
}

/* ===============================
   USER
================================ */
.history-user {
    font-weight:800;
    color:#111827;
}
.history-user small {
    display:block;
    font-size:12px;
    color:#6b7280;
}

/* ===============================
   BADGE AKSI
================================ */
.badge-action {
    padding:7px 16px;
    font-size:12px;
    font-weight:900;
    border-radius:999px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    letter-spacing:.04em;
}

.badge-create {
    background:linear-gradient(135deg,#dcfce7,#bbf7d0);
    color:#15803d;
}
.badge-update {
    background:linear-gradient(135deg,#fef3c7,#fde68a);
    color:#b45309;
}
.badge-delete {
    background:linear-gradient(135deg,#fee2e2,#fecaca);
    color:#b91c1c;
}

/* ===============================
   DESKRIPSI
================================ */
.history-desc {
    font-size:14px;
    color:#374151;
    line-height:1.5;
}

/* ===============================
   TIME
================================ */
.history-time {
    font-size:13px;
    color:#6b7280;
    white-space:nowrap;
}

/* ===============================
   DELETE BUTTON
================================ */
.btn-history-delete {
    width:40px;
    height:40px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#fee2e2,#fecaca);
    color:#b91c1c;
    border:none;
    box-shadow:0 10px 25px rgba(239,68,68,.35);
    transition:.3s cubic-bezier(.4,0,.2,1);
}

.btn-history-delete:hover {
    background:linear-gradient(135deg,#fecaca,#fca5a5);
    transform:scale(1.18) rotate(-6deg);
    box-shadow:0 18px 45px rgba(239,68,68,.5);
}

/* ===============================
   TOP NAVBAR – PURPLE STYLE
================================ */
.content .navbar,
.navbar {
    background: linear-gradient(90deg,#4f46e5,#6d5dfc) !important;
    border-radius: 16px;
    margin-bottom: 24px;
    box-shadow: 0 12px 30px rgba(79,70,229,.35);
}

/* search input */
.navbar input,
.navbar .form-control {
    border-radius: 12px;
    background: rgba(255,255,255,.95);
    border: none;
}

/* hamburger icon */
.navbar .btn,
.navbar-toggler {
    background: rgba(255,255,255,.15);
    border-radius: 12px;
    color: #ffffff;
}

/* user name */
.navbar .nav-link,
.navbar span,
.navbar small {
    color: #ffffff !important;
}

/* avatar border */
.navbar img {
    border: 2px solid rgba(255,255,255,.6);
}

/* ===== SUMMARY SECTION ===== */
.summary-wrapper {
    margin: 32px 0 40px; /* jarak dari header & konten bawah */
}

.summary-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 10px 25px rgba(79,70,229,0.12);
    position: relative;
    overflow: hidden;
    transition: all .25s ease;
}

.summary-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(99,102,241,.15), transparent);
}

.summary-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(79,70,229,.2);
}

.summary-card small {
    color: #6b7280;
    font-size: 13px;
}

.summary-card h4 {
    margin-top: 6px;
    font-weight: 800;
    color: #111827;
}

/* VARIANT */
.summary-card.admin h4 {
    color: #4f46e5;
}

.summary-card.guru h4 {
    color: #0ea5e9;
}

/* ===============================
   HISTORY – PROFESSIONAL COMPACT UI
================================ */

/* CARD */
.history-card {
    background: linear-gradient(180deg,#ffffff,#f9fafb);
    border-radius: 22px;
    box-shadow: 0 18px 45px rgba(79,70,229,.14);
    padding: 20px 22px;
    position: relative;
    overflow: hidden;
}

/* soft accent */
.history-card::before {
    content:"";
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:90px;
    background: linear-gradient(90deg, rgba(99,102,241,.12), transparent);
    pointer-events:none;
}
.filter-dropdown-bottom {
  width: 260px;
  margin-top: 10px;
  border-radius: 14px;
  box-shadow: 0 15px 40px rgba(0,0,0,.12);
  border: 1px solid #e5e7eb;
}

.filter-anchor {
  position: relative;
}

/* ===============================
   TABLE
================================ */
.history-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px; /* 🔽 lebih rapat */
    table-layout: fixed;
}

/* HEADER */
.history-table thead th {
    background: #eef2ff;
    color: #4338ca;
    font-size: 12px;
    font-weight: 800;
    border: none;
    padding: 12px 14px; /* 🔽 lebih kecil */
    text-transform: uppercase;
    letter-spacing: .04em;
}

/* ROW */
.history-table tbody tr {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 6px 16px rgba(0,0,0,.06);
    transition: .25s ease;
}

.history-table tbody tr:hover {
    background: #f8fafc;
    box-shadow: 0 14px 32px rgba(79,70,229,.18);
}

/* CELL */
.history-table tbody td {
    border: none;
    padding: 12px 14px; /* 🔽 lebih compact */
    vertical-align: middle;
}

/* ===============================
   USER
================================ */
.history-user {
    font-weight: 700;
    font-size: 14px;
    color: #111827;
    line-height: 1.2;
}
.history-user small {
    display: block;
    font-size: 11px;
    color: #6b7280;
    margin-top: 2px;
}

/* ===============================
   BADGE AKSI
================================ */
.badge-action {
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 800;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    letter-spacing: .04em;
}

.badge-create {
    background: #dcfce7;
    color: #15803d;
}
.badge-update {
    background: #fef3c7;
    color: #b45309;
}
.badge-delete {
    background: #fee2e2;
    color: #b91c1c;
}

/* ===============================
   DESKRIPSI
================================ */
.history-desc {
    font-size: 13px;
    color: #374151;
    line-height: 1.4;
    white-space: normal;
    word-break: break-word;
}

/* ===============================
   TIME
================================ */
.history-time {
    font-size: 12px;
    color: #6b7280;
    white-space: nowrap;
}

/* ===============================
   ACTION COLUMN (BIAR TIDAK KELEBARAN)
================================ */
.history-table th:last-child,
.history-table td:last-child {
    width: 70px;        /* 🔥 penting */
    text-align: right;
}

/* DELETE BUTTON */
.btn-history-delete {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fee2e2;
    color: #b91c1c;
    border: none;
    box-shadow: 0 6px 14px rgba(239,68,68,.3);
    transition: .2s ease;
}

.btn-history-delete:hover {
    background: #fecaca;
    transform: scale(1.1);
}

/* ===============================
   RESPONSIVE (AMAN DI LAPTOP KECIL)
================================ */
@media (max-width: 992px) {
    .history-desc {
        font-size: 12px;
    }
}

</style>

<?php

include 'koneksi.php';

$where = [];
$order = ($_GET['sort'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC';

/* ======================
   FILTER USER
====================== */
if (!empty($_GET['user'])) {
    $user = mysqli_real_escape_string($koneksi, $_GET['user']);
    $where[] = "u.username LIKE '%$user%'";
}

/* ======================
   FILTER AKSI
====================== */
if (!empty($_GET['aksi'])) {
    $aksi = mysqli_real_escape_string($koneksi, $_GET['aksi']);
    $where[] = "lp.aksi = '$aksi'";
}

/* ======================
   FILTER RENTANG WAKTU
====================== */
if (!empty($_GET['from'])) {
    $from = mysqli_real_escape_string($koneksi, $_GET['from']);
    $where[] = "DATE(lp.waktu) >= '$from'";
}

if (!empty($_GET['to'])) {
    $to = mysqli_real_escape_string($koneksi, $_GET['to']);
    $where[] = "DATE(lp.waktu) <= '$to'";
}

/* ======================
  MONTHLY REPORT
====================== */
$reportMonth = isset($_GET['report_month']) ? (int)$_GET['report_month'] : null;
$reportYear  = isset($_GET['report_year'])  ? (int)$_GET['report_year']  : null;

$summaryReport = null;

if ($reportMonth && $reportYear) {
    $summaryReport = mysqli_query($koneksi, "
        SELECT aksi, COUNT(*) total
        FROM log_perubahan
        WHERE MONTH(waktu) = $reportMonth
          AND YEAR(waktu) = $reportYear
        GROUP BY aksi
    ");
}

$moduleReport = null;

if ($reportMonth && $reportYear) {
    $moduleReport = mysqli_query($koneksi, "
        SELECT modul, aksi, COUNT(*) total
        FROM log_perubahan
        WHERE MONTH(waktu) = $reportMonth
          AND YEAR(waktu) = $reportYear
        GROUP BY modul, aksi
    ");
}


$userReport = null;

if ($reportMonth && $reportYear) {
    $userReport = mysqli_query($koneksi, "
        SELECT u.username, u.role, COUNT(*) total
        FROM log_perubahan l
        JOIN users u ON l.user_id = u.user_id
        WHERE MONTH(l.waktu) = $reportMonth
          AND YEAR(l.waktu) = $reportYear
        GROUP BY u.username, u.role
        ORDER BY total DESC
    ");
}

if (
    ($reportMonth || $reportYear) &&
    $_SESSION['role'] !== 'admin'
) {
    http_response_code(403);
    die('Akses ditolak');
}

/* ======================
   QUERY FINAL
====================== */
$sql = "
    SELECT
        lp.*,
        u.username,
        u.role
    FROM log_perubahan lp
    LEFT JOIN users u ON lp.user_id = u.user_id
";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY lp.waktu $order";

$q = mysqli_query($koneksi, $sql);

?>


<div class="container-fluid px-4 pt-4">

    <!-- HEADER -->
<!-- HEADER + FILTER -->
<div class="d-flex align-items-center justify-content-between mb-3 filter-anchor">

  <div>
    <h3 class="mb-1 fw-bold">History</h3>
    <p class="text-muted mb-0">Riwayat aktivitas & perubahan data</p>
  </div>

  <div class="d-flex gap-2">

    <!-- CREATE MONTHLY REPORT -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
<!-- MODAL MONTHLY REPORT -->
<?php endif; ?>
 
   <?php if ($_SESSION['role'] === 'admin'): ?>
<button class="btn btn-sm btn-primary d-flex align-items-center gap-1"
        data-bs-toggle="modal"
        data-bs-target="#monthlyReportModal">
  <i class="fas fa-file-alt"></i>
  Monthly Report
</button>
<?php endif; ?>


    <!-- FILTER DROPDOWN -->
    <div class="dropdown position-relative">
      <button class="btn btn-sm btn-outline-secondary"
              data-bs-toggle="dropdown">
        <i class="fas fa-filter"></i>
      </button>

      <div class="dropdown-menu filter-dropdown-bottom p-3">
        <form method="GET">

          <!-- wajib -->
          <input type="hidden" name="menu" value="history">

          <!-- USER -->
          <label class="small">User</label>
          <input type="text"
                 name="user"
                 class="form-control mb-2"
                 placeholder="Cari username"
                 value="<?= htmlspecialchars($_GET['user'] ?? '') ?>">

          <!-- AKSI -->
          <label class="small">Aksi</label>
          <select name="aksi" class="form-control mb-2">
            <option value="">Semua</option>
            <option value="CREATE" <?= ($_GET['aksi'] ?? '')=='CREATE'?'selected':'' ?>>CREATE</option>
            <option value="UPDATE" <?= ($_GET['aksi'] ?? '')=='UPDATE'?'selected':'' ?>>UPDATE</option>
            <option value="DELETE" <?= ($_GET['aksi'] ?? '')=='DELETE'?'selected':'' ?>>DELETE</option>
          </select>

          <!-- DARI -->
          <label class="small">Dari</label>
          <input type="date"
                 name="from"
                 class="form-control mb-2"
                 value="<?= htmlspecialchars($_GET['from'] ?? '') ?>">

          <!-- SAMPAI -->
          <label class="small">Sampai</label>
          <input type="date"
                 name="to"
                 class="form-control mb-2"
                 value="<?= htmlspecialchars($_GET['to'] ?? '') ?>">

          <!-- SORT -->
          <label class="small">Urutan</label>
          <select name="sort" class="form-control mb-3">
            <option value="DESC" <?= ($_GET['sort'] ?? 'DESC')=='DESC'?'selected':'' ?>>
              Terbaru
            </option>
            <option value="ASC" <?= ($_GET['sort'] ?? '')=='ASC'?'selected':'' ?>>
              Terlama
            </option>
          </select>

          <!-- ACTION -->
          <button class="btn btn-primary btn-sm w-100">
            Terapkan
          </button>

          <a href="index.php?menu=history"
             class="btn btn-outline-secondary btn-sm w-100 mt-2">
            Reset
          </a>
        </form>
      </div>
    </div>

<?php if ($_SESSION['role'] === 'admin'): ?>
<a href="history_clear.php"
   class="btn btn-sm btn-danger"
   onclick="return confirm('Yakin ingin menghapus SEMUA history?')">
  <i class="fas fa-trash"></i>
  Clear All
</a>
<?php endif; ?>

  </div>
</div>

    
<?php if ($q && mysqli_num_rows($q) > 0): ?>

<div class="history-card">
    <div class="table-responsive">
        <table class="history-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                    <th class="text-end">Delete</th>
                </tr>
            </thead>
            <!-- MODAL MONTHLY REPORT -->
             
<div class="modal fade" id="monthlyReportModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form method="GET"
      action="history_monthly_report_pdf.php"
      target="_blank">

  <input type="hidden" name="menu" value="history">
      <div class="modal-content rounded-4 border-0 shadow">
        
        <div class="modal-header">
          <h5 class="modal-title fw-bold">
            Generate Monthly Report
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          
        <label class="small fw-semibold">Bulan</label>
            <select name="bulan" class="form-control mb-3" required>
            <?php for ($i=1;$i<=12;$i++): ?>
                <option value="<?= $i ?>">
                <?= date('F', mktime(0,0,0,$i,1)) ?>
                </option>
            <?php endfor; ?>
            </select>

            <label class="small fw-semibold">Tahun</label>
            <select name="tahun" class="form-control" required>
            <?php for ($y=date('Y');$y>=date('Y')-5;$y--): ?>
                <option value="<?= $y ?>"><?= $y ?></option>
            <?php endfor; ?>
            </select>


        </div>

        <?php if ($reportMonth && $reportYear): ?>

<div class="summary-wrapper">

  <h5 class="fw-bold mb-3">
    Monthly Activity Report —
    <?= date('F', mktime(0,0,0,$reportMonth,1)) ?> <?= $reportYear ?>
  </h5>

  <!-- SUMMARY AKSI -->
  <div class="row g-3 mb-4">
    <?php while ($s = mysqli_fetch_assoc($summaryReport)): ?>
      <div class="col-md-4">
        <div class="summary-card">
          <small><?= htmlspecialchars($s['aksi']) ?></small>
          <h4><?= $s['total'] ?></h4>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- REKAP MODUL -->
  <div class="history-card mb-4">
    <h6 class="fw-bold mb-3">Rekap Aktivitas per Modul</h6>
    <table class="history-table">
      <thead>
        <tr>
          <th>Modul</th>
          <th>Aksi</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($m = mysqli_fetch_assoc($moduleReport)): ?>
        <tr>
          <td><?= htmlspecialchars($m['modul']) ?></td>
          <td><?= htmlspecialchars($m['aksi']) ?></td>
          <td><?= $m['total'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- USER TERAKTIF -->
  <div class="history-card">
    <h6 class="fw-bold mb-3">User Teraktif</h6>
    <table class="history-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Role</th>
          <th>Total Aktivitas</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = mysqli_fetch_assoc($userReport)): ?>
        <tr>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <td><?= htmlspecialchars($u['role']) ?></td>
          <td><?= $u['total'] ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</div>

<?php endif; ?>

                <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <button class="btn btn-primary">
                    Generate
                </button>
                </div>

            </div>
            </form>
        </div>
        </div>

            <tbody>
            <?php while ($h = mysqli_fetch_assoc($q)): ?>
                <tr>

                    <!-- USER -->
                    <td>
                        <div class="history-user">
                            <?= htmlspecialchars($h['username'] ?? 'System') ?> (<?= htmlspecialchars($h['user_id'] ?? 'System') ?>)
                            <small><?= htmlspecialchars($h['role'] ?? '-') ?></small>
                        </div>
                    </td>

                    <!-- AKSI -->
                    <td>
                        <span class="badge-action
                            <?= $h['aksi']=='CREATE'?'badge-create':
                                ($h['aksi']=='UPDATE'?'badge-update':'badge-delete'); ?>">
                            <?= htmlspecialchars($h['aksi']) ?>
                        </span>
                    </td>

                    <!-- DESKRIPSI -->
                    <td>
                        <div class="history-desc">
                            <?= htmlspecialchars($h['detail_perubahan']) ?>
                        </div>
                    </td>

                    <!-- WAKTU -->
                    <td>
                        <div class="history-time">
                            <?= date('d M Y H:i', strtotime($h['waktu'])) ?>
                        </div>
                    </td>

                    <!-- ACTION -->
                   <td class="text-end">
                    <?php if (
    $_SESSION['role'] === 'admin' ||
    $h['user_id'] === $_SESSION['user_id']
): ?>

                        <a href="history_delete.php?id=<?= $h['id_perubahan'] ?>"
                        class="btn-history-delete"
                        title="Hapus history"
                        onclick="return confirm('Hapus history ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    <?php else: ?>
                        <span class="text-muted">—</span>
                    <?php endif; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php else: ?>

<!-- EMPTY STATE -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <i class="fas fa-history fa-3x text-muted mb-3"></i>
        <h5 class="fw-bold">Belum ada riwayat</h5>
        <p class="text-muted mb-0">
            Aktivitas seperti penjadwalan, update, atau penghapusan akan muncul di sini.
        </p>
    </div>
</div>

<?php endif; ?>

</div>

<script>
if (new URLSearchParams(window.location.search).has('report_month')) {
  const modal = document.getElementById('monthlyReportModal');
  if (modal) bootstrap.Modal.getOrCreateInstance(modal).hide();
}
</script>

<?php if ($_SESSION['role'] === 'admin'): ?>
<div class="modal fade" id="monthlyReportModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form method="GET" action="history_monthly_report_pdf.php" target="_blank">

      <input type="hidden" name="menu" value="history">

      <div class="modal-content rounded-4 border-0 shadow">

        <div class="modal-header">
          <h5 class="modal-title fw-bold">Generate Monthly Report</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <label class="small fw-semibold">Bulan</label>
          <select name="bulan" required>...</select>
            <?php for ($i=1;$i<=12;$i++): ?>
              <option value="<?= $i ?>">
                <?= date('F', mktime(0,0,0,$i,1)) ?>
              </option>
            <?php endfor; ?>
          </select>

          <label class="small fw-semibold">Tahun</label>
          <select name="tahun" required>...</select>
            <?php for ($y=date('Y');$y>=date('Y')-5;$y--): ?>
              <option value="<?= $y ?>"><?= $y ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <div class="modal-footer">
          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Batal
          </button>
          <button class="btn btn-primary">Generate</button>
        </div>

      </div>
    </form>
  </div>
</div>
<?php endif; ?>
