<?php
session_start();
include 'koneksi.php';
include 'log_helper.php';

/**
 * PASTIKAN USER LOGIN
 */
if (!isset($_SESSION['user_id'])) {
    die("Session user_id tidak ditemukan");
}

$user_id = mysqli_real_escape_string($koneksi, $_SESSION['user_id']);

// ================== DATA BARU ==================
$new_name     = mysqli_real_escape_string($koneksi, $_POST['name'] ?? '');
$new_username = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
$password     = $_POST['password'] ?? '';
$confirm      = $_POST['confirm_password'] ?? '';

// ================== DATA LAMA ==================
$old = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT name, username, photo FROM users WHERE user_id='$user_id'"
    )
);

// ================== VALIDASI PASSWORD ==================

if ($password === '' && $confirm !== '') {
    $_SESSION['profile_error'] = "Password baru wajib diisi jika mengisi konfirmasi.";
    $_SESSION['open_profile_modal'] = true;
    header("Location: index.php?menu=dashboard");
    exit();
}

if ($password !== '' && $confirm === '') {
    $_SESSION['profile_error'] = "Konfirmasi password wajib diisi.";
    $_SESSION['open_profile_modal'] = true;
    header("Location: index.php?menu=dashboard");
    exit();
}

if ($password !== '' && $password !== $confirm) {
    $_SESSION['profile_error'] = "Password dan konfirmasi password tidak sama.";
    $_SESSION['open_profile_modal'] = true;
    header("Location: index.php?menu=dashboard");
    exit();
}

// ================== BUILD QUERY ==================
$query = "UPDATE users SET 
            name='$new_name',
            username='$new_username'";

$changes = [];

// log nama
if ($old['name'] !== $new_name) {
    $changes[] = "Nama: {$old['name']} → $new_name";
}

// log username
if ($old['username'] !== $new_username) {
    $changes[] = "Username: {$old['username']} → $new_username";
}

// password valid → simpan
if ($password !== '') {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $query .= ", password='$hashed'";
    $changes[] = "Password diubah";
}

// ================== FOTO ==================
if (!empty($_FILES['photo']['name'])) {

    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $allowed)) {
        $_SESSION['profile_error'] = "Format foto harus JPG / PNG / WEBP";
        $_SESSION['open_profile_modal'] = true;
        header("Location: index.php?menu=dashboard");
        exit();
    }

    if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
        $_SESSION['profile_error'] = "Ukuran foto maksimal 2MB";
        $_SESSION['open_profile_modal'] = true;
        header("Location: index.php?menu=dashboard");
        exit();
    }

    $filename = 'profile_' . time() . '.' . $ext;
    move_uploaded_file($_FILES['photo']['tmp_name'], "img/$filename");

    $query .= ", photo='$filename'";
    $_SESSION['photo'] = $filename;
    $changes[] = "Foto profil diubah";
}

// ================== EKSEKUSI ==================
$query .= " WHERE user_id='$user_id'";

if (!mysqli_query($koneksi, $query)) {
    die("Query error: " . mysqli_error($koneksi));
}

// ================== LOG ==================
if (!empty($changes)) {
    log_perubahan(
        $koneksi,
        'Profile',
        'UPDATE',
        implode(' | ', $changes)
    );
}

// ================== UPDATE SESSION ==================
$_SESSION['name']     = $new_name;
$_SESSION['username'] = $new_username;
$_SESSION['success']  = "Profil berhasil diperbarui";

header("Location: index.php?menu=dashboard");
exit;
