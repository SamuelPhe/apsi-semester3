

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'Guest';
$photo    = $_SESSION['photo'] ?? 'profile.png';
?>

        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                


                <div class="navbar-nav align-items-center ms-auto">
                    
                <div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
       data-bs-toggle="dropdown">

        <img 
            src="img/<?= htmlspecialchars($photo) ?>" 
            alt="Profile"
            class="rounded-circle"
            style="width:40px;height:40px;object-fit:cover;"
        >

        <div class="d-none d-lg-flex flex-column text-start">
            <span class="fw-semibold"><?= htmlspecialchars($username) ?></span>
            <small class="text-muted"><?= ucfirst(htmlspecialchars($role)) ?></small>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 p-1"
         style="min-width:220px">

        <button class="dropdown-item d-flex align-items-center gap-2"
                data-bs-toggle="modal"
                data-bs-target="#profileModal">
            <i class="fa fa-user-edit text-primary"></i> Edit Profile
        </button>

        <div class="dropdown-divider"></div>

        <a href="logout.php" class="dropdown-item d-flex align-items-center gap-2 text-danger">
            <i class="fa fa-sign-out-alt"></i> Log Out
        </a>
    </div>
</div>

            </nav>