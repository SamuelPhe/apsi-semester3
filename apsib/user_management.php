

<style>
/* ================= USER MANAGEMENT HEADER – CLEAN SOLID ================= */

.user-header {
    background: #5b5df6; /* 1 warna ungu solid */
    padding: 30px 34px;
    border-radius: 24px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 36px;

    /* depth tanpa putih */
    box-shadow: 0 22px 45px rgba(91,93,246,.45);

    transition: transform .25s ease, box-shadow .25s ease;
}

/* hover lembut */
.user-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 32px 70px rgba(91,93,246,.6);
}

/* judul */
.user-header h3 {
    margin: 0;
    font-size: 22px;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: .3px;
}

/* subjudul */
.user-header p {
    margin: 6px 0 0;
    font-size: 14px;
    color: rgba(255,255,255,.9);
}

/* tombol add user */
.user-header .btn {
    background: #ffffff;
    color: #5b5df6;
    border-radius: 14px;
    padding: 8px 16px;
    font-weight: 600;
    box-shadow: 0 8px 18px rgba(0,0,0,.25);
    transition: all .2s ease;
}

.user-header .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 26px rgba(0,0,0,.35);
}


/* ================= USER CARD ================= */

.user-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 28px rgba(0,0,0,.06);
    position: relative;
    transition: all .25s ease;
}

.user-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 45px rgba(79,70,229,.18);
}

/* ================= USER INFO ================= */

.user-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.user-info img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e0e7ff;
}

.user-info h6 {
    margin: 0;
    font-weight: 700;
    color: #0f172a;
}

.user-info span {
    font-size: 13px;
    color: #64748b;
}

/* ================= META ================= */

.user-meta {
    margin-top: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-meta p {
    margin: 0;
    font-size: 14px;
    color: #475569;
}

/* ================= ROLE BADGE ================= */

.badge-role {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: capitalize;
}

/* Admin */
.badge-role.admin {
    background: #eef2ff;
    color: #4338ca;
}

/* Guru */
.badge-role.guru {
    background: #ecfeff;
    color: #0369a1;
}

/* ================= ACTION BUTTONS ================= */

.user-action {
    position: absolute;
    top: 16px;
    right: 16px;
    display: flex;
    gap: 8px;
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
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e5e7eb;
    transition: all .2s ease;
}

.btn-edit:hover {
    background: #eef2ff;
    color: #4338ca;
}

.btn-delete:hover {
    background: #fee2e2;
    color: #b91c1c;
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


</style>


<?php
include 'auth_guard.php';
onlyAdmin();

$qAdmin = mysqli_query($koneksi, "SELECT * FROM users WHERE role='admin' ORDER BY user_id DESC");
$qGuru  = mysqli_query($koneksi, "SELECT * FROM users WHERE role='guru' ORDER BY user_id DESC");
$qTotal = mysqli_query($koneksi, "SELECT user_id FROM users");
?>


<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="user-header mb-3">
        <div>
            <h3>User Management</h3>
            <p class="mb-0">Manage admin & teacher accounts</p>
        </div>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus me-1"></i> Add User
        </button>
    </div>

 <!-- SUMMARY WRAPPER -->
<div class="summary-wrapper">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="summary-card">
                <small>Total User</small>
                <h4><?= mysqli_num_rows($qTotal); ?></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card admin">
                <small>Admin</small>
                <h4><?= mysqli_num_rows($qAdmin); ?></h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="summary-card guru">
                <small>Guru</small>
                <h4><?= mysqli_num_rows($qGuru); ?></h4>
            </div>
        </div>
    </div>
</div>

    <!-- ================= ADMIN ================= -->
    <h5 class="fw-bold mb-3">Admin</h5>

    <div class="row g-4 mb-4">
    <?php
    if (mysqli_num_rows($qAdmin) > 0) {
        while ($u = mysqli_fetch_array($qAdmin)) {
    ?>
        <div class="col-md-6 col-lg-4">
            <div class="user-card">
                <div class="user-info">
                    <img src="img/<?= htmlspecialchars($u['photo']); ?>" alt="User">
                    <div>
                        <h6><?= htmlspecialchars($u['name']); ?></h6>
                        <span>ID: <?= htmlspecialchars($u['user_id']); ?></span>
                    </div>
                </div>

                <div class="user-meta">
                    <p>@<?= htmlspecialchars($u['username']); ?></p>
                    <span class="badge-role admin">Admin</span>
                </div>

                <div class="user-action">
<?php if ($u['user_id'] != $_SESSION['user_id']): ?>

    <!-- Edit user lain -->
    <a href="user_edit.php?user_id=<?= $u['user_id']; ?>" class="btn-edit">
        <i class="fas fa-pen"></i>
    </a>

    <!-- Delete user lain -->
    <a href="user_delete.php?user_id=<?= $u['user_id']; ?>"
       class="btn-delete"
       onclick="return confirm('Delete user <?= addslashes($u['name']); ?>?')">
        <i class="fas fa-trash"></i>
    </a>

<?php else: ?>

    <!-- Akun sendiri -->
    <span class="badge badge-self">Akun Anda</span>

<?php endif; ?>
</div>

            </div>
        </div>
    <?php
        }
    } else {
        echo '<div class="col-12 text-muted fst-italic">Tidak ada admin.</div>';
    }
    ?>
    </div>

    <!-- PEMBATAS -->
    <hr class="my-4" style="border-top:1px dashed #e5e7eb;">

    <!-- ================= GURU ================= -->
    <h5 class="fw-bold mb-3">Guru</h5>

    <div class="row g-4">
    <?php
    if (mysqli_num_rows($qGuru) > 0) {
        while ($u = mysqli_fetch_array($qGuru)) {
    ?>
        <div class="col-md-6 col-lg-4">
            <div class="user-card">
                <div class="user-info">
                    <img src="img/<?= htmlspecialchars($u['photo']); ?>" alt="User">
                    <div>
                        <h6><?= htmlspecialchars($u['name']); ?></h6>
                        <span>ID: <?= htmlspecialchars($u['user_id']); ?></span>
                    </div>
                </div>

                <div class="user-meta">
                    <p>@<?= htmlspecialchars($u['username']); ?></p>
                    <span class="badge-role guru">Guru</span>
                </div>

                <div class="user-action">
                    <a href="user_edit.php?user_id=<?= $u['user_id']; ?>" class="btn-edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="user_delete.php?user_id=<?= $u['user_id']; ?>"
                       class="btn-delete"
                       onclick="return confirm('Delete user <?= addslashes($u['name']); ?>?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo '<div class="col-12 text-muted fst-italic">Tidak ada guru.</div>';
    }
    ?>
    </div>

</div>



                <!-- Modal Add User -->
                <div class="modal fade" id="addUserModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" action="user_add.php">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <input type="text" name="user_id" class="form-control" placeholder="ID User" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="password" name="password" id="passwordField" class="form-control" placeholder="Password" required>
                                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <select name="role" class="form-control" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="guru">Guru</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="simpan_user" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <script>
                // Toggle password visibility
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleBtn = document.getElementById('togglePassword');
                    const passwordField = document.getElementById('passwordField');
                    
                    if(toggleBtn && passwordField) {
                        toggleBtn.addEventListener('click', function() {
                            const type = passwordField.type === 'password' ? 'text' : 'password';
                            passwordField.type = type;
                            
                            const icon = this.querySelector('i');
                            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
                        });
                    }
                    
                    // Auto-close alerts after 5 seconds
                    setTimeout(() => {
                        const alerts = document.querySelectorAll('.alert');
                        alerts.forEach(alert => {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        });
                    }, 5000);
                });
                </script>