-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2026 at 05:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uinssc_pmb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`, `created_at`) VALUES
(1, 'Administrator', 'admin@uinssc.ac.id', '$2y$10$6XWFlJlHBmuiiQV6Bzc1fuGNidy6bGbpPTHKLDKaYGN3Qb4F3X32e', '2026-05-20 03:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `alur_pmb`
--

CREATE TABLE `alur_pmb` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `judul` varchar(120) NOT NULL,
  `deskripsi` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alur_pmb`
--

INSERT INTO `alur_pmb` (`id`, `nomor`, `judul`, `deskripsi`, `link`, `created_at`) VALUES
(1, 1, 'Pendaftaran Online', 'Calon mahasiswa mengisi formulir, memilih jalur masuk, dan mengunggah dokumen persyaratan.', 'https://ciu.uinssc.ac.id/', '2026-05-20 01:30:21'),
(2, 2, 'Seleksi Berkas', 'Panitia memeriksa kelengkapan dokumen, kesesuaian data, dan syarat khusus tiap jalur.', 'jadwal.php', '2026-05-20 01:30:21'),
(3, 3, 'Ujian Masuk', 'Peserta mengikuti tes tertulis, wawancara, portofolio, atau asesmen online sesuai ketentuan.', 'jalur.php', '2026-05-20 01:30:21'),
(4, 4, 'Pengumuman Hasil', 'Peserta mengecek status kelulusan melalui laman resmi dan membaca instruksi lanjutan.', 'user/pengumuman.php', '2026-05-20 01:30:21'),
(5, 5, 'Daftar Ulang & Pembayaran', 'Mahasiswa yang lolos melengkapi data final, membayar biaya pendidikan, dan menerima informasi akademik awal.', 'user/daftar_ulang.php', '2026-05-20 01:30:21'),
(6, 6, 'Ospek Kampus', 'Mahasiswa baru mengikuti pengenalan budaya akademik, layanan kampus, dan komunitas mahasiswa.', 'user/ospek.php', '2026-05-20 01:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_pendaftaran`
--

CREATE TABLE `dokumen_pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_dokumen` enum('foto','ijazah_skl','ktp_kk','rapor','prestasi') NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `status` enum('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pmb`
--

CREATE TABLE `jadwal_pmb` (
  `id` int(11) NOT NULL,
  `tahap` varchar(100) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_pmb`
--

INSERT INTO `jadwal_pmb` (`id`, `tahap`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`) VALUES
(1, 'Pembukaan Pendaftaran', NULL, NULL, 'Formulir online mulai dapat diisi oleh calon mahasiswa.', '2026-05-20 01:30:21'),
(2, 'Verifikasi Berkas', NULL, NULL, 'Panitia memeriksa dokumen dan menghubungi peserta bila ada data yang perlu diperbaiki.', '2026-05-20 01:30:21'),
(3, 'Ujian & Seleksi', NULL, NULL, 'Peserta mengikuti asesmen sesuai jalur penerimaan yang dipilih.', '2026-05-20 01:30:21'),
(4, 'Pengumuman & Daftar Ulang', NULL, NULL, 'Peserta yang lolos menyelesaikan pembayaran dan validasi data akhir.', '2026-05-20 01:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `jalur_masuk`
--

CREATE TABLE `jalur_masuk` (
  `id` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jalur_masuk`
--

INSERT INTO `jalur_masuk` (`id`, `kode`, `nama`, `deskripsi`, `status`, `created_at`) VALUES
(1, 'SNBP', 'Seleksi Prestasi', 'Untuk calon mahasiswa dengan rekam akademik dan prestasi unggul.', 'aktif', '2026-05-20 01:30:21'),
(2, 'SNBT', 'Seleksi Tes', 'Jalur berbasis hasil ujian dan ketentuan penerimaan nasional.', 'aktif', '2026-05-20 01:30:21'),
(3, 'SPAN-PTKIN', 'Prestasi PTKIN', 'Seleksi prestasi untuk perguruan tinggi keagamaan Islam negeri.', 'aktif', '2026-05-20 01:30:21'),
(4, 'UM-PTKIN', 'Ujian PTKIN', 'Jalur ujian masuk bersama perguruan tinggi keagamaan Islam negeri.', 'aktif', '2026-05-20 01:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_pesan`
--

CREATE TABLE `kontak_pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(160) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `jalur_pilihan` varchar(60) NOT NULL,
  `prodi_pilihan` varchar(120) NOT NULL,
  `status_berkas` enum('belum_dikirim','menunggu','diterima','ditolak') NOT NULL DEFAULT 'belum_dikirim',
  `status_seleksi` enum('belum_diproses','lulus','tidak_lulus') NOT NULL DEFAULT 'belum_diproses',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `email` varchar(160) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('calon_mahasiswa','admin') NOT NULL DEFAULT 'calon_mahasiswa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(3, 'chantika maharani', 'chantika@gmail.com', '$2y$10$Rhybuji3DhEFpUI7Hno5zuwLM9CmJXInIGlGUu0CBcfws6NZ8ZX1e', 'calon_mahasiswa', '2026-05-20 01:51:55'),
(4, 'Admin', 'admin@gmail.com', '$2y$10$OSaDmemeHQwqjGFWCyMElu2g6q1Zv4AKamNfFM1Jvdg9svt6XW4oK', 'admin', '2026-05-20 02:35:16'),
(5, 'Admin', 'admin@example.com', '$2y$10$oNWdGK8HN3IvbPI7PIk8x.QAlkQalYhMhbOhtlkLTxlwC/0zlZQqC', 'admin', '2026-05-20 02:35:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `alur_pmb`
--
ALTER TABLE `alur_pmb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_nomor` (`nomor`);

--
-- Indexes for table `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_dokumen` (`user_id`,`jenis_dokumen`);

--
-- Indexes for table `jadwal_pmb`
--
ALTER TABLE `jadwal_pmb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tahap` (`tahap`);

--
-- Indexes for table `jalur_masuk`
--
ALTER TABLE `jalur_masuk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_kode` (`kode`);

--
-- Indexes for table `kontak_pesan`
--
ALTER TABLE `kontak_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alur_pmb`
--
ALTER TABLE `alur_pmb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_pmb`
--
ALTER TABLE `jadwal_pmb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jalur_masuk`
--
ALTER TABLE `jalur_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kontak_pesan`
--
ALTER TABLE `kontak_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_pendaftaran`
--
ALTER TABLE `dokumen_pendaftaran`
  ADD CONSTRAINT `fk_dokumen_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_pendaftaran_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
