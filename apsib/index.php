<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/auth_guard.php';
requireLogin();
require_once __DIR__ . '/koneksi.php';

$user_id  = $_SESSION['user_id'] ?? '-';
$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'Guest';
$photo    = $_SESSION['photo'] ?? 'profile.png';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> EduSched - Anti Bentrok </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Additional CSS untuk User Management -->
    
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include "menu-sidebar.php"; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include "navbar.php"; ?>
            <!-- Navbar End -->

            <?php 
            $menu = isset($_GET['menu']) ? $_GET['menu'] : "dashboard";
            
            // Tampilkan pesan notifikasi jika ada
            if(isset($_SESSION['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>' . $_SESSION['success'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
                unset($_SESSION['success']);
            }
            
            if(isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>' . $_SESSION['error'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
                unset($_SESSION['error']);
            }
            
            // Include halaman berdasarkan menu
            if($menu == "dashboard")      { include "dashboard.php"; }
            if($menu == "sales") { include "sales.php"; }
            if($menu == "schedule") { include "schedule.php"; }
            if($menu == "files") { include "files.php"; }
            if($menu == "user_management") { include "user_management.php";}
            if($menu == "history") { include "history.php"; }

                // Include user_management.php yang sudah dimodifikasi
              
            ?>

            <!-- Footer Start -->
            <?php include "footer.php"; ?>
            <!-- Footer End -->

            <!-- ================= MODAL EDIT PROFILE ================= -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" action="update_profile.php" method="POST" enctype="multipart/form-data">

      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?php if (isset($_SESSION['profile_error'])): ?>
      <div class="alert alert-danger">
        <?= $_SESSION['profile_error']; ?>
      </div>
    <?php unset($_SESSION['profile_error']); ?>
    <?php endif; ?>

      <div class="modal-body">

        <div class="text-center mb-3">
          <img src="img/<?= htmlspecialchars($_SESSION['photo'] ?? 'profile.png') ?>"
               class="rounded-circle mb-2"
               style="width:90px;height:90px;object-fit:cover">
        </div>

         <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control"
                 value="<?= htmlspecialchars($_SESSION['name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control"
                 value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
        <label class="form-label">
          Password Baru <small class="text-muted">(opsional)</small>
        </label>
        <input type="password"
              name="password"
              class="form-control"
              autocomplete="new-password"
              placeholder="Kosongkan jika tidak ingin mengubah">
      </div>

      <div class="mb-3" id="confirmProfileBox">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password"
              name="confirm_password"
              class="form-control"
              autocomplete="new-password"
              placeholder="Ulangi password baru">
      </div>


        <div class="mb-3">
          <label class="form-label">Foto Profil</label>
          <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

    </form>
  </div>
</div>

<?php if (isset($_SESSION['open_profile_modal'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = new bootstrap.Modal(
    document.getElementById('profileModal')
  );
  modal.show();
});
</script>
<?php unset($_SESSION['open_profile_modal']); ?>
<?php endif; ?>


<!-- =============== END MODAL EDIT PROFILE =============== -->

        </div>
        <!-- Content End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>
</html>