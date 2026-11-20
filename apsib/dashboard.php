<?php
include 'auth_guard.php';

?>

<style>
/* ===============================
   GLOBAL CARD STYLE
================================ */
.dashboard-card {
    background: linear-gradient(180deg,#ffffff,#f8fafc);
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}

/* ===============================
   TASK STATUS
================================ */
.task-card {
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    transition: .25s ease;
}
.task-card:hover {
    transform: translateY(-4px);
}

/* ===============================
   FILTER DROPDOWN
================================ */
.filter-dropdown-bottom {
    position: absolute !important;
    top: calc(100% + 14px);
    right: 0;
    width: 300px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 45px rgba(0,0,0,.15);
    z-index: 1050;
}

.filter-dropdown-bottom label {
    font-size: 12px;
    color: #6b7280;
    font-weight: 600;
}

.filter-dropdown-bottom .form-control,
.filter-dropdown-bottom .form-select {
    border-radius: 12px;
    font-size: 14px;
}

/* ===============================
   RECENT SCHEDULE TABLE
================================ */
.recent-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}

.table thead th {
    background: #f1f5f9;
    font-size: 13px;
    text-transform: uppercase;
    color: #475569;
}

.table tbody tr:hover {
    background: #f8fafc;
}

/* ===============================
   BADGES
================================ */
.badge {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 12px;
}

/* ===============================
   BUTTON
================================ */
.btn-primary {
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    border: none;
    border-radius: 12px;
}
.btn-outline-secondary {
    border-radius: 12px;
}

/* ===============================
   HEADER ALIGNMENT
================================ */
.filter-anchor {
    position: relative;
}

/* ===============================
   RECENT SCHEDULE – LIVE HERO CARD
================================ */
.section-card {
    background: linear-gradient(180deg,#ffffff,#f8fafc);
    border-radius: 22px;
    padding: 24px 26px;
    box-shadow: 0 18px 45px rgba(0,0,0,.08);
    border: 1px solid #e5e7eb;
}

/* ===============================
   TABLE FLOATING STYLE
================================ */
.section-card table {
    border-collapse: separate;
    border-spacing: 0 10px;
}

.section-card thead th {
    background: transparent;
    font-size: 12px;
    text-transform: uppercase;
    color: #64748b;
    border: none;
    padding-bottom: 6px;
}

/* === BARIS JADI "CARD" === */
.section-card tbody tr {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,.06);
    transition: all .25s ease;
}

/* interaksi */
.section-card tbody tr:hover {
    background: #f1f5f9;
    box-shadow: 0 10px 25px rgba(79,70,229,.15);
}

/* aksen kiri pas hover */
.section-card tbody tr:hover {
    box-shadow:
        inset 4px 0 0 #6366f1,
        0 10px 25px rgba(79,70,229,.15);
}

/* cell */
.section-card td {
    border: none !important;
    padding: 14px 16px;
}

/* ===============================
   STATUS BADGE – LEBIH HIDUP
================================ */
.badge.bg-success {
    box-shadow: 0 0 0 4px rgba(34,197,94,.15);
}

.badge.bg-warning {
    box-shadow: 0 0 0 4px rgba(251,191,36,.18);
}

.badge.bg-danger {
    box-shadow: 0 0 0 4px rgba(239,68,68,.18);
}

/* ===============================
   DETAIL BUTTON – FLOAT FEEL
================================ */
.section-card .btn-primary {
    border-radius: 999px;
    padding: 6px 16px;
    box-shadow: 0 6px 16px rgba(79,70,229,.35);
    transition: all .2s ease;
}

.section-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(79,70,229,.45);
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

/* ===============================
   DASHBOARD SHORTCUT CARDS
================================ */
.shortcut-wrapper {
    margin-top: 40px;
}

.shortcut-card {
    background: linear-gradient(135deg,#ffffff,#f8f9ff);
    border-radius: 22px;
    padding: 26px;
    height: 100%;
    cursor: pointer;
    border: 1px solid #e5e7eb;
    box-shadow: 0 14px 35px rgba(79,70,229,.12);
    transition: all .25s ease;
    position: relative;
    overflow: hidden;
}

.shortcut-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,#4f46e5,#6d5dfc);
    opacity: 0;
    transition: .25s ease;
}

.shortcut-card:hover::before {
    opacity: .08;
}

.shortcut-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 28px 60px rgba(79,70,229,.35);
}

.shortcut-icon {
    width: 54px;
    height: 54px;
    border-radius: 16px;
    background: linear-gradient(135deg,#4f46e5,#6d5dfc);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 22px;
    margin-bottom: 18px;
    box-shadow: 0 12px 28px rgba(79,70,229,.45);
}

.shortcut-title {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}

.shortcut-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.4;
}

/* ===============================
   UPCOMING SCHEDULE
================================ */
.upcoming-card {
    background: #ffffff;
    border-radius: 22px;
    padding: 24px;
    box-shadow: 0 18px 45px rgba(79,70,229,.12);
    margin-top: 32px;
}

.upcoming-item {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: .25s ease;
}

.upcoming-item:last-child {
    border-bottom: none;
}

.upcoming-item:hover {
    transform: translateX(6px);
    background: #f8fafc;
    border-radius: 12px;
    padding-left: 12px;
}

/* date box */
.upcoming-date {
    min-width: 58px;
    text-align: center;
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    color: #fff;
    border-radius: 14px;
    padding: 8px 0;
    font-weight: 700;
}

.upcoming-date span {
    display: block;
    font-size: 12px;
    opacity: .9;
}

/* info */
.upcoming-info h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
}

.upcoming-info small {
    color: #6b7280;
}

/* === HILANGKAN ICON DATE PICKER === */
input[type="date"]::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
}

/* Firefox */
input[type="date"] {
    appearance: textfield;
    -moz-appearance: textfield;
}

/* === HILANGKAN PANAH DROPDOWN SELECT === */
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: none !important;
}

/* ===============================
   UPCOMING SCHEDULE – LIVEN UP
================================ */

/* HEADER AREA */
.upcoming-card > .d-flex {
    padding-bottom: 10px;
    border-bottom: 1px solid #eef2ff;
}

/* Title lebih tegas */
.upcoming-card h6 {
    font-weight: 800;
    letter-spacing: .3px;
    position: relative;
}


/* SHOW ALL BUTTON – lebih hidup */
.upcoming-card .btn-primary {
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    border-radius: 999px;
    padding: 6px 18px;
    font-size: 13px;
    box-shadow: 0 8px 22px rgba(79,70,229,.35);
    transition: all .25s ease;
}

.upcoming-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(79,70,229,.5);
}

/* ===============================
   ITEM LIST – FEEL ALIVE
================================ */
.upcoming-item {
    border-radius: 16px;
    padding: 14px 16px;
    margin-bottom: 10px;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(0,0,0,.05);
}

/* hover lebih berasa */
.upcoming-item:hover {
    background: #f8fafc;
    transform: translateX(6px);
    box-shadow:
        inset 4px 0 0 #6366f1,
        0 12px 28px rgba(79,70,229,.2);
}

/* badge status lebih glowing */
.upcoming-item .badge {
    box-shadow: 0 0 0 4px rgba(99,102,241,.15);
}

</style>

<?php
include 'koneksi.php';

$qUpcoming = mysqli_query($koneksi, "
    SELECT 
        tanggal_ulangan,
        sekolah,
        mata_pelajaran,
        status_pekerjaan
    FROM jadwal_ulangan
    WHERE 
        tanggal_ulangan IS NOT NULL
        AND tanggal_ulangan >= CURDATE()
    ORDER BY tanggal_ulangan ASC
");


$fs = $_GET['sekolah'] ?? '';
$fk = $_GET['kelas'] ?? '';
$fm = $_GET['mapel'] ?? '';
$fstatus = $_GET['status'] ?? '';
$order = ($_GET['order'] ?? 'DESC') === 'ASC' ? 'ASC' : 'DESC';

$where = [];

if ($fs !== '') {
    $fs = mysqli_real_escape_string($koneksi, $fs);
    $where[] = "sekolah LIKE '%$fs%'";
}
if ($fk !== '') {
    $fk = mysqli_real_escape_string($koneksi, $fk);
    $where[] = "kelas LIKE '%$fk%'";
}
if ($fm !== '') {
    $fm = mysqli_real_escape_string($koneksi, $fm);
    $where[] = "mata_pelajaran LIKE '%$fm%'";
}
if ($fstatus !== '') {
    $fstatus = mysqli_real_escape_string($koneksi, $fstatus);
    $where[] = "status_pekerjaan = '$fstatus'";
}

/* ==============================
   RECENT SCHEDULE (5 TERDEKAT)
================================ */
$sqlRecent = "
    SELECT
        ju.id_jadwal,
        ju.tanggal_ulangan,
        ju.sekolah,
        ju.kelas,
        ju.mata_pelajaran,
        ju.status_pekerjaan,
        ju.user_id,
        u.username
    FROM jadwal_ulangan ju
    LEFT JOIN users u
        ON ju.user_id = u.user_id
    WHERE
        ju.tanggal_ulangan IS NOT NULL
        AND ju.tanggal_ulangan != '0000-00-00'
        AND YEAR(ju.tanggal_ulangan) >= 2000
";


if (!empty($where)) {
    $sqlRecent .= " AND " . implode(" AND ", $where);
}

$sqlRecent .= " ORDER BY tanggal_ulangan $order LIMIT 100";

$qRecent = mysqli_query($koneksi, $sqlRecent);


/* ==============================
   TASK STATUS COUNTER
================================ */
$qStatus = mysqli_query($koneksi, "
    SELECT
        COALESCE(SUM(status_pekerjaan = 'not_started'),0) AS not_started,
        COALESCE(SUM(status_pekerjaan = 'in_progress'),0) AS in_progress,
        COALESCE(SUM(status_pekerjaan = 'completed'),0) AS completed
    FROM jadwal_ulangan
");

$status = mysqli_fetch_assoc($qStatus);
?>

<!-- Tasks Status Start -->
<div class="container-fluid pt-4 px-4">
    <h6 class="mb-3">Tasks Status</h6>
    <div class="row g-4">

        <div class="col-md-4">
            <div class="task-card d-flex align-items-center gap-3 p-4">
                <i class="fa fa-times fa-3x text-danger"></i>
                <div>
                    <small class="text-muted">Not Started</small>
                    <h5><?= $status['not_started']; ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-card d-flex align-items-center gap-3 p-4">
                <i class="fa fa-spinner fa-3x text-warning"></i>
                <div>
                    <small class="text-muted">In Progress</small>
                    <h5><?= $status['in_progress']; ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-card d-flex align-items-center gap-3 p-4">
                <i class="fa fa-check fa-3x text-success"></i>
                <div>
                    <small class="text-muted">Completed</small>
                    <h5><?= $status['completed']; ?></h5>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Tasks Status End -->

<!-- Recent Schedule Start -->
<div class="container-fluid pt-4 px-4">

    <!-- CARD UTAMA -->
    <div class="section-card">

        <!-- HEADER -->
        <div class="d-flex align-items-center justify-content-between mb-3 filter-anchor">

            <h6 class="mb-0">Schedule Overview</h6>

            <div class="d-flex gap-2">

                <!-- FILTER -->
                <div class="dropdown position-relative">
                    <button class="btn btn-sm btn-outline-secondary"
                            data-bs-toggle="dropdown">
                        <i class="fas fa-filter"></i>
                    </button>

                    <div class="dropdown-menu filter-dropdown-bottom p-3">
                        <form id="filterRecentSchedule">

                            <label class="small">Sekolah</label>
                            <input type="text" name="sekolah" class="form-control mb-2">

                            <label class="small">Kelas</label>
                            <input type="text" name="kelas" class="form-control mb-2">

                            <label class="small">Mapel</label>
                            <input type="text" name="mapel" class="form-control mb-2">

                            <label class="small">Status</label>
                            <select name="status" class="form-control mb-2">
                                <option value="">Semua</option>
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>

                            <label class="small">Urutkan Tanggal</label>
                            <select name="order" class="form-control mb-3">
                                <option value="DESC">Terbaru</option>
                                <option value="ASC">Terlama</option>
                            </select>

                            <button class="btn btn-primary btn-sm w-100">
                                Terapkan
                            </button>

                            <button type="button"
                                    id="resetRecentSchedule"
                                    class="btn btn-outline-secondary btn-sm w-100 mt-2">
                                Reset
                            </button>
                        </form>
                    </div>
                </div>

                <a href="index.php?menu=schedule"
                   class="btn btn-sm btn-primary">
                    Show All
                </a>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>School</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Assigned to</th>
                        <th>Details</th>
                    </tr>
                </thead>

                <tbody id="recentScheduleBody">

                <?php if (mysqli_num_rows($qRecent) == 0): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada jadwal
                        </td>
                    </tr>
                <?php endif; ?>

                <?php while ($r = mysqli_fetch_assoc($qRecent)): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($r['tanggal_ulangan'])) ?></td>
                        <td><?= htmlspecialchars($r['sekolah']) ?></td>
                        <td><?= htmlspecialchars($r['kelas']) ?></td>
                        <td><?= htmlspecialchars($r['mata_pelajaran']) ?></td>
                        <td>
                            <?php
                            if ($r['status_pekerjaan'] === 'not_started') {
                                echo '<span class="badge bg-danger">Not Started</span>';
                            } elseif ($r['status_pekerjaan'] === 'in_progress') {
                                echo '<span class="badge bg-warning text-dark">In Progress</span>';
                            } else {
                                echo '<span class="badge bg-success">Completed</span>';
                            }
                            ?>
                        </td>
                       
                        <td>
                            <?php if (!empty($r['user_id'])): ?>
                                <?= htmlspecialchars($r['username']) ?>
                                <span class="text-muted small">
                                    (<?= htmlspecialchars($r['user_id']) ?>)
                                </span>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>


                        <td>
                        <button class="btn btn-sm btn-primary" onclick="openDetailFromDashboard(
                        <?= $r['id_jadwal'] ?>
                        )">
                        Detail
                        </button>

                        </td>

                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>
<!-- Recent Schedule End -->


<script>
document.getElementById('resetRecentSchedule')
?.addEventListener('click', function () {

    // 1️⃣ Reset semua input form
    document.getElementById('filterRecentSchedule').reset();

    // 2️⃣ Kirim POST kosong (balik ke default query PHP)
    fetch('filter_recent_schedule.php', {
        method: 'POST'
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('recentScheduleBody').innerHTML = html;
    });
});
</script>


<!-- DASHBOARD SHORTCUT -->
<div class="container-fluid px-4 shortcut-wrapper">
    <div class="row g-4 <?= ($_SESSION['role'] === 'admin') ? '' : 'row-cols-1 row-cols-md-2' ?>">

        <!-- FILES -->
        <div class="col">
            <div class="shortcut-card"
                 onclick="window.location.href='index.php?menu=files'">
                <div class="shortcut-icon">
                    <i class="fa fa-file-alt"></i>
                </div>
                <div class="shortcut-title">Files</div>
                <div class="shortcut-desc">
                    Kelola, upload, dan akses semua file pembelajaran.
                </div>
            </div>
        </div>

        <!-- HISTORY -->
        <div class="col">
            <div class="shortcut-card"
                 onclick="window.location.href='index.php?menu=history'">
                <div class="shortcut-icon">
                    <i class="fa fa-history"></i>
                </div>
                <div class="shortcut-title">History</div>
                <div class="shortcut-desc">
                    Lihat riwayat aktivitas dan jadwal yang sudah berjalan.
                </div>
            </div>
        </div>

        <!-- USER MANAGEMENT (ADMIN ONLY) -->
        <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="col">
            <div class="shortcut-card"
                 onclick="window.location.href='index.php?menu=user_management'">
                <div class="shortcut-icon">
                    <i class="fa fa-user-cog"></i>
                </div>
                <div class="shortcut-title">User Management</div>
                <div class="shortcut-desc">
                    Atur akun pengguna, role, dan hak akses sistem.
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>



<!-- Upcoming Schedule -->
<div class="container-fluid px-4">
    <div class="upcoming-card">

        <div class="d-flex align-items-center justify-content-between mb-3">

            <h6 class="mb-0 fw-semibold">Upcoming Schedule</h6>

            <div class="d-flex gap-2">
                <a href="index.php?menu=schedule"
                class="btn btn-sm btn-primary rounded-pill px-3">
                    Show All
                </a>
            </div>

        </div>


        <?php if (mysqli_num_rows($qUpcoming) == 0): ?>
            <p class="text-muted mb-0">Tidak ada jadwal terdekat.</p>
        <?php endif; ?>

        <?php while ($u = mysqli_fetch_assoc($qUpcoming)): ?>
            <div class="upcoming-item">
                <div class="upcoming-date">
                    <?= date('d', strtotime($u['tanggal_ulangan'])) ?>
                    <span><?= date('M', strtotime($u['tanggal_ulangan'])) ?></span>
                </div>

                <div class="upcoming-info flex-grow-1">
                    <h6><?= htmlspecialchars($u['mata_pelajaran']) ?></h6>
                    <small><?= htmlspecialchars($u['sekolah']) ?></small>
                </div>

                <?php
                if ($u['status_pekerjaan'] === 'completed') {
                    echo '<span class="badge bg-success">Completed</span>';
                } elseif ($u['status_pekerjaan'] === 'in_progress') {
                    echo '<span class="badge bg-warning text-dark">In Progress</span>';
                } else {
                    echo '<span class="badge bg-danger">Not Started</span>';
                }
                ?>
            </div>
        <?php endwhile; ?>

    </div>
</div>

            <!--Redirect detail button ke schedule -->
<div class="modal fade" id="cellModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <!-- HEADER -->
      <div class="modal-header border-0 pb-0">
        <div>
          <h5 class="modal-title fw-bold mb-1">
            Detail Jadwal Ulangan
          </h5>
          <small class="text-muted">
          </small>
        </div>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body pt-3">

        <!-- hidden identity -->
        <input type="hidden" id="cellSekolah">
        <input type="hidden" id="cellKelas">
        <input type="hidden" id="cellMapel">

        <!-- TANGGAL -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            Tanggal Ulangan
          </label>
          <input type="date"
                 id="cellTanggal"
                 class="form-control rounded-3">
        </div>

        <!-- STATUS -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            Status Pekerjaan
          </label>
          <select id="cellStatus"
                  class="form-select rounded-3">
            <option value="not_started">Not Started</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <!-- DETAIL -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            Detail Ulangan
          </label>
          <textarea id="cellDetail"
                    class="form-control rounded-3"
                    rows="3"
                    placeholder="Contoh: Bab 1–3, pilihan ganda"></textarea>
        </div>

        <!-- PIC -->
        <div class="mb-2">
          <label class="form-label fw-semibold">
            PIC
          </label>
          <input type="text"
                 id="cellPIC"
                 class="form-control rounded-3 bg-light"
                 disabled>
        </div>

        <!-- INFO -->
        <div class="alert alert-info small rounded-3 mt-3 mb-0">
          PIC otomatis diambil dari akun login kamu
        </div>

      </div>
    </div>
  </div>
</div>

      

<script>
function openDetailFromDashboard(idJadwal) {

  fetch('get_cell_detail.php?id_jadwal=' + idJadwal)
    .then(res => res.json())
    .then(data => {
      cellTanggal.value = data.tanggal_ulangan || '';
      cellStatus.value  = data.status_pekerjaan || '';
      cellDetail.value  = data.detail_ulangan || '';
      cellPIC.value     = data.pic || '-';
    });

  new bootstrap.Modal(
    document.getElementById('cellModal')
  ).show();
}
</script>