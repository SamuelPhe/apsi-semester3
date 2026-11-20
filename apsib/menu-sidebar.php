<?php
$menu = $_GET['menu'] ?? 'dashboard';
?>


<style>
  /* ===============================
   PURPLE SIDEBAR – MODERN & CLEAN
================================ */
.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    padding: 20px 0;
    font-family: 'Inter', sans-serif;

    /* PURPLE GRADIENT */
    background: linear-gradient(180deg,#4f46e5,#6d5dfc);
    box-shadow: 6px 0 24px rgba(79,70,229,.35);
}

.sidebar-name {
    font-size: 14px;
    font-weight: 600;
    color: #000000ff;
    line-height: 1.2;        /* ⬅️ ini kuncinya */
    white-space: nowrap;    /* biar gak turun */
}

.sidebar-id {
    font-size: 14px;
    font-weight: 600;
    color: #000000ff;
    margin-left: 1px;       /* ⬅️ dekatin */
}

.sidebar-role {
    display: inline-block;
    margin-top: 4px;
    font-size: 11px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 999px;
    background: #e7e7e7ff;    /* hijau muda */
    color: #090909ff;         /* hijau gelap */
    width: fit-content;
}

/* ===============================
   LOGO
================================ */
.sidebar-header {
    text-align: center;
    padding-bottom: 20px;
}

.sidebar-logo {
    max-width: 180px;
    filter: brightness(1.1);
}

/* ===============================
   USER PROFILE
================================ */
.sidebar-user {
    background: #ffffff;
    border-radius: 18px;
    margin: 16px 12px;          /* ⬅️ lebih lebar */
    padding: 20px 22px;         /* ⬅️ horizontal diperbesar */
    box-shadow:
        0 14px 34px rgba(0,0,0,.18),
        inset 0 1px 0 rgba(255,255,255,.95);

    display: flex;
    align-items: center;
    gap: 14px;
}

.user-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,.4);
}

.sidebar-user-info {
    color: #ffffff;
}


.sidebar-role {
    font-size: 12px;
    opacity: .8;
}

/* divider */
.sidebar-divider {
    margin: 12px 20px;
    border-top: 1px solid rgba(255,255,255,.25);
}

/* ===============================
   MENU
================================ */
.sidebar-menu {
    list-style: none;
    padding: 10px;
    margin: 0;
}

.sidebar-menu li {
    margin-bottom: 6px;
}

/* link */
.sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 16px;
    border-radius: 14px;
    color: rgba(255,255,255,.85);
    text-decoration: none;
    font-weight: 500;
    transition: all .25s ease;
}

.sidebar-menu a i {
    font-size: 18px;
    min-width: 22px;
}

/* hover */
.sidebar-menu a:hover {
    background: rgba(255,255,255,.15);
    transform: translateX(6px);
    color: #ffffff;
}

/* active */
.sidebar-menu .active a {
    background: #ffffff;
    color: #4f46e5;
    box-shadow: 0 10px 24px rgba(0,0,0,.2);
}

/* ===============================
   CONTENT OFFSET
================================ */
.content {
    margin-left: 260px;
    padding: 24px;
}

/* ===============================
   USER CARD – WHITE FLOATING
================================ */
.sidebar-user {
    background: #ffffff;
    border-radius: 16px;
    margin: 16px 16px 12px;
    padding: 14px 16px;
    box-shadow:
        0 12px 30px rgba(0,0,0,.18),
        inset 0 1px 0 rgba(255,255,255,.95);
    transition: transform .25s ease, box-shadow .25s ease;
}

/* hover effect */
.sidebar-user:hover {
    transform: translateY(-3px);
    box-shadow:
        0 20px 45px rgba(0,0,0,.28),
        inset 0 1px 0 rgba(255,255,255,1);
}

/* avatar */
.user-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 2px solid #e5e7eb;
}

/* text */
.sidebar-user-info {
    color: #111827;
}

.sidebar-name {
    font-size: 14px;
    font-weight: 600;
    color: #111827;
}

.sidebar-role {
    font-size: 12px;
    font-weight: 500;
    color: #6366f1; /* ungu konsisten */
}

/* divider lebih soft */
.sidebar-divider {
    margin: 12px 20px;
    border-top: 1px solid rgba(255,255,255,.3);
}

/* ===============================
   LOGO CARD – FLOATING & CLEAR
================================ */
.sidebar-header {
    padding: 16px;
}

/* card logo */
.logo-card {
    background: #ffffffff;
    border-radius: 20px;
    padding: 18px 16px;
    box-shadow:
        0 18px 45px rgba(79,70,229,.35),
        inset 0 1px 0 rgba(255,255,255,.95);
    position: relative;
    overflow: hidden;
    transition: all .25s ease;
}

/* subtle glow */
.logo-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(
        circle at top right,
        rgba(99,102,241,.25),
        transparent 60%
    );
    pointer-events: none;
}

/* hover effect */
.logo-card:hover {
    transform: translateY(-4px);
    box-shadow:
        0 28px 65px rgba(79,70,229,.45),
        inset 0 1px 0 rgba(255,255,255,1);
}

/* logo image */
.sidebar-logo {
    max-width: 120px;
    display: block;
    margin: auto;
}

</style>


     <!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
    <div class="logo-card text-center">
        <img src="img/logov2.png" alt="EduSched" class="sidebar-logo">
    </div>
</div>


    <!-- User Info -->
  <div class="sidebar-user">
    <div class="avatar-wrapper">
        <img src="img/<?= htmlspecialchars($photo) ?>" class="user-avatar">

        <!-- Status dot -->
        <span class="status-dot <?= $status ?>"></span>
    </div>

    <div class="sidebar-user-info">
<div class="sidebar-name">
    <?= htmlspecialchars($username) ?>
    <span class="sidebar-id">(<?= htmlspecialchars($user_id) ?>)</span>
</div>

    <div class="sidebar-role"><?= htmlspecialchars(ucfirst($role)) ?></div>
  
    
</div>

</div>

<!-- Divider -->
<div class="sidebar-divider"></div>


  <ul class="sidebar-menu">

    <li class="<?= ($menu == 'dashboard') ? 'active' : '' ?>">
        <a href="index.php?menu=dashboard">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="<?= ($menu == 'schedule') ? 'active' : '' ?>">
        <a href="index.php?menu=schedule">
            <i class="fa fa-calendar"></i>
            <span>Schedule</span>
        </a>
    </li>

    <li class="<?= ($menu == 'files') ? 'active' : '' ?>">
        <a href="index.php?menu=files">
            <i class="fa fa-file-alt"></i>
            <span>Files</span>
        </a>
    </li>

    <li class="<?= ($menu == 'history') ? 'active' : '' ?>">
        <a href="index.php?menu=history">
            <i class="fa fa-history"></i>
            <span>History</span>
        </a>
    </li>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <li class="<?= ($menu == 'user_management') ? 'active' : '' ?>">
            <a href="index.php?menu=user_management">
                <i class="fa fa-user-edit"></i>
                <span>User Management</span>
            </a>
        </li>
    <?php endif; ?>

</ul>


                </div>
            </nav>
        </div>