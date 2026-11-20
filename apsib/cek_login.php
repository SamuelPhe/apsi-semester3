<?php
session_start();
include 'koneksi.php';

$user_id  = $_POST['id_user'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// 1. Cek ID User
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    $_SESSION['login_error'] = "ID User tidak ditemukan!";
    header("Location: login.php");
    exit;
}

// 2. Cek Username
if ($username !== $user['username']) {
    $_SESSION['login_error'] = "Username tidak sesuai dengan ID!";
    header("Location: login.php");
    exit;
}

// 3. Cek Password
if (!password_verify($password, $user['password'])) {
    $_SESSION['login_error'] = "Password salah!";
    header("Location: login.php");
    exit;
}

// 4. Login berhasil
$_SESSION['login']    = true;
$_SESSION['user_id']  = $user['user_id'];
$_SESSION['name'] = $user['name'];
$_SESSION['username'] = $user['username'];
$_SESSION['role']     = $user['role'];
$_SESSION['photo']    = $user['photo'] ?? 'profile.png'; // nama file foto
$_SESSION['status']   = 'available'; // contoh: available / busy / offline


// Popup sukses
$_SESSION['login_success'] = "Login berhasil!";

// Role-based redirect (sementara admin dulu)
if ($user['role'] === 'admin') {
    header("Location: index.php?menu=dashboard");
    exit;
}

if ($user['role'] === 'guru') {
    header("Location: index.php?menu=dashboard");
    exit;
}

exit;
