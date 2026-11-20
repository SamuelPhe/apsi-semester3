
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

define('APP_ACCESS', true);

// router utama
include 'index.php';
