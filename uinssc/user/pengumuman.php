<?php
$pageTitle = 'Pengumuman Hasil - UIN Siber Syekh Nurjati Cirebon';
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
      <p class="eyebrow">Pengumuman Hasil</p>
      <h1>Status seleksi pendaftaran kamu</h1>
      <p>Lihat hasil seleksi langsung dan tahu langkah berikutnya.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if (!$pendaftaran) { ?>
        <div class="alert alert-info">Kamu belum mengisi biodata pendaftaran. <a href="pendaftaran.php">Isi biodata sekarang</a> untuk mulai proses pendaftaran.</div>
      <?php } else { ?>
        <div class="status-panel mb-4">
          <h2>Ringkasan pendaftaran</h2>
          <div class="row g-3">
            <div class="col-md-4"><strong>Nama</strong><p><?= htmlspecialchars($user['nama']) ?></p></div>
            <div class="col-md-4"><strong>Jalur</strong><p><?= htmlspecialchars($pendaftaran['jalur_pilihan']) ?></p></div>
            <div class="col-md-4"><strong>Program Studi</strong><p><?= htmlspecialchars($pendaftaran['prodi_pilihan']) ?></p></div>
          </div>
        </div>

        <?php if ($pendaftaran['status_seleksi'] === 'lulus') { ?>
          <div class="alert alert-success">
            Selamat! Kamu dinyatakan <strong>LULUS</strong> seleksi. Silakan lanjut ke proses daftar ulang dan pembayaran.
          </div>
          <div class="content-block">
            <h3>Langkah selanjutnya</h3>
            <ul>
              <li>Cetak atau simpan bukti pengumuman ini.</li>
              <li>Siapkan dokumen dan pembayaran daftar ulang.</li>
              <li>Selanjutnya, buka halaman <a href="daftar_ulang.php">Daftar Ulang & Pembayaran</a>.</li>
              <li>Setelah daftar ulang, lihat informasi orientasi pada <a href="ospek.php">Ospek Kampus</a>.</li>
            </ul>
          </div>
        <?php } elseif ($pendaftaran['status_seleksi'] === 'tidak_lulus') { ?>
          <div class="alert alert-warning">
            Mohon maaf, saat ini kamu dinyatakan <strong>TIDAK LULUS</strong> seleksi. Terus semangat untuk kesempatan berikutnya.
          </div>
          <div class="content-block">
            <h3>Rekomendasi</h3>
            <p>Periksa kembali kabar resmi dari panitia dan pertimbangkan jalur penerimaan lain jika tersedia.</p>
            <p>Butuh bantuan? <a href="../kontak.php">Hubungi tim PMB</a> untuk informasi lebih lanjut.</p>
          </div>
        <?php } else { ?>
          <div class="alert alert-info">
            Hasil seleksi masih <strong>belum diproses</strong>. Silakan cek kembali setelah panitia melakukan verifikasi dan pengumuman.
          </div>
          <div class="content-block">
            <h3>Apa yang bisa kamu lakukan</h3>
            <ul>
              <li>Pastikan biodata sudah lengkap di <a href="pendaftaran.php">Biodata Pendaftaran</a>.</li>
              <li>Pastikan semua dokumen sudah terunggah di <a href="dokumen.php">Upload Dokumen</a>.</li>
              <li>Jika sudah, pantau halaman <a href="status.php">Status Pendaftaran</a>.</li>
            </ul>
          </div>
        <?php } ?>
      <?php } ?>

      <div class="mt-4">
        <a class="btn btn-brand" href="status.php">Kembali ke Status</a>
        <a class="btn btn-outline-success" href="dashboard.php">Dashboard</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
