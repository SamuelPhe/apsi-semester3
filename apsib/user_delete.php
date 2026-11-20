<?php
session_start();

include 'auth_guard.php';
onlyAdmin();

include 'koneksi.php';
include 'log_helper.php';

$user_id = $_GET['user_id'] ?? '';

if ($user_id === '') {
    header("Location: index.php?menu=user_management");
    exit;
}

$user = mysqli_fetch_assoc(mysqli_query(
    $koneksi,
    "SELECT name, user_id FROM users WHERE user_id='$user_id'"
));

if (!$user) {
    $_SESSION['error'] = "User tidak ditemukan!";
    header("Location: index.php?menu=user_management");
    exit;
}

log_perubahan(
    $koneksi,
    'User Management',
    'DELETE',
    "Menghapus user {$user['name']} (ID: {$user['user_id']})"
);

$delete = mysqli_query($koneksi, "DELETE FROM users WHERE user_id='$user_id'");


// redirect
header("Location: index.php?menu=user_management");
exit;