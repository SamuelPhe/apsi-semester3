<?php
if (!isset($_GET['file'])) {
    exit('File tidak valid');
}

$filename = basename($_GET['file']);
$filepath = __DIR__ . '/uploads/' . $filename;

if (!file_exists($filepath)) {
    exit('File tidak ditemukan');
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filepath));
header('Cache-Control: no-cache');

readfile($filepath);
exit;
