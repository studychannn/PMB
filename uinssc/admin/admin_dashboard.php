<?php
$pageTitle = 'Admin Dashboard - PMB UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_admin();

$totalUsers = $pdo ? (int) $pdo->query('SELECT COUNT(*) FROM users WHERE role = "calon_mahasiswa"')->fetchColumn() : 0;
$totalRegistrations = $pdo ? (int) $pdo->query('SELECT COUNT(*) FROM pendaftaran')->fetchColumn() : 0;
$pendingDocuments = $pdo ? (int) $pdo->query('SELECT COUNT(*) FROM dokumen_pendaftaran WHERE status = "menunggu"')->fetchColumn() : 0;
$completedSelections = $pdo ? (int) $pdo->query('SELECT COUNT(*) FROM pendaftaran WHERE status_seleksi = "lulus"')->fetchColumn() : 0;

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Admin PMB</p>
      <h1>Panel admin pendaftaran</h1>
      <p>Lihat ringkasan peserta, verifikasi data, dan kelola hasil seleksi.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="info-card">
            <span>Peserta</span>
            <h3><?= $totalUsers ?></h3>
            <p>Total calon mahasiswa terdaftar.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <span>Pendaftaran</span>
            <h3><?= $totalRegistrations ?></h3>
            <p>Data pendaftaran yang sudah diisi oleh peserta.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <span>Dokumen</span>
            <h3><?= $pendingDocuments ?></h3>
            <p>Dokumen yang masih menunggu verifikasi.</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <span>Seleksi</span>
            <h3><?= $completedSelections ?></h3>
            <p>Peserta yang sudah dinyatakan lulus.</p>
          </div>
        </div>
      </div>

      <div class="mt-4 d-flex flex-wrap gap-2">
        <a class="btn btn-brand" href="admin_peserta.php">Kelola Peserta</a>
        <a class="btn btn-outline-success" href="kontak_pesan.php">Pesan Kontak</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
