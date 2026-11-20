
<?php
session_start();

include 'auth_guard.php';
onlyAdmin();

include 'koneksi.php';

$user_id = $_GET['user_id'] ?? '';

// Ambil data user lama
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE user_id='$user_id'"
);
$user = mysqli_fetch_assoc($query);

if (!$user) {
    $_SESSION['error'] = "User tidak ditemukan!";
    header("Location: index.php?menu=user_management");
    exit();
}

// ============================
// PROSES UPDATE
// ============================
if (isset($_POST['update_user'])) {

    // data lama (untuk log)
    $oldName     = $user['name'];
    $oldUsername = $user['username'];
    $oldRole     = $user['role'];

    // data baru
    $name     = mysqli_real_escape_string($koneksi, $_POST['name']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role     = mysqli_real_escape_string($koneksi, $_POST['role']);

    // cek username
    $check = mysqli_query(
        $koneksi,
        "SELECT user_id FROM users WHERE username='$username' AND user_id != '$user_id'"
    );

    if (mysqli_num_rows($check) > 0) {
        $_SESSION['error'] = "Username sudah digunakan!";
        header("Location: user_edit.php?user_id=$user_id");
        exit();
    }

    // query dasar
    $sql = "UPDATE users SET
                name='$name',
                username='$username',
                role='$role'
            WHERE user_id='$user_id'";

    // jika password diisi
$password         = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// ❌ confirm diisi tapi password kosong
if (empty($password) && !empty($confirm_password)) {
    $_SESSION['error'] = "Isi password baru terlebih dahulu.";
    header("Location: user_edit.php?user_id=$user_id");
    exit();
}

// DEFAULT: password tidak diubah
$sql = "UPDATE users SET
            name='$name',
            username='$username',
            role='$role'
        WHERE user_id='$user_id'";

// JIKA USER MAU GANTI PASSWORD
if (!empty($password)) {

    // ❌ confirm kosong
    if (empty($confirm_password)) {
        $_SESSION['error'] = "Konfirmasi password wajib diisi.";
        header("Location: user_edit.php?user_id=$user_id");
        exit();
    }

    // ❌ tidak sama
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan konfirmasi password tidak sama.";
        header("Location: user_edit.php?user_id=$user_id");
        exit();
    }

    // ✅ aman
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET
                name='$name',
                username='$username',
                password='$hashed',
                role='$role'
            WHERE user_id='$user_id'";
}



    if (mysqli_query($koneksi, $sql)) {

        // ============================
        // LOG PERUBAHAN (AMAN)
        // ============================
        include 'log_helper.php';

        $changes = [];

        if ($oldName !== $name)
            $changes[] = "nama: $oldName → $name";

        if ($oldUsername !== $username)
            $changes[] = "username: $oldUsername → $username";

        if ($oldRole !== $role)
            $changes[] = "role: $oldRole → $role";

        if (!empty($changes)) {
            $detail = "Update user $oldName (" . implode(', ', $changes) . ")";
            log_perubahan(
                $koneksi,
                'User Management',
                'UPDATE',
                $detail
            );
        }

        $_SESSION['success'] = "User berhasil diupdate! Silahkan login kembali untuk melihat perubahan.";
        header("Location: index.php?menu=user_management");
        exit();

    } else {
        $_SESSION['error'] = "Gagal update user";
        header("Location: user_edit.php?user_id=$user_id");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit User</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" 
                                       value="<?= htmlspecialchars($user['name']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" 
                                       value="<?= htmlspecialchars($user['username']); ?>" required>
                            </div>
                            
                           <div class="mb-3">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                autocomplete="new-password"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div class="mb-3" id="confirmBox">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password"
                                name="confirm_password"
                                class="form-control"
                                autocomplete="new-password"
                                placeholder="Ulangi password baru">
                        </div>

                            
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="guru" <?= $user['role'] == 'guru' ? 'selected' : ''; ?>>Guru</option>
                                </select>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="index.php?menu=user_management" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" name="update_user" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
