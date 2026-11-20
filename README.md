# EduSched — Sistem Informasi Penjadwalan Ulangan

Proyek ini dikembangkan sebagai tugas mata kuliah **Analisis dan Perancangan Sistem Informasi (APSI), Semester 3**. EduSched merupakan aplikasi web untuk membantu pengelolaan jadwal ulangan dan berkas soal pada lingkungan sekolah atau bimbingan belajar.

## Fitur utama

- Login dengan dua peran pengguna: **admin** dan **guru**.
- Pengelolaan jadwal berdasarkan sekolah, kelas, dan mata pelajaran.
- Pengaturan tanggal, deskripsi, dan status pekerjaan ulangan.
- Unggah serta pengelolaan berkas soal yang dikaitkan dengan jadwal.
- Riwayat perubahan dan aktivitas pengguna.
- Rekap aktivitas bulanan serta ekspor laporan PDF untuk admin.
- Pengelolaan akun pengguna oleh admin.

## Teknologi

- PHP native dengan MySQLi
- MySQL
- HTML, CSS, JavaScript, dan Bootstrap
- Dompdf untuk pembuatan laporan PDF

## Struktur repository

- `apsib/` — source code dan aset aplikasi.
- `apsib/database/schema.sql` — struktur tabel database tanpa data pengguna.
- `apsib/.env.example` — contoh konfigurasi database.
- `apsib/dompdf/` dan `apsib/lib/` — pustaka pendukung yang digunakan aplikasi.

Data hasil unggahan dan foto profil pribadi tidak disertakan dalam source tree. Dump SQL yang berisi data akun atau data pengguna juga tidak dipublikasikan; hanya struktur tabel yang disertakan.

## Menjalankan secara lokal

1. Siapkan PHP dengan ekstensi **mysqli** dan **fileinfo**, serta MySQL atau MariaDB.
2. Buat database bernama `edusched`, lalu impor `apsib/database/schema.sql`.
3. Salin `apsib/.env.example` menjadi `apsib/.env`, kemudian sesuaikan host, port, nama database, username, dan password MySQL.
4. Pastikan folder `apsib/uploads/` dan `apsib/img/` dapat ditulisi oleh web server. Folder upload sudah diberi aturan Apache untuk menolak eksekusi file skrip.
5. Jalankan server pengembangan dari folder repository:

   ```bash
   php -S 127.0.0.1:8000 -t apsib
   ```

6. Buka `http://127.0.0.1:8000/login.php`.

Database yang disertakan hanya berisi struktur tabel. **Belum ada akun demo**. Buat akun admin pertama secara manual setelah database dibuat. Hash password dapat dibuat melalui PHP:

```bash
php -r "echo password_hash('GANTI_DENGAN_PASSWORD_SENDIRI', PASSWORD_DEFAULT), PHP_EOL;"
```

Gunakan hasil hash tersebut saat menambahkan satu baris admin ke tabel `users`. Jangan menggunakan password contoh di atas sebagai password akun sebenarnya.

## Status dan batasan

Source code sudah dipisahkan dari arsip awal agar setiap file dapat dibaca langsung di GitHub. Pemeriksaan sintaks PHP dapat dijalankan melalui workflow repository.

Proyek ini masih merupakan **proyek akademik/portofolio**, bukan aplikasi yang siap dipasang di server publik. Sebelum digunakan untuk data nyata, masih perlu dilakukan pengujian integrasi dengan database, penguatan validasi unggahan file, perlindungan CSRF untuk seluruh aksi yang mengubah data, dan peninjauan query SQL di semua modul. Belum ada demo aplikasi yang di-host secara publik.
