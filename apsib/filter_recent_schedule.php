<?php
include 'koneksi.php';

/*
================================================
FILTER RECENT SCHEDULE (ANTI 1970 / DATA KOSONG)
================================================
*/

$where = [];
$order = "tanggal_ulangan DESC";

/* 🔒 WAJIB: BLOKIR TANGGAL TIDAK VALID */
$where[] = "
    tanggal_ulangan IS NOT NULL
    AND tanggal_ulangan != '0000-00-00'
    AND YEAR(tanggal_ulangan) >= 2000
";

/* FILTER DARI USER */
if (!empty($_POST['sekolah']))
    $where[] = "sekolah LIKE '%".$_POST['sekolah']."%'";

if (!empty($_POST['kelas']))
    $where[] = "kelas LIKE '%".$_POST['kelas']."%'";

if (!empty($_POST['mapel']))
    $where[] = "mata_pelajaran LIKE '%".$_POST['mapel']."%'";

if (!empty($_POST['status']))
    $where[] = "status_pekerjaan='".$_POST['status']."'";

/* SORT TANGGAL */
if (!empty($_POST['order']) && in_array($_POST['order'], ['ASC','DESC']))
    $order = "tanggal_ulangan ".$_POST['order'];

/* GABUNG WHERE */
$whereSQL = "WHERE ".implode(" AND ", $where);

/* QUERY */
$q = mysqli_query($koneksi,"
SELECT
  j.tanggal_ulangan,
  j.sekolah,
  j.kelas,
  j.mata_pelajaran,
  j.status_pekerjaan,
  u.username AS pic_username
FROM jadwal_ulangan j
LEFT JOIN users u ON u.user_id = j.user_id
WHERE j.tanggal_ulangan IS NOT NULL
  AND j.status_pekerjaan IS NOT NULL
  AND j.status_pekerjaan <> ''
ORDER BY j.tanggal_ulangan ASC
");

/* JIKA DATA KOSONG */
if (mysqli_num_rows($q) == 0) {
    echo "
    <tr>
        <td colspan='7' class='text-center text-muted'>
            Data tidak ditemukan
        </td>
    </tr>";
    exit;
}

/* OUTPUT DATA */
while ($r = mysqli_fetch_assoc($q)) {
    echo "
    <tr>
        <td>".
            (
                strtotime($r['tanggal_ulangan']) > 0
                ? date('d M Y', strtotime($r['tanggal_ulangan']))
                : '-'
            ).
        "</td>
        <td>".htmlspecialchars($r['sekolah'])."</td>
        <td>".htmlspecialchars($r['kelas'])."</td>
        <td>".htmlspecialchars($r['mata_pelajaran'])."</td>
        <td>";

    if ($r['status_pekerjaan'] === 'not_started') {
        echo "<span class='badge bg-danger'>Not Started</span>";
    } elseif ($r['status_pekerjaan'] === 'in_progress') {
        echo "<span class='badge bg-warning text-dark'>In Progress</span>";
    } else {
        echo "<span class='badge bg-success'>Completed</span>";
    }

    echo "
        </td>
        <td>".($r['pic_username'] ?: '-')."</td>
        <td>
            <a class='btn btn-sm btn-primary'
               href='index.php?menu=schedule'>
               Detail
            </a>
        </td>
    </tr>";
}

