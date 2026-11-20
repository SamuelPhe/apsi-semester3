<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EduSched | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #1d3557, #457b9d);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            width: 380px;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-header i {
            font-size: 42px;
            color: #1d3557;
        }

        .login-header h2 {
            margin: 10px 0 4px;
            font-weight: 600;
        }

        .login-header p {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            font-size: 13px;
            color: #333;
            margin-bottom: 6px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #457b9d;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #1d3557;
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: #16324f;
        }

        .footer-text {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
<?php if (isset($_SESSION['login_error'])) : ?>
    <script>
        alert("<?= $_SESSION['login_error']; ?>");
    </script>
<?php unset($_SESSION['login_error']); endif; ?>

<?php if (isset($_SESSION['login_success'])) : ?>
    <script>
        alert("<?= $_SESSION['login_success']; ?>");
    </script>
<?php unset($_SESSION['login_success']); endif; ?>


<div class="login-card">
    <div class="login-header">
        <img src="img/logov1.png" alt="Logo Edusched"  width="100" height="100">
        <h2>EduSched</h2>
        <p>Sistem Penjadwalan Anti Bentrok</p>
    </div>

    <form action="cek_login.php" method="POST">
        <div class="form-group">
            <label>ID User</label>
            <input type="text" name="id_user" placeholder="Masukkan ID Anda" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan Username Anda" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan Password Anda" required>
        </div>

        <button class="btn-login" type="submit">
            <i class="fa-solid fa-right-to-bracket"></i> Login
        </button>
    </form>

    <div class="footer-text">
        © 2025 EduSched
    </div>
</div>

</body>
</html>
