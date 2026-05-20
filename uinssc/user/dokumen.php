<?php
$pageTitle = 'Upload Dokumen - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_user();

$user = current_user();
$pendaftaran = get_pendaftaran($pdo, (int) $user['id']);
$dokumenList = get_dokumen_list($pdo, (int) $user['id']);
$labels = document_labels();
$successMessage = '';
$errorMessage = '';

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST') {
  $jenis = $_POST['jenis_dokumen'] ?? '';
  $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
  $maxSize = 2 * 1024 * 1024;

  if (!$pendaftaran) {
    $errorMessage = 'Isi biodata pendaftaran dulu sebelum upload dokumen.';
  } elseif (!isset($labels[$jenis])) {
    $errorMessage = 'Jenis dokumen tidak valid.';
  } elseif (!isset($_FILES['dokumen']) || $_FILES['dokumen']['error'] !== UPLOAD_ERR_OK) {
    $errorMessage = 'File dokumen wajib dipilih.';
  } elseif ($_FILES['dokumen']['size'] > $maxSize) {
    $errorMessage = 'Ukuran file maksimal 2 MB.';
  } else {
    $tmpPath = $_FILES['dokumen']['tmp_name'];
    $mimeType = mime_content_type($tmpPath);

    if (!in_array($mimeType, $allowedTypes, true)) {
      $errorMessage = 'Format file harus PDF, JPG, atau PNG.';
    } elseif (!$pdo) {
      $errorMessage = $dbError ?? 'Database belum tersambung.';
    } else {
      $extension = pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION);
      $safeName = $user['id'] . '-' . $jenis . '-' . time() . '.' . strtolower($extension);
      $relativePath = 'uploads/dokumen/' . $safeName;
      $targetPath = __DIR__ . '/../' . $relativePath;

      if (!move_uploaded_file($tmpPath, $targetPath)) {
        $errorMessage = 'File gagal diupload. Cek izin folder uploads/dokumen.';
      } else {
        $stmt = $pdo->prepare('INSERT INTO dokumen_pendaftaran (user_id, jenis_dokumen, nama_file, path_file, status) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE nama_file = VALUES(nama_file), path_file = VALUES(path_file), status = VALUES(status), catatan = NULL, uploaded_at = CURRENT_TIMESTAMP');
        $stmt->execute([$user['id'], $jenis, $_FILES['dokumen']['name'], $relativePath, 'menunggu']);

        $pdo->prepare("UPDATE pendaftaran SET status_berkas = 'menunggu' WHERE user_id = ?")->execute([$user['id']]);
        $successMessage = 'Dokumen berhasil diupload dan menunggu verifikasi.';
        $dokumenList = get_dokumen_list($pdo, (int) $user['id']);
        $pendaftaran = get_pendaftaran($pdo, (int) $user['id']);
      }
    }
  }
}

$dokumenByType = [];
foreach ($dokumenList as $dokumen) {
  $dokumenByType[$dokumen['jenis_dokumen']] = $dokumen;
}

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Seleksi Berkas</p>
      <h1>Upload dokumen persyaratan</h1>
      <p>Unggah file PDF, JPG, atau PNG. Setiap jenis dokumen bisa diperbarui jika ada revisi.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if (!$pendaftaran) { ?>
        <div class="alert alert-info">Kamu belum mengisi biodata. <a href="pendaftaran.php">Isi biodata dulu</a> sebelum upload dokumen.</div>
      <?php } ?>

      <div class="row g-4">
        <div class="col-lg-5">
          <form class="contact-form" method="post" action="dokumen.php" enctype="multipart/form-data">
            <?php if ($successMessage) { ?><div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div><?php } ?>
            <?php if ($errorMessage) { ?><div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div><?php } ?>

            <div class="mb-3">
              <label class="form-label" for="jenis_dokumen">Jenis dokumen</label>
              <select class="form-control" id="jenis_dokumen" name="jenis_dokumen" required>
                <option value="">Pilih dokumen</option>
                <?php foreach ($labels as $value => $label) { ?>
                  <option value="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($label) ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="dokumen">File dokumen</label>
              <input class="form-control" type="file" id="dokumen" name="dokumen" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <p class="form-hint">Maksimal 2 MB. Format: PDF, JPG, PNG.</p>
            <button class="btn btn-brand" type="submit" <?= !$pendaftaran ? 'disabled' : '' ?>>Upload Dokumen</button>
          </form>
        </div>
        <div class="col-lg-7">
          <div class="status-panel">
            <h2>Daftar dokumen</h2>
            <div class="document-list">
              <?php foreach ($labels as $value => $label) {
                $item = $dokumenByType[$value] ?? null;
              ?>
                <div class="document-item">
                  <div>
                    <strong><?= htmlspecialchars($label) ?></strong>
                    <small><?= $item ? htmlspecialchars($item['nama_file']) : 'Belum diupload' ?></small>
                  </div>
                  <span class="status-badge <?= $item ? 'status-' . htmlspecialchars($item['status']) : 'status-empty' ?>">
                    <?= $item ? htmlspecialchars(status_label($item['status'])) : 'Kosong' ?>
                  </span>
                </div>
              <?php } ?>
            </div>
            <a class="btn btn-outline-success mt-4" href="status.php">Lihat Status Pendaftaran</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
