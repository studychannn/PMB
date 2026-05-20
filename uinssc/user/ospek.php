<?php
$pageTitle = 'Ospek Kampus - UIN Siber Syekh Nurjati Cirebon';
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
      <p class="eyebrow">Orientasi Mahasiswa Baru</p>
      <h1>Informasi Ospek dan pengenalan kampus</h1>
      <p>Ospek adalah tahap akhir sebelum kamu resmi menjadi bagian dari UIN Siber Syekh Nurjati.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if (!$pendaftaran) { ?>
        <div class="alert alert-info">Kamu belum mengisi biodata. <a href="pendaftaran.php">Isi biodata sekarang</a> agar bisa mengikuti proses selanjutnya.</div>
      <?php } else { ?>
        <div class="content-block mb-4">
          <h2>Apa itu Ospek?</h2>
          <p>Ospek adalah orientasi mahasiswa baru yang memperkenalkan budaya akademik, fasilitas kampus, dan layanan kemahasiswaan.</p>
        </div>

        <?php if ($pendaftaran['status_seleksi'] === 'lulus') { ?>
          <div class="alert alert-success">
            Persiapan Ospek sudah bisa dimulai. Pastikan kamu sudah menyelesaikan daftar ulang sebelum mengikuti Ospek.
          </div>
          <div class="content-block mb-4">
            <h3>Agenda Ospek</h3>
            <ul>
              <li>Pengenalan struktur kampus dan civitas akademika.</li>
              <li>Pemaparan tata tertib akademik dan fasilitas.</li>
              <li>Sharing komunitas mahasiswa dan layanan kemahasiswaan.</li>
              <li>Registrasi dan informasi pelaksanaan kegiatan kampus.</li>
            </ul>
          </div>
          <div class="content-block">
            <h3>Persiapan yang disarankan</h3>
            <ul>
              <li>Siapkan identitas diri dan bukti daftar ulang.</li>
              <li>Periksa jadwal resmi di portal kampus atau hubungi panitia.</li>
              <li>Catat informasi kontak pendamping dan sesama mahasiswa baru.</li>
            </ul>
          </div>
        <?php } else { ?>
          <div class="alert alert-warning">
            Pengumuman hasil seleksi kamu belum lulus atau belum tersedia. Ospek akan diumumkan setelah pendaftaran dan daftar ulang selesai.
          </div>
          <p>Silakan cek kembali status seleksi di <a href="pengumuman.php">Pengumuman Hasil</a> atau <a href="status.php">Status Pendaftaran</a>.</p>
        <?php } ?>
      <?php } ?>

      <div class="mt-4">
        <a class="btn btn-brand" href="pengumuman.php">Pengumuman Hasil</a>
        <a class="btn btn-outline-success" href="dashboard.php">Dashboard</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
