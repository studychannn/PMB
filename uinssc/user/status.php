<?php
$pageTitle = 'Status Pendaftaran - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_user();

$user = current_user();
$pendaftaran = get_pendaftaran($pdo, (int) $user['id']);
$dokumenList = get_dokumen_list($pdo, (int) $user['id']);
$labels = document_labels();
$uploadedCount = count($dokumenList);
$totalDocs = count($labels);
$daftarUlangDone = $pendaftaran && $pendaftaran['status_seleksi'] === 'lulus';
$ospekReady = $daftarUlangDone;

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Status Pendaftaran</p>
      <h1>Pantau progres PMB kamu</h1>
      <p>Periksa status biodata, dokumen, verifikasi berkas, dan hasil seleksi di satu tempat.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="status-panel mb-4">
        <h2>Ringkasan peserta</h2>
        <?php if ($pendaftaran) { ?>
          <div class="row g-3">
            <div class="col-md-4"><strong>Nama</strong><p><?= htmlspecialchars($user['nama']) ?></p></div>
            <div class="col-md-4"><strong>Jalur</strong><p><?= htmlspecialchars($pendaftaran['jalur_pilihan']) ?></p></div>
            <div class="col-md-4"><strong>Program Studi</strong><p><?= htmlspecialchars($pendaftaran['prodi_pilihan']) ?></p></div>
          </div>
        <?php } else { ?>
          <p class="mb-0">Biodata belum diisi. <a href="pendaftaran.php">Lengkapi biodata sekarang</a>.</p>
        <?php } ?>
      </div>

      <div class="progress-steps">
        <div class="progress-step <?= $pendaftaran ? 'done' : '' ?>">
          <span>1</span>
          <h3>Biodata</h3>
          <p><?= $pendaftaran ? 'Sudah lengkap' : 'Belum diisi' ?></p>
        </div>
        <div class="progress-step <?= $uploadedCount > 0 ? 'done' : '' ?>">
          <span>2</span>
          <h3>Upload Dokumen</h3>
          <p><?= $uploadedCount ?> dari <?= $totalDocs ?> dokumen</p>
        </div>
        <div class="progress-step <?= $pendaftaran && $pendaftaran['status_berkas'] === 'diterima' ? 'done' : '' ?>">
          <span>3</span>
          <h3>Verifikasi Berkas</h3>
          <p><?= $pendaftaran ? htmlspecialchars(status_label($pendaftaran['status_berkas'])) : 'Belum diproses' ?></p>
        </div>
        <div class="progress-step <?= $pendaftaran && $pendaftaran['status_seleksi'] === 'lulus' ? 'done' : '' ?>">
          <span>4</span>
          <h3>Hasil Seleksi</h3>
          <p><?= $pendaftaran ? htmlspecialchars(status_label($pendaftaran['status_seleksi'])) : 'Belum diproses' ?></p>
        </div>
        <div class="progress-step <?= $daftarUlangDone ? 'done' : '' ?>">
          <span>5</span>
          <h3>Daftar Ulang</h3>
          <p><?= $daftarUlangDone ? 'Lengkap & Siap' : 'Menunggu lulus' ?></p>
        </div>
        <div class="progress-step <?= $ospekReady ? 'done' : '' ?>">
          <span>6</span>
          <h3>Ospek</h3>
          <p><?= $ospekReady ? 'Informasi tersedia' : 'Belum tersedia' ?></p>
        </div>
      </div>

      <div class="d-flex flex-wrap gap-2 mt-4">
        <a class="btn btn-brand" href="pendaftaran.php">Edit Biodata</a>
        <a class="btn btn-outline-success" href="dokumen.php">Upload Dokumen</a>
        <a class="btn btn-outline-success" href="pengumuman.php">Pengumuman Hasil</a>
        <a class="btn btn-outline-success" href="daftar_ulang.php">Daftar Ulang</a>
        <a class="btn btn-outline-success" href="ospek.php">Ospek Kampus</a>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
