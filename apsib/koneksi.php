<?php
declare(strict_types=1);

// Read local database settings from .env when available.
$envFile = __DIR__ . '/.env';
if (is_readable($envFile)) {
    $settings = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    if (is_array($settings)) {
        foreach ($settings as $key => $value) {
            if (getenv($key) === false) {
                putenv($key . '=' . (string) $value);
            }
        }
    }
}

$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbPort = (int) (getenv('DB_PORT') ?: 3306);
$dbName = getenv('DB_NAME') ?: 'edusched';
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASSWORD');

if ($dbUser === false || $dbPass === false) {
    error_log('EduSched: DB_USER / DB_PASSWORD belum dikonfigurasi.');
    http_response_code(500);
    exit('Konfigurasi database belum lengkap. Salin .env.example menjadi .env dan isi kredensial database.');
}

mysqli_report(MYSQLI_REPORT_OFF);
$koneksi = mysqli_init();
mysqli_options($koneksi, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

if (!mysqli_real_connect($koneksi, $dbHost, $dbUser, $dbPass, $dbName, $dbPort)) {
    error_log('EduSched database connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    exit('Database tidak dapat dihubungi. Periksa konfigurasi database.');
}

if (!mysqli_set_charset($koneksi, 'utf8mb4')) {
    error_log('EduSched could not set utf8mb4 connection charset.');
    http_response_code(500);
    exit('Koneksi database gagal disiapkan.');
}
