<?php
$pageTitle = 'Jalur Masuk - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'jalur';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/db.php';

$jalurList = $jalurMasuk;
if ($pdo) {
  $stmt = $pdo->query("SELECT kode, nama AS judul, deskripsi FROM jalur_masuk WHERE status = 'aktif' ORDER BY id ASC");
  $rows = $stmt->fetchAll();
  if ($rows) {
    $jalurList = $rows;
  }
}

require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Jalur Masuk</p>
      <h1>Pilih jalur seleksi yang paling sesuai</h1>
      <p>Informasi jalur seleksi membantu kamu menentukan cara masuk paling cocok.</p>
    </div>
  </section>

  <section class="section-pad soft-section">
    <div class="container">
      <div class="row g-3">
        <?php foreach ($jalurList as $jalur) { ?>
          <div class="col-md-6 col-lg-3">
            <div class="info-card">
              <span><?= htmlspecialchars($jalur['kode']) ?></span>
              <h3><?= htmlspecialchars($jalur['judul']) ?></h3>
              <p><?= htmlspecialchars($jalur['deskripsi']) ?></p>
              <a href="kontak.php">Tanya admin</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
