-- Schema only. Original data rows are excluded.

CREATE TABLE `file_soal` (
  `id_soal` varchar(6) NOT NULL,
  `id_jadwal` int(6) NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `nama_file` varchar(150) NOT NULL,
  `waktu_unggah` timestamp NOT NULL DEFAULT current_timestamp(),
  `path_file` varchar(100) NOT NULL,
  `tipe_file` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `jadwal_ulangan` (
  `id_jadwal` int(6) NOT NULL,
  `id_soal` varchar(6) NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(40) NOT NULL,
  `status_pekerjaan` enum('not_started','in_progress','completed') DEFAULT NULL,
  `detail_ulangan` varchar(200) DEFAULT NULL,
  `tanggal_ulangan` date DEFAULT NULL,
  `sekolah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `log_perubahan` (
  `id_perubahan` int(11) NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `modul` varchar(50) NOT NULL,
  `aksi` enum('CREATE','UPDATE','DELETE') NOT NULL,
  `detail_perubahan` varchar(255) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `user_id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru') NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `file_soal`
  ADD PRIMARY KEY (`id_soal`);

ALTER TABLE `jadwal_ulangan`
  ADD PRIMARY KEY (`id_jadwal`);

ALTER TABLE `log_perubahan`
  ADD PRIMARY KEY (`id_perubahan`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `jadwal_ulangan`
  MODIFY `id_jadwal` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3362;

ALTER TABLE `log_perubahan`
  MODIFY `id_perubahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=539;