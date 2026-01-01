# Sistem Informasi Manajemen Masjid Riyadhis

## Ringkasan
Aplikasi web manajemen operasional dan keuangan masjid berbasis PHP (procedural) yang menyediakan dashboard untuk peran: admin, ketua, petugas, dan user. Fitur utama meliputi pencatatan pembayaran/transfer, pengeluaran, agenda, laporan, dan backup/restore database.

## Fitur
- Otentikasi multi-peran: admin, ketua, petugas, user (file: proses-login-*.php, register.php)
- Manajemen data: user, petugas, ketua, kategori (folder: admin/, ketua/, petugas/ — contents/ & library/)
- Keuangan: input pembayaran, transfer, pengeluaran, laporan keuangan (tambah-pembayaran.php, tambah-transfer.php, petugas/contents/)
- Agenda & album foto (petugas/contents/agenda.php, album.php)
- Backup & restore database (admin/contents/backupdata, ketua/contents/backupdata, petugas/contents/backupdata)
- Export/print laporan via FPDF (library/fpdf17/)
- UI: Bootstrap, jQuery, DataTables dan plugin lain (assets/)

## Teknologi yang digunakan
- PHP (procedural, mixed PHP + HTML)
- MySQL (SQL dumps: db_masjid.sql, admin/..., ketua/..., petugas/...)
- FPDF (library/fpdf17/)
- Frontend: Bootstrap, jQuery, DataTables, plugin dalam assets/
- Recommended dev stack: XAMPP (Apache + MySQL)

## Tujuan Pengembangan
Mempermudah pencatatan dan pelaporan administrasi serta keuangan masjid: menyederhanakan pengelolaan donasi/pembayaran, pengeluaran, jadwal kegiatan, serta memudahkan pembuatan laporan dan backup data.

## Dibuat oleh
- Nama : Muhammad Dimyathi
- Tahun : 2025

## Catatan (penting untuk developer)
- Menjalankan lokal:
  1. Letakkan repo di C:\xampp\htdocs\SistemInformasiManajemenMasjidRiyadhis
  2. Start Apache & MySQL lewat XAMPP Control Panel
  3. Import schema: gunakan db_masjid.sql (atau file SQL dalam admin/ketua/petugas/) melalui phpMyAdmin
  4. Sesuaikan koneksi DB di: koneksidb.php (root) dan admin/koneksidb.php (jika ada)
  5. Buka: http://localhost/SistemInformasiManajemenMasjidRiyadhis/

- Struktur penting:
  - koneksidb.php, config.php — konfigurasi DB dan dasar aplikasi
  - admin/, ketua/, petugas/ — area ber-peran dengan contents/ (UI) dan library/ (aksi)
  - library/ — fungsi backend bersama dan file proses (tambah-*, proses-*)
  - assets/ — CSS/JS/images dan plugin pihak ketiga
  - library/fpdf17/ — generator PDF

