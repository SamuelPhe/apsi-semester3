<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('requireLogin')) {
    function requireLogin(): void {
        if (($_SESSION['login'] ?? false) !== true || empty($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }
    }
}

if (!function_exists('onlyAdmin')) {
    function onlyAdmin(): void {
        requireLogin();
        if (($_SESSION['role'] ?? '') !== 'admin') {
            http_response_code(403);
            exit('Akses ditolak.');
        }
    }
}

if (!function_exists('onlyGuru')) {
    function onlyGuru(): void {
        requireLogin();
        if (($_SESSION['role'] ?? '') !== 'guru') {
            http_response_code(403);
            exit('Akses ditolak.');
        }
    }
}
