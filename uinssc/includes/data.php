<?php
$alurPmb = [
  [
    'nomor' => '1',
    'judul' => 'Pendaftaran Online',
    'deskripsi' => 'Calon mahasiswa mengisi formulir, memilih jalur masuk, dan mengunggah dokumen persyaratan.',
    'kelas' => 'panel-register',
    'visual' => 'mini-screen',
    'link' => 'https://ciu.uinssc.ac.id/',
    'label' => 'Akses pendaftaran',
    'external' => true,
  ],
  [
    'nomor' => '2',
    'judul' => 'Seleksi Berkas',
    'deskripsi' => 'Panitia memeriksa kelengkapan dokumen, kesesuaian data, dan syarat khusus tiap jalur.',
    'kelas' => 'panel-review',
    'visual' => 'doc-stack',
    'link' => 'jadwal.php',
    'label' => 'Lihat jadwal',
    'external' => false,
  ],
  [
    'nomor' => '3',
    'judul' => 'Ujian Masuk',
    'deskripsi' => 'Peserta mengikuti tes tertulis, wawancara, portofolio, atau asesmen online sesuai ketentuan.',
    'kelas' => 'panel-exam',
    'visual' => 'exam-room',
    'link' => 'jalur.php',
    'label' => 'Cek jalur seleksi',
    'external' => false,
  ],
  [
    'nomor' => '4',
    'judul' => 'Pengumuman Hasil',
    'deskripsi' => 'Peserta mengecek status kelulusan melalui laman resmi dan membaca instruksi lanjutan.',
    'kelas' => 'panel-result',
    'visual' => 'phone-result',
    'link' => 'user/pengumuman.php',
    'label' => 'Lihat pengumuman',
    'external' => false,
  ],
  [
    'nomor' => '5',
    'judul' => 'Daftar Ulang & Pembayaran',
    'deskripsi' => 'Mahasiswa yang lolos melengkapi data final, membayar biaya pendidikan, dan menerima informasi akademik awal.',
    'kelas' => 'panel-payment',
    'visual' => 'payment-line',
    'link' => 'user/daftar_ulang.php',
    'label' => 'Selesaikan daftar ulang',
    'external' => false,
    'wide' => true,
  ],
  [
    'nomor' => '6',
    'judul' => 'Ospek Kampus',
    'deskripsi' => 'Mahasiswa baru mengikuti pengenalan budaya akademik, layanan kampus, dan komunitas mahasiswa.',
    'kelas' => 'panel-ospek',
    'visual' => 'student-row',
    'link' => 'user/ospek.php',
    'label' => 'Info ospek',
    'external' => false,
  ],
];

$jalurMasuk = [
  ['kode' => 'SNBP', 'judul' => 'Seleksi Prestasi', 'deskripsi' => 'Untuk calon mahasiswa dengan rekam akademik dan prestasi unggul.'],
  ['kode' => 'SNBT', 'judul' => 'Seleksi Tes', 'deskripsi' => 'Jalur berbasis hasil ujian dan ketentuan penerimaan nasional.'],
  ['kode' => 'SPAN-PTKIN', 'judul' => 'Prestasi PTKIN', 'deskripsi' => 'Seleksi prestasi untuk perguruan tinggi keagamaan Islam negeri.'],
  ['kode' => 'UM-PTKIN', 'judul' => 'Ujian PTKIN', 'deskripsi' => 'Jalur ujian masuk bersama perguruan tinggi keagamaan Islam negeri.'],
];

$jadwalPmb = [
  ['nomor' => '01', 'judul' => 'Pembukaan Pendaftaran', 'deskripsi' => 'Formulir online mulai dapat diisi oleh calon mahasiswa.'],
  ['nomor' => '02', 'judul' => 'Verifikasi Berkas', 'deskripsi' => 'Panitia memeriksa dokumen dan menghubungi peserta bila ada data yang perlu diperbaiki.'],
  ['nomor' => '03', 'judul' => 'Ujian & Seleksi', 'deskripsi' => 'Peserta mengikuti asesmen sesuai jalur penerimaan yang dipilih.'],
  ['nomor' => '04', 'judul' => 'Pengumuman & Daftar Ulang', 'deskripsi' => 'Peserta yang lolos menyelesaikan pembayaran dan validasi data akhir.'],
];
