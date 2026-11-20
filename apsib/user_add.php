<?php
session_start();

include 'auth_guard.php';
onlyAdmin(); // 🔒 KUNCI ADMIN SAJA

include 'koneksi.php';
include 'log_helper.php';

if (isset($_POST['simpan_user'])) {

    // Ambil & sanitasi data
    $user_id  = mysqli_real_escape_string($koneksi, $_POST['user_id']);
    $name     = mysqli_real_escape_string($koneksi, $_POST['name']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $role     = mysqli_real_escape_string($koneksi, $_POST['role']);

    // VALIDASI KOSONG
    if (empty($user_id) || empty($name) || empty($username) || empty($password) || empty($role)) {
        $_SESSION['error'] = "Semua field wajib diisi!";
        header("Location: index.php?menu=user_management");
        exit();
    }

    // VALIDASI PASSWORD
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password minimal 6 karakter!";
        header("Location: index.php?menu=user_management");
        exit();
    }

    // CEK USER_ID (HARUS UNIK)
    $cek_id = mysqli_query($koneksi, "SELECT user_id FROM users WHERE user_id = '$user_id'");
    if (mysqli_num_rows($cek_id) > 0) {
        $_SESSION['error'] = "ID User sudah digunakan!";
        header("Location: index.php?menu=user_management");
        exit();
    }

    // CEK USERNAME (HARUS UNIK)
    $cek_username = mysqli_query($koneksi, "SELECT user_id FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        $_SESSION['error'] = "Username sudah digunakan!";
        header("Location: index.php?menu=user_management");
        exit();
    }

    // HASH PASSWORD
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $default_photo = 'profile.png';

    // INSERT DATA
    $query = "INSERT INTO users (user_id, name, username, password, role, photo)
              VALUES ('$user_id', '$name', '$username', '$hashed_password', '$role', '$default_photo')";

    if (mysqli_query($koneksi, $query)) {

        log_perubahan(
            $koneksi,
            'User Management',
            'CREATE',
            "Menambahkan user $name (ID: $user_id)"
        );

        $_SESSION['success'] = "User berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan user!";
    }

    header("Location: index.php?menu=user_management");
    exit();

} else {
    header("Location: index.php");
    exit();
}