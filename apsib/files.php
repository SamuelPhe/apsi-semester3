<style>
/* ===============================
   FILE GRID
================================ */
.file-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
}

/* ===============================
   FILE CARD
================================ */
.file-card {
    position: relative;
    background: linear-gradient(180deg,#ffffff,#f8fafc);
    border-radius: 22px;
    padding: 22px;
    box-shadow: 0 18px 45px rgba(0,0,0,.12);
    transition: all .3s ease;
    overflow: hidden;
}

/* hover naik + glow */
.file-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 30px 70px rgba(79,70,229,.25);
}

/* garis aksen kiri */
.file-card::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: linear-gradient(180deg,#6366f1,#4f46e5);
    opacity: .9;
}

/* ===============================
   FILE TYPE BADGE
================================ */
.file-type {
    font-size: 12px;
    font-weight: 700;
    color: #4f46e5;
    background: linear-gradient(135deg,#eef2ff,#e0e7ff);
    padding: 6px 14px;
    border-radius: 999px;
    display: inline-block;
    margin-bottom: 12px;
    box-shadow: 0 6px 14px rgba(79,70,229,.25);
}

/* ===============================
   TITLE
================================ */
.file-title {
    font-size: 18px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 6px;
}

/* ===============================
   META INFO (NAMA & TANGGAL)
================================ */
.file-card small {
    color: #6b7280;
    font-size: 13px;
}

/* ===============================
   ACTION BUTTONS (EDIT / DELETE)
================================ */
.file-actions {
    position: absolute;
    top: 14px;
    right: 14px;
    display: flex;
    gap: 6px;
    opacity: .9;
}

.file-card:hover .file-actions {
    opacity: 1;
}

.btn-edit,
.btn-delete {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    background: #ffffff;
    text-decoration: none;
    box-shadow: 0 6px 16px rgba(0,0,0,.18);
    border: none;
    cursor: pointer;
    transition: .25s ease;
}

/* edit */
.btn-edit {
    color: #4f46e5;
}
.btn-edit:hover {
    background: #eef2ff;
    transform: scale(1.15);
}

/* delete */
.btn-delete {
    color: #ef4444;
}
.btn-delete:hover {
    background: #fee2e2;
    transform: scale(1.15);
}

/* ===============================
   OPEN BUTTON
================================ */
.btn-file {
    display: inline-block;
    padding: 10px 18px;
    background: linear-gradient(135deg,#6366f1,#4f46e5);
    color: #ffffff;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 14px;
    box-shadow: 0 12px 28px rgba(79,70,229,.45);
    transition: .25s ease;
}

.btn-file:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(79,70,229,.6);
}

/* ===============================
   FLOATING UPLOAD BUTTON
================================ */
.upload-floating {
    position: fixed;
    bottom: 24px;
    right: 24px;
    width: 58px;
    height: 58px;
    border-radius: 18px;
    font-size: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 14px 34px rgba(79,70,229,.55);
    z-index: 1050;
    transition: .25s ease;
}

.upload-floating:hover {
    transform: scale(1.12) rotate(6deg);
}

/* ===============================
   TOP NAVBAR – UNGU MODERN
================================ */
.content .navbar,
.navbar {
    background: linear-gradient(90deg,#4f46e5,#6d5dfc) !important;
    border-radius: 18px;
    margin-bottom: 26px;
    box-shadow: 0 14px 36px rgba(79,70,229,.4);
}

/* search */
.navbar input,
.navbar .form-control {
    border-radius: 14px;
    background: rgba(255,255,255,.96);
    border: none;
}

/* hamburger */
.navbar .btn,
.navbar-toggler {
    background: rgba(255,255,255,.18);
    border-radius: 14px;
    color: #ffffff;
}

/* text */
.navbar .nav-link,
.navbar span,
.navbar small {
    color: #ffffff !important;
}

/* avatar */
.navbar img {
    border: 2px solid rgba(255,255,255,.6);
}

.file-new {
  outline: 3px solid #22c55e;
  box-shadow: 0 0 0 6px rgba(34,197,94,.15);
  animation: pulse 1.2s ease-out;
}

@keyframes pulse {
  from { transform: scale(1.02); }
  to   { transform: scale(1); }
}


</style>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';
$jadwalValid = mysqli_query($koneksi, "
  SELECT j.id_jadwal, j.sekolah, j.kelas, j.mata_pelajaran, j.tanggal_ulangan
  FROM jadwal_ulangan j
  WHERE
    j.tanggal_ulangan IS NOT NULL
    AND j.status_pekerjaan IS NOT NULL
    AND j.detail_ulangan IS NOT NULL
    AND j.id_jadwal NOT IN (
      SELECT id_jadwal FROM file_soal
    )
  ORDER BY j.sekolah, j.kelas
");

include 'log_helper.php';

/* ================= DELETE FILE ================= */
if (isset($_POST['delete_id'])) {

    // ⛔ BLOK GURU
    if ($_SESSION['role'] !== 'admin') {
        die('Akses ditolak');
    }

    $id = $_POST['delete_id'];

    $old = mysqli_fetch_assoc(
        mysqli_query($koneksi, "SELECT nama_file FROM file_soal WHERE id_soal='$id'")
    );

    $q = mysqli_query($koneksi, "SELECT path_file FROM file_soal WHERE id_soal='$id'");
    if ($row = mysqli_fetch_assoc($q)) {
        $path = __DIR__ . "/uploads/" . $row['path_file'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    mysqli_query($koneksi, "DELETE FROM file_soal WHERE id_soal='$id'");

    if ($old) {
        log_perubahan(
            $koneksi,
            'Files',
            'DELETE',
            "Menghapus file: {$old['nama_file']}"
        );
    }

    echo "<script>window.location.href='index.php?menu=files&uploaded=$id';</script>";
    exit;
}


/* ================= UPLOAD FILE ================= */
if (isset($_POST['upload'])) {
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $user_id    = $_SESSION['user_id'];
    $id_jadwal = $_POST['id_jadwal'] ?? null;
    $fromSchedule = isset($_POST['from_schedule']);

    if (!$id_jadwal) {
        die('Jadwal wajib dipilih.');
    }


    $cekFile = mysqli_query($koneksi, "
  SELECT COUNT(*) AS total
  FROM file_soal
  WHERE id_jadwal = '$id_jadwal'
");

$rowFile = mysqli_fetch_assoc($cekFile);

if ($rowFile['total'] > 0) {
    die(
      'Upload ditolak: Jadwal ini sudah memiliki file soal. ' .
      'Silakan edit file melalui menu Files.'
    );
}


    if (!$id_jadwal) {
    die('Jadwal tidak valid.');
}

$cek = mysqli_query($koneksi, "
    SELECT tanggal_ulangan, status_pekerjaan, detail_ulangan
    FROM jadwal_ulangan
    WHERE id_jadwal = '$id_jadwal'
");

$data = mysqli_fetch_assoc($cek);

if (
    empty($data['tanggal_ulangan']) ||
    empty($data['status_pekerjaan']) ||
    empty(trim($data['detail_ulangan']))
) {
    die('Upload ditolak: detail jadwal ulangan belum lengkap.');
}

    $file = $_FILES['file'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $namaFile = time() . "_" . $file['name'];

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    move_uploaded_file($file['tmp_name'], "uploads/" . $namaFile);

    $id = rand(100000, 999999);

    mysqli_query($koneksi, "
        INSERT INTO file_soal
        (id_soal, id_jadwal, nama_file, deskripsi, path_file, tipe_file, user_id, waktu_unggah)
        VALUES
        ('$id', '$id_jadwal', '$judul', '$deskripsi', '$namaFile', '$ext', '$user_id', NOW())
    ");

    // 🔒 AUTO SET STATUS JADI COMPLETED SETELAH FILE DI-UPLOAD
mysqli_query($koneksi, "
    UPDATE jadwal_ulangan
    SET status_pekerjaan = 'completed'
    WHERE id_jadwal = '$id_jadwal'
");

    log_perubahan($koneksi, 'Files', 'CREATE', "Upload file: $judul");

    echo "<script>location='index.php?menu=files';</script>";
    exit;
}


/* ================= UPDATE FILE ================= */
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $judul = $_POST['judul'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';

    $old = mysqli_fetch_assoc(
        mysqli_query($koneksi, "SELECT * FROM file_soal WHERE id_soal='$id'")
    );

    $nama_file = $judul !== '' ? $judul : $old['nama_file'];
    $deskripsi = $deskripsi !== '' ? $deskripsi : $old['deskripsi'];
    $path_file = $old['path_file'];
    $tipe_file = $old['tipe_file'];

    if (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFile = time() . "_" . $file['name'];

        move_uploaded_file($file['tmp_name'], "uploads/" . $newFile);

        if (file_exists("uploads/" . $old['path_file'])) {
            unlink("uploads/" . $old['path_file']);
        }

        $path_file = $newFile;
        $tipe_file = $ext;
    }

    mysqli_query($koneksi, "
        UPDATE file_soal SET
            nama_file='$nama_file',
            deskripsi='$deskripsi',
            path_file='$path_file',
            tipe_file='$tipe_file'
        WHERE id_soal='$id'
    ");

    log_perubahan(
        $koneksi,
        'Files',
        'UPDATE',
        "Edit file: {$old['nama_file']}"
    );

    echo "<script>window.location='index.php?menu=files';</script>";
    exit;
}


/* ================= GET FILES ================= */
$files = [];
$q = mysqli_query($koneksi, "
    SELECT 
        f.*,
        u.username,
        j.sekolah,
        j.kelas,
        j.mata_pelajaran,
        j.tanggal_ulangan
    FROM file_soal f
    LEFT JOIN users u 
        ON u.user_id = f.user_id
    LEFT JOIN jadwal_ulangan j
        ON j.id_jadwal = f.id_jadwal
    ORDER BY f.waktu_unggah DESC
");


while ($row = mysqli_fetch_assoc($q)) {
    $files[] = $row;
}
?>


<button class="btn btn-primary upload-floating" data-bs-toggle="modal" data-bs-target="#uploadModal">
    <i class="fa fa-upload"></i>
</button>

<!-- MODAL UPLOAD -->
<div class="modal fade" id="uploadModal">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Upload File Soal</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label class="form-label">Pilih Jadwal Ulangan</label>
<select name="id_jadwal" class="form-select mb-3" required>
  <option value="" disabled selected>-- Pilih Jadwal --</option>

  <?php while ($j = mysqli_fetch_assoc($jadwalValid)): ?>
    <option value="<?= $j['id_jadwal'] ?>">
      <?= htmlspecialchars($j['sekolah']) ?> —
      <?= htmlspecialchars($j['kelas']) ?> —
      <?= htmlspecialchars($j['mata_pelajaran']) ?> —
      <?= date('d M Y', strtotime($j['tanggal_ulangan'])) ?>
    </option>
  <?php endwhile; ?>
</select>


        <input name="judul" class="form-control mb-2" placeholder="Judul File" required>
        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
        <input type="file" name="file" class="form-control" required>
      </div>

      <div class="modal-footer">
        <button type="submit" name="upload" class="btn btn-primary">
          Upload
        </button>
      </div>
    </form>
  </div>
</div>


<div class="file-grid">

<?php foreach ($files as $f): ?>

<?php
  // cek apakah ini file yang BARU di-upload
  $isNew = isset($_GET['uploaded']) && $_GET['uploaded'] == $f['id_soal'];

  $isAdmin = $_SESSION['role'] === 'admin';
  $isOwner = $f['user_id'] === $_SESSION['user_id'];
  $showAction = $isAdmin || $isOwner;
?>

<div class="file-card <?= $isNew ? 'file-new' : '' ?>">

  <?php if ($showAction): ?>
  <div class="file-actions">

    <!-- ✏️ EDIT -->
    <?php if ($isAdmin || $isOwner): ?>
      <a href="#"
         class="btn-edit"
         data-bs-toggle="modal"
         data-bs-target="#edit<?= $f['id_soal'] ?>">
        <i class="fa fa-pen"></i>
      </a>
    <?php endif; ?>

    <!-- 🗑️ DELETE (ADMIN ONLY) -->
    <?php if ($isAdmin): ?>
      <form method="POST">
        <input type="hidden" name="delete_id" value="<?= $f['id_soal'] ?>">
        <button class="btn-delete"
                onclick="return confirm('Hapus file ini?')">
          <i class="fa fa-trash"></i>
        </button>
      </form>
    <?php endif; ?>

  </div>
  <?php endif; ?>

<span class="file-type"><?= strtoupper($f['tipe_file']) ?></span>

<h3 class="file-title"><?= htmlspecialchars($f['nama_file']) ?></h3>

<p style="font-size:13px;color:#6b7280;margin-bottom:2px;">
  📤 Diunggah oleh <?= htmlspecialchars($f['username']) ?> (<?= htmlspecialchars($f['user_id']) ?>)
</p>

<?php if (!empty($f['sekolah'])): ?>
<p style="font-size:12px;color:#374151;margin:4px 0;">
  📌 Digunakan untuk ulangan:
  <br>
  <strong>
    <?= htmlspecialchars($f['sekolah']) ?> —
    <?= htmlspecialchars($f['kelas']) ?> —
    <?= htmlspecialchars($f['mata_pelajaran']) ?>
  </strong>
</p>
<?php else: ?>
<p style="font-size:12px;color:#9ca3af;">
  ℹ️ Belum dikaitkan dengan jadwal ulangan
</p>
<?php endif; ?>

<p style="font-size:12px;color:#9ca3af;">
  📅 <?= date('d M Y H:i', strtotime($f['waktu_unggah'])) ?>
</p>

<a href="#" class="btn-file"
   data-bs-toggle="modal"
   data-bs-target="#file<?= $f['id_soal'] ?>">
  Open
</a>

</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="file<?= $f['id_soal'] ?>">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?= htmlspecialchars($f['nama_file']) ?></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <!-- META -->
        <div style="font-size:13px;color:#6b7280;line-height:1.6;">
          <div><strong>Uploader</strong> : <?= htmlspecialchars($f['username']) ?> (<?= htmlspecialchars($f['user_id']) ?>)</div>
          <div><strong>Tanggal Upload</strong> : <?= date('d M Y H:i', strtotime($f['waktu_unggah'])) ?></div>
        </div>

        <?php if (!empty($f['sekolah'])): ?>
        <hr>

        <p style="font-weight:600;margin-bottom:6px;">Konteks Penggunaan File</p>
        <p style="font-size:13px;color:#6b7280;margin-bottom:10px;">
          File ini digunakan sebagai bahan ulangan dengan detail berikut:
        </p>

        <div style="
          font-size:13px;
          background:#f9fafb;
          border:1px solid #e5e7eb;
          border-radius:12px;
          padding:12px 16px;
          line-height:1.8;
        ">
          <div><strong>Sekolah</strong> : <?= htmlspecialchars($f['sekolah']) ?></div>
          <div><strong>Kelas</strong> : <?= htmlspecialchars($f['kelas']) ?></div>
          <div><strong>Mata Pelajaran</strong> : <?= htmlspecialchars($f['mata_pelajaran']) ?></div>
          <div><strong>Tanggal Ulangan</strong> : <?= date('d M Y', strtotime($f['tanggal_ulangan'])) ?></div>
        </div>
        <?php endif; ?>

        <?php if (!empty($f['deskripsi'])): ?>
        <hr>
        <p><?= nl2br(htmlspecialchars($f['deskripsi'])) ?></p>
        <?php endif; ?>

        <?php if ($f['tipe_file'] === 'pdf'): ?>
          <iframe src="uploads/<?= $f['path_file'] ?>" width="100%" height="400" style="border-radius:8px;"></iframe>
        <?php else: ?>
          <div class="alert alert-secondary mt-3">Preview tidak tersedia</div>
        <?php endif; ?>

      </div>

      <div class="modal-footer">
        <a href="uploads/<?= $f['path_file'] ?>" class="btn btn-success" download>
          <i class="fa fa-download"></i> Download
        </a>
      </div>

    </div>
  </div>
</div>



<!-- MODAL DETAIL -->
<div class="modal fade" id="file<?= $f['id_soal'] ?>">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?= htmlspecialchars($f['nama_file']) ?></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p>
        <strong>Uploader:</strong>
        <?= htmlspecialchars($f['username']) ?> (<?= htmlspecialchars($f['user_id']) ?>)
        </p>

        <p><strong>Tanggal Upload:</strong>
        <?php if (!empty($f['sekolah'])): ?>
        <hr>
            <hr>

            <p style="font-weight:600;margin-bottom:6px;">
            Konteks Penggunaan File
            </p>

            <p style="font-size:13px;color:#6b7280;margin-bottom:10px;">
            File ini disiapkan sebagai bahan ulangan dengan detail berikut:
            </p>

            <div style="
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:6px 16px;
            font-size:13px;
            color:#374151;
            background:#f9fafb;
            border:1px solid #e5e7eb;
            border-radius:12px;
            padding:10px 14px;
            margin-bottom:14px;
            ">
            <div><strong>Sekolah</strong><br><?= htmlspecialchars($f['sekolah']) ?></div>
            <div><strong>Kelas</strong><br><?= htmlspecialchars($f['kelas']) ?></div>
            <div><strong>Mata Pelajaran</strong><br><?= htmlspecialchars($f['mata_pelajaran']) ?></div>
            <div><strong>Tanggal Ulangan</strong><br><?= date('d M Y', strtotime($f['tanggal_ulangan'])) ?></div>
            </div>

        <?php endif; ?>

          <?= date('d M Y H:i', strtotime($f['waktu_unggah'])) ?>
        </p>
        <hr>
        <p><?= nl2br(htmlspecialchars($f['deskripsi'])) ?></p>

        <?php if ($f['tipe_file'] === 'pdf'): ?>
          <iframe src="uploads/<?= $f['path_file'] ?>" width="100%" height="400"></iframe>
        <?php else: ?>
          <div class="alert alert-secondary">Preview tidak tersedia</div>
        <?php endif; ?>
      </div>

      <div class="modal-footer">
        <a href="uploads/<?= $f['path_file'] ?>" class="btn btn-success" download>
          <i class="fa fa-download"></i> Download
        </a>
      </div>

    </div>
  </div>
</div>

<?php endforeach; ?>

</div>


