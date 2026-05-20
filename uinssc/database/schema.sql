CREATE DATABASE IF NOT EXISTS uinssc_pmb
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE uinssc_pmb;

CREATE TABLE IF NOT EXISTS jalur_masuk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(30) NOT NULL,
  nama VARCHAR(100) NOT NULL,
  deskripsi TEXT NOT NULL,
  status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
  UNIQUE KEY unique_kode (kode),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS jadwal_pmb (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tahap VARCHAR(100) NOT NULL,
  tanggal_mulai DATE NULL,
  tanggal_selesai DATE NULL,
  keterangan TEXT NOT NULL,
  UNIQUE KEY unique_tahap (tahap),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS alur_pmb (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nomor INT NOT NULL,
  judul VARCHAR(120) NOT NULL,
  deskripsi TEXT NOT NULL,
  link VARCHAR(255) NULL,
  UNIQUE KEY unique_nomor (nomor),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS kontak_pesan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL,
  pesan TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(191) NOT NULL,
  email VARCHAR(191) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('calon_mahasiswa', 'admin') NOT NULL DEFAULT 'calon_mahasiswa',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pendaftaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  nik VARCHAR(30) NOT NULL,
  tempat_lahir VARCHAR(100) NOT NULL,
  tanggal_lahir DATE NOT NULL,
  jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
  no_hp VARCHAR(30) NOT NULL,
  alamat TEXT NOT NULL,
  asal_sekolah VARCHAR(160) NOT NULL,
  tahun_lulus YEAR NOT NULL,
  jalur_pilihan VARCHAR(60) NOT NULL,
  prodi_pilihan VARCHAR(120) NOT NULL,
  status_berkas ENUM('belum_dikirim', 'menunggu', 'diterima', 'ditolak') NOT NULL DEFAULT 'belum_dikirim',
  status_seleksi ENUM('belum_diproses', 'lulus', 'tidak_lulus') NOT NULL DEFAULT 'belum_diproses',
  catatan TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_pendaftaran_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS dokumen_pendaftaran (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  jenis_dokumen ENUM('foto', 'ijazah_skl', 'ktp_kk', 'rapor', 'prestasi') NOT NULL,
  nama_file VARCHAR(255) NOT NULL,
  path_file VARCHAR(255) NOT NULL,
  status ENUM('menunggu', 'diterima', 'ditolak') NOT NULL DEFAULT 'menunggu',
  catatan TEXT NULL,
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_user_dokumen (user_id, jenis_dokumen),
  CONSTRAINT fk_dokumen_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT IGNORE INTO jalur_masuk (kode, nama, deskripsi) VALUES
('SNBP', 'Seleksi Prestasi', 'Untuk calon mahasiswa dengan rekam akademik dan prestasi unggul.'),
('SNBT', 'Seleksi Tes', 'Jalur berbasis hasil ujian dan ketentuan penerimaan nasional.'),
('SPAN-PTKIN', 'Prestasi PTKIN', 'Seleksi prestasi untuk perguruan tinggi keagamaan Islam negeri.'),
('UM-PTKIN', 'Ujian PTKIN', 'Jalur ujian masuk bersama perguruan tinggi keagamaan Islam negeri.');

INSERT IGNORE INTO jadwal_pmb (tahap, tanggal_mulai, tanggal_selesai, keterangan) VALUES
('Pembukaan Pendaftaran', NULL, NULL, 'Formulir online mulai dapat diisi oleh calon mahasiswa.'),
('Verifikasi Berkas', NULL, NULL, 'Panitia memeriksa dokumen dan menghubungi peserta bila ada data yang perlu diperbaiki.'),
('Ujian & Seleksi', NULL, NULL, 'Peserta mengikuti asesmen sesuai jalur penerimaan yang dipilih.'),
('Pengumuman & Daftar Ulang', NULL, NULL, 'Peserta yang lolos menyelesaikan pembayaran dan validasi data akhir.');

INSERT IGNORE INTO alur_pmb (nomor, judul, deskripsi, link) VALUES
(1, 'Pendaftaran Online', 'Calon mahasiswa mengisi formulir, memilih jalur masuk, dan mengunggah dokumen persyaratan.', 'https://ciu.uinssc.ac.id/'),
(2, 'Seleksi Berkas', 'Panitia memeriksa kelengkapan dokumen, kesesuaian data, dan syarat khusus tiap jalur.', 'jadwal.php'),
(3, 'Ujian Masuk', 'Peserta mengikuti tes tertulis, wawancara, portofolio, atau asesmen online sesuai ketentuan.', 'jalur.php'),
(4, 'Pengumuman Hasil', 'Peserta mengecek status kelulusan melalui laman resmi dan membaca instruksi lanjutan.', 'user/pengumuman.php'),
(5, 'Daftar Ulang & Pembayaran', 'Mahasiswa yang lolos melengkapi data final, membayar biaya pendidikan, dan menerima informasi akademik awal.', 'user/daftar_ulang.php'),
(6, 'Ospek Kampus', 'Mahasiswa baru mengikuti pengenalan budaya akademik, layanan kampus, dan komunitas mahasiswa.', 'user/ospek.php');

-- Akun admin default (password: admin123)
-- Ganti password setelah pertama kali login!
INSERT IGNORE INTO admins (nama, email, password) VALUES
('Administrator', 'admin@uinssc.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
