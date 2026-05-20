<?php
$pageTitle = 'Daftar Ulang & Pembayaran - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_user();

$user = current_user();
$pendaftaran = get_pendaftaran($pdo, (int) $user['id']);

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Daftar Ulang & Pembayaran</p>
      <h1>Lengkapi tahap daftar ulang setelah lulus seleksi</h1>
      <p>Informasi ini membantu kamu menyelesaikan administrasi akhir sebagai calon mahasiswa.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if (!$pendaftaran) { ?>
        <div class="alert alert-info">Kamu belum mengisi biodata. <a href="pendaftaran.php">Isi biodata sekarang</a> untuk mulai proses pendaftaran.</div>
      <?php } elseif ($pendaftaran['status_seleksi'] !== 'lulus') { ?>
        <div class="alert alert-warning">
          Saat ini kamu belum dinyatakan lulus seleksi. Halaman daftar ulang hanya berlaku setelah pengumuman hasil lulus.
        </div>
        <p>Untuk saat ini, cek kembali status seleksi di <a href="pengumuman.php">Pengumuman Hasil</a> atau <a href="status.php">Status Pendaftaran</a>.</p>
      <?php } else { ?>
        <div class="alert alert-success">
          Selamat! Kamu berhak mengikuti tahapan daftar ulang dan pembayaran.
        </div>
        <div class="content-block mb-4">
          <h3>Checklist Daftar Ulang</h3>
          <ol>
            <li>Selesaikan pembayaran biaya daftar ulang sesuai petunjuk resmi kampus.</li>
            <li>Unggah bukti pembayaran jika diperlukan ke portal resmi.</li>
            <li>Catat jadwal validasi berkas dan konfirmasi dari panitia.</li>
            <li>Simpan bukti transfer dan dokumen penting untuk keperluan registrasi akhir.</li>
          </ol>
        </div>
        <div class="content-block mb-4">
          <h3>Langkah praktis</h3>
          <p>Untuk melakukan pembayaran daftar ulang, silakan gunakan portal resmi UIN SSC atau kontak tim PMB yang tersedia.</p>
          <ul>
            <li><strong>Portal resmi:</strong> <a href="https://ciu.uinssc.ac.id/" target="_blank" rel="noopener">https://ciu.uinssc.ac.id/</a></li>
            <li><strong>Kontak PMB:</strong> <a href="../kontak.php">Halaman Kontak</a></li>
          </ul>
        </div>
        <div class="content-block">
          <h3>Selanjutnya</h3>
          <p>Setelah menyelesaikan pembayaran daftar ulang, pelajari informasi orientasi di halaman <a href="ospek.php">Ospek Kampus</a>.</p>
        </div>
      <?php } ?>

      <div class="mt-4">
        <a class="btn btn-brand" href="pengumuman.php">Pengumuman Hasil</a>
        <a class="btn btn-outline-success" href="dashboard.php">Dashboard</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
