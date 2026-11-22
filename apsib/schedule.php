<style>
/* ===============================
   CARD SEKOLAH
================================ */
.schedule-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 26px;
    margin-bottom: 32px;
    box-shadow: 0 24px 60px rgba(79,70,229,.12);
    transition: .3s ease;
}

.schedule-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 34px 80px rgba(79,70,229,.2);
}

/* ===============================
   HEADER
================================ */
.schedule-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 16px;
    margin-bottom: 18px;
    border-bottom: 1px solid #eef2ff;
}

.school-name {
    font-size: 22px;
    font-weight: 800;
    color: #111827;
}

.school-meta {
    font-size: 13px;
    color: #6b7280;
}

/* ===============================
   TOGGLE BUTTON
================================ */
.btn-toggle {
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 14px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 12px 28px rgba(79,70,229,.4);
    transition: .25s ease;
}

.btn-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(79,70,229,.55);
}

.btn-upload {
  border: 1px dashed #6c757d;
  background: #f8f9fa;
  color: #495057;
  font-size: 13px;
  padding: 6px 12px;
}

.btn-upload:hover {
  background: #e9ecef;
  border-style: solid;
  color: #212529;
}

/* ===============================
   ACTION BUTTONS
================================ */
.schedule-actions {
    display: flex;
    gap: 8px;
}

.btn-action {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 16px rgba(0,0,0,.15);
    transition: .2s ease;
}

.btn-action:hover {
    transform: scale(1.12);
}

/* edit */
.btn-edit {
    color: #4f46e5;
}
.btn-edit:hover {
    background: #eef2ff;
}

/* delete */
.btn-delete {
    color: #ef4444;
}
.btn-delete:hover {
    background: #fee2e2;
}

/* ===============================
   TABLE CONTAINER (SMOOTH OPEN)
================================ */
.schedule-table {
    display: none;
    margin-top: 18px;
    animation: fadeIn .35s ease;
}

@keyframes fadeIn {
    from {opacity:0; transform:translateY(10px);}
    to   {opacity:1; transform:none;}
}

/* ===============================
   TABLE STYLE
================================ */
.table {
    border-collapse: separate;
    border-spacing: 0 10px;
}

.table thead th {
    background: #eef2ff;
    font-size: 13px;
    font-weight: 700;
    color: #4f46e5;
    border: none;
    border-radius: 10px;
}

/* row */
.table tbody tr {
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 26px rgba(0,0,0,.06);
}

/* cell */
.table tbody td {
    border: none;
    padding: 14px;
}

/* ===============================
   MAPEL HEADER
================================ */
.mapel-header {
    cursor: pointer;
    transition: .2s ease;
     text-align: center;  
    vertical-align: middle;
}

.mapel-header:hover {
    background: #e0e7ff;
}

/* ===============================
   SCHEDULE CELL
================================ */
.schedule-cell {
    border-radius: 14px;
    padding: 16px;
    text-align: center;
    cursor: pointer;
    font-weight: 600;
    transition: .25s ease;
}

/* hover effect */
.schedule-cell:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 26px rgba(0,0,0,.15);
}

/* kosong */
.schedule-empty {
    color: #9ca3af;
    font-style: italic;
}

/* RESET / EMPTY STATE (PRIORITAS TERTINGGI) */
.schedule-cell:not([data-status]),
.schedule-cell[data-status=""] {
    background: #ffffff !important;
    border: 1px dashed #e5e7eb;
}

/* ===============================
   STATUS COLORS (LEBIH SOFT)
================================ */

/* NOT STARTED */
.schedule-cell[data-status="not_started"] {
    background: linear-gradient(135deg,#fee2e2,#fecaca);
    border: 1px solid #ef4444;
}

/* IN PROGRESS */
.schedule-cell[data-status="in_progress"] {
    background: linear-gradient(135deg,#ffedd5,#fed7aa);
    border: 1px solid #f97316;
}

/* COMPLETED */
.schedule-cell[data-status="completed"] {
    background: linear-gradient(135deg,#dcfce7,#bbf7d0);
    border: 1px solid #22c55e;
}


/* glow pas hover completed */
.schedule-cell[data-status="completed"]:hover {
    box-shadow: 0 0 22px rgba(34,197,94,.45);
}

/* default kosong */
.schedule-cell.empty {
    background: #f3f4f6;
    color: #9ca3af;
}

/* ===============================
   FLOATING ADD BUTTON
================================ */
.upload-floating {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 56px;
    height: 56px;
    border-radius: 16px;
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 12px 30px rgba(79,70,229,.45);
    z-index: 2000;
}

/* ===============================
   MODAL
================================ */
.modal-body {
    max-height: 65vh;
    overflow-y: auto;
}

/* ===============================
   DIVIDER
================================ */
.divider {
    border-top: 1px solid #e5e7eb;
    margin: 18px 0;
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

</style>


<?php

include 'koneksi.php';
include 'log_helper.php';



/*
Ambil semua data jadwal
*/
$query = "
   SELECT
    j.id_jadwal,
    j.sekolah,
    j.kelas,
    j.mata_pelajaran,
    j.tanggal_ulangan,
    j.status_pekerjaan,
    j.detail_ulangan,
    j.user_id,
    u.username,
    (
      SELECT COUNT(*) 
      FROM file_soal f 
      WHERE f.id_jadwal = j.id_jadwal
    ) AS total_file
FROM jadwal_ulangan j
LEFT JOIN users u ON u.user_id = j.user_id
ORDER BY j.sekolah, j.kelas

";

$result = mysqli_query($koneksi, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
  
    $sekolah = $row['sekolah'];
    $kelas   = $row['kelas'];
    $mapel   = $row['mata_pelajaran'];

    $data[$sekolah]['kelas'][$kelas]['id'][$mapel] = $row['id_jadwal'];
    $data[$sekolah]['kelas'][$kelas]['mapel'][$mapel]  = $row['tanggal_ulangan'];
    $data[$sekolah]['kelas'][$kelas]['status'][$mapel] = $row['status_pekerjaan'];
    $data[$sekolah]['kelas'][$kelas]['detail'][$mapel] = $row['detail_ulangan'];
    $data[$sekolah]['kelas'][$kelas]['pic'][$mapel] = $row['username'] ? $row['username'] . ' (' . $row['user_id'] . ')' : $row['user_id'];


    $data[$sekolah]['kelas'][$kelas]['has_file'][$mapel] = $row['total_file'] > 0;

}

?>


<?php foreach ($data as $sekolah => $info): ?>

<?php
$kelasData = $info['kelas'];
$mapelList = [];

// kumpulkan semua mapel
foreach ($kelasData as $kelasDetail) {
    foreach ($kelasDetail['mapel'] as $mapel => $tgl) {
        $mapelList[$mapel] = true; // pakai key biar unik
    }
}

// ubah ke array biasa
$mapelList = array_keys($mapelList);

// urutkan natural: Mapel 1, Mapel 2, Mapel 10
sort($mapelList, SORT_NATURAL);


?>

<div class="schedule-card">
    <div class="schedule-header">
        <div>
            <h3 class="school-name"><?= htmlspecialchars($sekolah) ?></h3>
            <span class="school-meta">
                <?= count($kelasData) ?> Grade • <?= count($mapelList) ?> Mata Pelajaran
            </span>
        </div>

        <div style="display:flex; gap:10px;">
<?php if ($_SESSION['role'] === 'admin'): ?>
<div class="schedule-actions">

    <!-- ✏️ RENAME SEKOLAH (ADMIN) -->
    <button class="btn-action btn-edit"
        onclick="openEditSekolah(
            '<?= htmlspecialchars($sekolah) ?>',
            <?= count($kelasData) ?>,
            <?= count($mapelList) ?>
        )">
        <i class="fas fa-pen"></i>
    </button>

    <!-- 🗑 DELETE JADWAL (ADMIN) -->
     <a href="schedule_delete.php?sekolah=<?= urlencode($sekolah) ?>"
       class="btn-action btn-delete"
       onclick="return confirm('Hapus semua jadwal dari sekolah ini?')">
        <i class="fas fa-trash"></i>
    </a>

</div>
<?php endif; ?>


            <button class="btn-toggle">Lihat Jadwal</button>
        </div>
    </div>

    <div class="schedule-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Grade</th>
                    <?php foreach ($mapelList as $mapel): ?>
                      <th class="mapel-header"
                          data-sekolah="<?= htmlspecialchars($sekolah) ?>"
                          data-mapel="<?= htmlspecialchars($mapel) ?>"
                          <?php if ($_SESSION['role'] === 'admin'): ?>
                              ondblclick="editMapel(this)"
                              title="Double klik untuk edit"
                          <?php else: ?>
                              title="Hanya admin yang dapat mengedit"
                          <?php endif; ?>
                      >
                          <?= htmlspecialchars($mapel) ?>
                      </th>

                    <?php endforeach; ?>
                </tr>
            </thead>
          <tbody>
            <?php foreach ($kelasData as $namaKelas => $detail): ?>
            <tr>
                <td><?= htmlspecialchars($namaKelas) ?></td>

                <?php foreach ($mapelList as $mapel): ?>
            <td class="schedule-cell"
            data-has-file="<?= !empty($detail['has_file'][$mapel]) ? '1' : '0' ?>"
            data-id="<?= $detail['id'][$mapel] ?? '' ?>"
            data-sekolah="<?= htmlspecialchars($sekolah) ?>"
            data-kelas="<?= htmlspecialchars($namaKelas) ?>"
            data-mapel="<?= htmlspecialchars($mapel) ?>"
            data-tanggal="<?= $detail['mapel'][$mapel] ?? '' ?>"
            data-status="<?= $detail['status'][$mapel] ?? '' ?>"
            data-detail="<?= htmlspecialchars($detail['detail'][$mapel] ?? '') ?>"
            data-pic="<?= htmlspecialchars($detail['pic'][$mapel] ?? '') ?>"
            onclick="openCellModal(this)">

               
                <?php if (!empty($detail['mapel'][$mapel])): ?>
                <?= date('d-m-Y', strtotime($detail['mapel'][$mapel])) ?>
                <?php else: ?>
                <span class="schedule-empty">—</span>
                <?php endif; ?>


                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<?php endforeach; ?>


<script>
document.querySelectorAll('.btn-toggle').forEach(btn => {
    btn.onclick = () => {
        const table = btn.closest('.schedule-card').querySelector('.schedule-table');
        const open = table.style.display === 'block';
        table.style.display = open ? 'none' : 'block';
        btn.textContent = open ? 'Lihat Jadwal' : 'Tutup Jadwal';
    };
});
</script>

<?php if ($_SESSION['role'] === 'admin'): ?>
<button class="btn btn-primary upload-floating"
        data-bs-toggle="modal"
        data-bs-target="#createScheduleModal"
        title="Buat Jadwal Baru">
    <i class="fa fa-plus"></i>
</button>
<?php endif; ?>


<div class="modal fade" id="createScheduleModal">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" id="scheduleForm">

      <div class="modal-header">
        <h5 class="modal-title">Buat Jadwal Ulangan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <!-- Nama Sekolah -->
        <div class="mb-3">
          <label class="form-label">Nama Sekolah</label>
          <input type="text" id="namaSekolah" class="form-control" required>
        </div>

        <!-- Jumlah -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Kelas</label>
            <input type="number" id="jumlahKelas" class="form-control" min="1" value="3">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Mapel</label>
            <input type="number" id="jumlahMapel" class="form-control" min="1" value="3">
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

    <button type="button" class="btn btn-primary" onclick="submitSchedule()">
    Simpan Jadwal
    </button>

      </div>

    </form>
  </div>
</div>

<div class="modal fade" id="uploadFileModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content"
      id="uploadFileForm"
      method="POST"
      action="index.php?menu=files"
      enctype="multipart/form-data">
      


      <div class="modal-header">
        <h5 class="modal-title">Upload File</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <!-- WAJIB: ID JADWAL -->
        <input type="hidden" name="id_jadwal" id="uploadIdJadwal">

        <div class="mb-3">
          <input type="text"
                 name="judul"
                 class="form-control"
                 placeholder="Judul File"
                 required>
        </div>

        <div class="mb-3">
          <textarea name="deskripsi"
                    class="form-control"
                    placeholder="Deskripsi"
                    rows="3"></textarea>
        </div>

        <div class="mb-3">
          <input type="file"
                 name="file"
                 class="form-control"
                 required>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit"
        name="upload"
        class="btn btn-primary">
  Upload
</button>

      </div>

    </form>
  </div>
</div>

<script>
function openUploadModal() {


  if (activeCell.dataset.hasFile === '1') {
  alert(
    'File soal untuk jadwal ini sudah ada.\n\n' +
    'Untuk mengganti file, silakan ke menu Files lalu gunakan tombol Edit.'
  );
  return;
}

  if (!cellTanggal.value || !cellStatus.value || !cellDetail.value.trim()) {
  alert(
    'Lengkapi dan simpan detail jadwal ulangan terlebih dahulu.\n' +
    '(Tanggal, Status, dan Detail Ulangan wajib diisi)'
  );
  return;
}

  if (!cellId.value) {
    alert('ID jadwal tidak ditemukan');
    return;
  }

  // set id jadwal ke form upload
  document.getElementById('uploadIdJadwal').value = cellId.value;

  // TUTUP modal detail dulu
  const cellModalEl = document.getElementById('cellModal');
  const cellModal   = bootstrap.Modal.getInstance(cellModalEl);
  if (cellModal) cellModal.hide();

  // BUKA modal upload SETELAH modal detail tertutup
  cellModalEl.addEventListener('hidden.bs.modal', function handler() {
    cellModalEl.removeEventListener('hidden.bs.modal', handler);

    new bootstrap.Modal(
      document.getElementById('uploadFileModal')
    ).show();
  });
}

</script>

<script>

function submitSchedule() {
  const sekolah = document.getElementById('namaSekolah').value.trim();
  const kelas   = parseInt(document.getElementById('jumlahKelas').value);
  const mapel   = parseInt(document.getElementById('jumlahMapel').value);

  if (!sekolah || kelas < 1 || mapel < 1) {
    alert('Lengkapi data dulu');
    return;
  }

  const formData = new FormData();
  formData.append('action', 'create_schedule');
  formData.append('sekolah', sekolah);
  formData.append('jumlah_kelas', kelas);
  formData.append('jumlah_mapel', mapel);

  fetch('schedule_action.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(res => {
    if (res.success) {
      location.reload(); // refresh → tabel baru muncul
    } else {
      alert(res.message || 'Gagal menyimpan jadwal');
    }
  })
  .catch(err => {
    console.error(err);
    alert('Error server');
  });
}
</script>

<script>
let activeCell = null;
let originalCellData = null;
let isSaving = false;
let isResetting = false;

function editCell(td) {
    if (td.querySelector('input')) return;

    const oldValue = td.innerText.trim() === '-' ? '' : td.innerText.trim();

    const input = document.createElement('input');
    input.type = 'date';
    input.value = oldValue;
    input.style.width = '100%';

    td.innerHTML = '';
    td.appendChild(input);
    input.focus();

    input.onblur = () => saveCell(td, input.value);
    input.onkeydown = e => {
        if (e.key === 'Enter') input.blur();
    };
}

function saveCell(td, value) {
    const sekolah = td.dataset.sekolah;
    const kelas   = td.dataset.kelas;
    const mapel   = td.dataset.mapel;
  
    fetch('schedule_update_cell.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            sekolah,
            kelas,
            mapel,
            tanggal: value
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            td.innerText = value ? value : '-';
        } else {
            alert(res.message);
            td.innerText = '-';
        }
    });
}

</script>

<div class="modal fade" id="cellModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Jadwal Ulangan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="cellSekolah">
        <input type="hidden" id="cellKelas">
        <input type="hidden" id="cellMapel">
        <input type="hidden" id="cellId">

        <div class="mb-3">
          <label class="form-label">Tanggal Ulangan</label>
          <input type="date" id="cellTanggal" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Status Pekerjaan</label>
              <select id="cellStatus" class="form-select" required>
                <option value="" disabled selected>-- Pilih Status --</option>
                <option value="not_started">Not Started</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
              </select>

        </div>

        <div class="mb-3">
          <label class="form-label">Detail Ulangan</label>
          <textarea id="cellDetail" class="form-control" rows="3"
            placeholder="Contoh: Bab 1–3, pilihan ganda"></textarea>
        </div>

         <div class="mb-2">
            <label class="form-label">PIC</label>
            <input type="text" id="cellPIC" class="form-control" disabled>
            </div>

        <div class="alert alert-info small">
          PIC otomatis diambil dari akun login kamu
        </div>
      </div>


<div class="modal-footer d-flex justify-content-between align-items-center">

  <!-- LEFT: upload -->
  <button type="button"
        class="btn btn-upload"
        id="btnUploadSoal"
        disabled
        onclick="openUploadModal()">
  <i class="fa fa-paperclip me-1"></i>
  Upload File Soal
</button>


  <!-- RIGHT: action buttons -->
  <div class="d-flex gap-2">
    <button class="btn btn-outline-danger btn-sm"
            onclick="resetCellModal()">
      Reset
    </button>

    <button class="btn btn-secondary btn-sm"
            data-bs-dismiss="modal">
      Batal
    </button>

    <button class="btn btn-primary btn-sm"
            onclick="saveCellModal()">
      Simpan
    </button>
  </div>

</div>



    </div>
  </div>
</div>


<script>
const cellId = document.getElementById('cellId');

function openCellModal(td) {
  const hasFile = td.dataset.hasFile === '1';

const uploadBtn = document.getElementById('btnUploadSoal');

if (hasFile) {
  uploadBtn.disabled = true;
  uploadBtn.title = 'File soal sudah ada. Edit melalui halaman Files.';
} else {
  validateUploadAvailability();
}

  activeCell = td;

  cellId.value = td.dataset.id; 

  isSaving = false;

  // SIMPAN DATA ASLI
  originalCellData = {
    tanggal: td.dataset.tanggal || '',
    status: td.dataset.status || '',
    detail: td.dataset.detail || '',
    pic: td.dataset.pic || ''
  };

  cellSekolah.value = td.dataset.sekolah;
  cellKelas.value   = td.dataset.kelas;
  cellMapel.value   = td.dataset.mapel;

  cellTanggal.value = originalCellData.tanggal;
  cellStatus.value  = originalCellData.status;
  cellDetail.value  = originalCellData.detail;
  cellPIC.value     = originalCellData.pic || '-';

  new bootstrap.Modal(document.getElementById('cellModal')).show();
  validateUploadAvailability();

[cellTanggal, cellStatus, cellDetail].forEach(el => {
  el.addEventListener('input', validateUploadAvailability);
});

}

function validateUploadAvailability() {
  if (activeCell && activeCell.dataset.hasFile === '1') {
    document.getElementById('btnUploadSoal').disabled = true;
    return;
  }

  const isValid =
    cellTanggal.value &&
    cellStatus.value &&
    cellDetail.value.trim() !== '';

  document.getElementById('btnUploadSoal').disabled = !isValid;
}


</script>

<script>
function saveCellModal() {
  const tanggal = cellTanggal.value;
  const status = cellStatus.value;

  if (!tanggal || !status) {
    alert('Tanggal dan status wajib diisi');
    return;
  }

  if (!activeCell) {
    alert('Jadwal yang akan disimpan tidak ditemukan. Tutup modal lalu buka kembali jadwalnya.');
    return;
  }

  // Status selesai hanya boleh digunakan setelah file soal tersedia.
  if (status === 'completed' && activeCell.dataset.hasFile !== '1') {
    alert('Status "Selesai" hanya dapat dipilih setelah file soal diunggah. Silakan upload file soal terlebih dahulu.');
    cellStatus.value = 'in_progress';
    validateUploadAvailability();
    return;
  }

  if (isSaving) return;

  const modalEl = document.getElementById('cellModal');
  const saveButton = modalEl.querySelector('button[onclick="saveCellModal()"]');
  const username = <?= json_encode(
    ($_SESSION['username'] ?? '') . ' (' . ($_SESSION['user_id'] ?? '') . ')',
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
  ) ?>;

  isSaving = true;
  if (saveButton) {
    saveButton.disabled = true;
    saveButton.textContent = 'Menyimpan...';
  }

  fetch('schedule_update_cell.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: new URLSearchParams({
      sekolah: cellSekolah.value,
      kelas: cellKelas.value,
      mapel: cellMapel.value,
      id_jadwal: cellId.value,
      tanggal: tanggal,
      status: status,
      detail: cellDetail.value
    })
  })
  .then(async response => {
    if (response.redirected) {
      throw new Error('Sesi login tidak berlaku. Muat ulang halaman dan masuk kembali sebelum menyimpan.');
    }

    const raw = await response.text();
    let result;

    try {
      result = JSON.parse(raw);
    } catch (error) {
      console.error('Respons penyimpanan bukan JSON:', response.status, raw);
      throw new Error('Server mengirim respons yang tidak dapat dibaca (HTTP ' + response.status + '). Periksa sesi login atau log server.');
    }

    if (!response.ok && result.success !== false) {
      throw new Error('Server gagal memproses penyimpanan (HTTP ' + response.status + ').');
    }

    return result;
  })
  .then(result => {
    if (!result.success) {
      throw new Error(result.message || 'Data jadwal gagal disimpan.');
    }

    activeCell.dataset.id = result.id_jadwal || cellId.value;
    cellId.value = activeCell.dataset.id;
    activeCell.dataset.tanggal = tanggal;
    activeCell.dataset.status = status;
    activeCell.dataset.detail = cellDetail.value;
    activeCell.dataset.pic = username;

    activeCell.innerHTML = tanggal.split('-').reverse().join('-');
    cellPIC.value = username;

    // Bootstrap yang dipakai proyek adalah 5.0.0; gunakan getInstance()
    // karena getOrCreateInstance() belum tersedia pada versi tersebut.
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) {
      modalInstance.hide();
    } else {
      new bootstrap.Modal(modalEl).hide();
    }
  })
  .catch(error => {
    console.error('Gagal menyimpan detail jadwal:', error);
    isSaving = false;
    alert('Gagal menyimpan detail jadwal. ' + (error.message || 'Periksa koneksi dan coba lagi.'));
  })
  .finally(() => {
    if (saveButton) {
      saveButton.disabled = false;
      saveButton.textContent = 'Simpan';
    }
  });
}

</script>


</script>

<div class="modal fade" id="editMapelModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Nama Mapel</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="oldMapel">
        <input type="hidden" id="mapelSekolah">

        <label class="form-label">Nama Mapel Baru</label>
        <input type="text" id="newMapel" class="form-control">
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" onclick="saveMapel()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
function editMapel(th) {
    document.getElementById('oldMapel').value = th.dataset.mapel;
    document.getElementById('mapelSekolah').value = th.dataset.sekolah;
    document.getElementById('newMapel').value = th.innerText.trim();

    const modal = new bootstrap.Modal(document.getElementById('editMapelModal'));
    modal.show();
}

function saveMapel() {
    const sekolah = document.getElementById('mapelSekolah').value;
    const oldMapel = document.getElementById('oldMapel').value;
    const newMapel = document.getElementById('newMapel').value;

    fetch('schedule_update_mapel.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            sekolah,
            old_mapel: oldMapel,
            new_mapel: newMapel
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            location.reload(); // refresh biar header & isi ikut berubah
        } else {
            alert(res.message);
        }
    });
}
</script>

<div class="modal fade" id="editSekolahModal">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="schedule_process.php" class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit Jadwal Sekolah</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="old_sekolah" id="editSekolahLama">

        <div class="mb-3">
          <label class="form-label">Nama Sekolah</label>
          <input type="text"   name="new_sekolah" id="editNamaSekolah"
                 class="form-control" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Kelas</label>
            <input type="number" name="jumlah_kelas" id="editJumlahKelas"
                   class="form-control" min="1">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Mapel</label>
            <input type="number" name="jumlah_mapel" id="editJumlahMapel"
                   class="form-control" min="1">
          </div>
        </div>

      <div class="mt-3">
      <label class="form-label fw-bold">Pilih Mapel yang Mau Dihapus</label>

      <div id="hapusMapelList"
          class="border rounded p-2"
          style="max-height:150px;overflow:auto">
          <!-- diisi via JS -->
      </div>

      <small class="text-muted">
        Centang mapel yang ingin dihapus jika jumlah mapel dikurangi
      </small>
    </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan Perubahan</button>
      </div>
    <input type="hidden" name="action" value="edit_schedule">

    </form>
  </div>
</div>

<?php if (isset($_GET['error']) && $_GET['error'] === 'mapel_not_reduced'): ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  alert(
  'Jumlah mapel masih sama atau bertambah.\n\n' +
  'Pemilihan mapel hanya diperlukan jika jumlah mapel dikurangi.'
);
});
</script>
<?php endif; ?>

<script>
const LOGGED_USER_NAME = "<?= $_SESSION['username']; ?>";
const LOGGED_USER_ID   = "<?= $_SESSION['user_id']; ?>";
</script>


<script>
function openEditSekolah(sekolah, kelas, mapel) {
  editSekolahLama.value  = sekolah;
  editNamaSekolah.value = sekolah;
  editJumlahKelas.value = kelas;
  editJumlahMapel.value = mapel;
  

  // kosongkan list dulu
  const box = document.getElementById('hapusMapelList');
  box.innerHTML = '<em class="text-muted">Loading...</em>';

  // ambil mapel sesuai sekolah
  fetch('get_mapel.php?sekolah=' + encodeURIComponent(sekolah))
    .then(res => res.json())
    .then(data => {
      box.innerHTML = '';

      if (data.length === 0) {
        box.innerHTML = '<em class="text-muted">Tidak ada mapel</em>';
        return;
      }

      data.forEach(mapel => {
        const div = document.createElement('div');
        div.className = 'form-check';

        div.innerHTML = `
          <input class="form-check-input"
                 type="checkbox"
                 name="hapus_mapel[]"
                 value="${mapel}">
          <label class="form-check-label">${mapel}</label>
        `;

        box.appendChild(div);
      });
    });

  new bootstrap.Modal(
    document.getElementById('editSekolahModal')
  ).show();
}
</script>

<script>
document.querySelector('#editSekolahModal form').addEventListener('submit', function(e) {
  const currMapel = parseInt(editJumlahMapel.dataset.current);
  const newMapel  = parseInt(editJumlahMapel.value);

  const checked = document.querySelectorAll(
    '#hapusMapelList input[type=checkbox]:checked'
  ).length;

  // ❌ jumlah mapel tidak dikurangi tapi ada yang dicentang
  if (newMapel >= currMapel && checked > 0) {
    e.preventDefault();
    alert(
      'Jumlah mata pelajaran tidak dikurangi.\n' +
      'Tidak perlu mencentang mapel untuk dihapus.'
    );
    return;
  }

  // ❌ jumlah mapel dikurangi tapi centang tidak sesuai
  if (newMapel < currMapel) {
    const needDelete = currMapel - newMapel;

    if (checked !== needDelete) {
      e.preventDefault();
      alert(
        `Jumlah mapel dikurangi ${needDelete}.\n` +
        `Silakan centang tepat ${needDelete} mapel yang ingin dihapus.`
      );
      return;
    }
  }
});
</script>

<script>
function resetCellModal() {
  isResetting = true; // 🔥 tandai ini aksi final

  fetch('schedule_update_cell.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: new URLSearchParams({
      sekolah : cellSekolah.value,
      kelas   : cellKelas.value,
      mapel   : cellMapel.value,
      reset   : 1
    })
  })
  .then(r => r.json())
  .then(r => {
    if (!r.success) {
      alert(r.message);
      isResetting = false;
      return;
    }

    if (activeCell) {
      activeCell.innerHTML = '<span class="schedule-empty">—</span>';
      activeCell.dataset.tanggal = '';
      activeCell.dataset.status  = '';
      activeCell.dataset.detail  = '';
      activeCell.dataset.pic     = '';
    }

    cellTanggal.value = '';
    cellStatus.value  = '';
    cellDetail.value  = '';
    cellPIC.value     = '-';

    bootstrap.Modal.getInstance(
      document.getElementById('cellModal')
    ).hide();
  })
  .catch(() => {
    isResetting = false;
    alert('Fetch error');
  });
}

</script>

<script>
document
  .getElementById('cellModal')
  .addEventListener('hidden.bs.modal', function () {

    if (!activeCell) return;

    // ❌ rollback hanya jika BATAL, bukan SAVE & bukan RESET
    if (!isSaving && !isResetting && originalCellData) {

      activeCell.dataset.tanggal = originalCellData.tanggal;
      activeCell.dataset.status  = originalCellData.status;
      activeCell.dataset.detail  = originalCellData.detail;
      activeCell.dataset.pic     = originalCellData.pic;

      if (originalCellData.tanggal) {
        activeCell.innerHTML =
          originalCellData.tanggal.split('-').reverse().join('-');
      } else {
        activeCell.innerHTML = '<span class="schedule-empty">—</span>';
      }
    }

    activeCell = null;
    originalCellData = null;
    isSaving = false;
    isResetting = false;
});

</script>

