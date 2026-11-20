<?php
session_start();
include 'koneksi.php';
include 'log_helper.php';

if ($_POST['action'] !== 'edit_schedule') {
    header("Location: index.php?menu=schedule");
    exit;
}

$old = $_POST['old_sekolah'];
$new = $_POST['new_sekolah'];
$jk  = (int)$_POST['jumlah_kelas'];
$jm  = (int)$_POST['jumlah_mapel'];

$logDetail = []; // 🔥 kumpulan perubahan

/*
====================================
1️⃣ RENAME SEKOLAH
====================================
*/
if ($old !== $new) {
    mysqli_query($koneksi,"
        UPDATE jadwal_ulangan
        SET sekolah='$new'
        WHERE sekolah='$old'
    ");

    $logDetail[] = "Nama sekolah: $old → $new";
}

/*
====================================
2️⃣ HITUNG DATA SAAT INI
====================================
*/

// kelas sekarang
$q = mysqli_query($koneksi,"
    SELECT COUNT(DISTINCT kelas) AS total
    FROM jadwal_ulangan
    WHERE sekolah='$new'
");
$currKelas = (int)mysqli_fetch_assoc($q)['total'];

// mapel sekarang
$q = mysqli_query($koneksi,"
    SELECT mata_pelajaran
    FROM jadwal_ulangan
    WHERE sekolah='$new'
    GROUP BY mata_pelajaran
    ORDER BY mata_pelajaran
");
$mapelList = [];
while ($r = mysqli_fetch_assoc($q)) {
    $mapelList[] = $r['mata_pelajaran'];
}
$currMapel = count($mapelList);

/*
====================================
3️⃣ TAMBAH / KURANG KELAS
====================================
*/
if ($jk > $currKelas) {
    for ($k = $currKelas + 1; $k <= $jk; $k++) {
        foreach ($mapelList as $mapel) {
            mysqli_query($koneksi,"
                INSERT INTO jadwal_ulangan (sekolah, kelas, mata_pelajaran)
                VALUES ('$new','Kelas $k','$mapel')
            ");
        }
    }
}

if ($jk < $currKelas) {
    for ($k = $currKelas; $k > $jk; $k--) {
        mysqli_query($koneksi,"
            DELETE FROM jadwal_ulangan
            WHERE sekolah='$new' AND kelas='Kelas $k'
        ");
    }
}

if ($jk !== $currKelas) {
    $logDetail[] = "Jumlah kelas: $currKelas → $jk";
}

/*
====================================
4️⃣ TAMBAH / KURANG MAPEL
====================================
*/

// refresh kelas list
$kelasQ = mysqli_query($koneksi,"
    SELECT DISTINCT kelas
    FROM jadwal_ulangan
    WHERE sekolah='$new'
");
$kelasList = [];
while ($r = mysqli_fetch_assoc($kelasQ)) {
    $kelasList[] = $r['kelas'];
}

// ➕ tambah mapel
if ($jm > $currMapel) {
    for ($m = $currMapel + 1; $m <= $jm; $m++) {
        $namaMapel = "Mapel $m";
        foreach ($kelasList as $kelas) {
            mysqli_query($koneksi,"
                INSERT INTO jadwal_ulangan (sekolah, kelas, mata_pelajaran)
                VALUES ('$new','$kelas','$namaMapel')
            ");
        }
    }
}

// ➖ kurangi mapel
$hapusMapel = $_POST['hapus_mapel'] ?? [];
$hapusCount = count($hapusMapel);

if ($jm < $currMapel) {
    $harusHapus = $currMapel - $jm;

    if ($hapusCount !== $harusHapus) {
        die("Jumlah mapel dikurangi $harusHapus, tetapi dipilih $hapusCount.");
    }

    foreach ($hapusMapel as $mapel) {
        mysqli_query($koneksi,"
            DELETE FROM jadwal_ulangan
            WHERE sekolah='$new'
            AND mata_pelajaran='".mysqli_real_escape_string($koneksi,$mapel)."'
        ");
    }
}

if ($jm !== $currMapel) {
    $logDetail[] = "Jumlah mapel: $currMapel → $jm";
}

/*
====================================
5️⃣ SIMPAN HISTORY (HANYA JIKA ADA PERUBAHAN)
====================================
*/
if (!empty($logDetail)) {
    log_perubahan(
    $koneksi,
    'Schedule',
    'UPDATE',
    "Edit jadwal $new (" . implode(' | ', $logDetail) . ")"
);

}

header("Location: index.php?menu=schedule");
exit;
