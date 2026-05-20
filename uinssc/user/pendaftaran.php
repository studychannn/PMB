<?php
$pageTitle = 'Biodata Pendaftaran - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_user();

$user = current_user();
$data = get_pendaftaran($pdo, (int) $user['id']);
$successMessage = '';
$errorMessage = '';

$form = [
  'nik' => $data['nik'] ?? '',
  'tempat_lahir' => $data['tempat_lahir'] ?? '',
  'tanggal_lahir' => $data['tanggal_lahir'] ?? '',
  'jenis_kelamin' => $data['jenis_kelamin'] ?? '',
  'no_hp' => $data['no_hp'] ?? '',
  'alamat' => $data['alamat'] ?? '',
  'asal_sekolah' => $data['asal_sekolah'] ?? '',
  'tahun_lulus' => $data['tahun_lulus'] ?? '',
  'jalur_pilihan' => $data['jalur_pilihan'] ?? '',
  'prodi_pilihan' => $data['prodi_pilihan'] ?? '',
];

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST') {
  foreach ($form as $key => $value) {
    $form[$key] = trim($_POST[$key] ?? '');
  }

  $requiredFields = ['nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'alamat', 'asal_sekolah', 'tahun_lulus', 'jalur_pilihan', 'prodi_pilihan'];
  foreach ($requiredFields as $field) {
    if ($form[$field] === '') {
      $errorMessage = 'Semua field biodata wajib diisi.';
      break;
    }
  }

  if (!$errorMessage && !$pdo) {
    $errorMessage = $dbError ?? 'Database belum tersambung.';
  }

  if (!$errorMessage) {
    if ($data) {
      $stmt = $pdo->prepare('UPDATE pendaftaran SET nik = ?, tempat_lahir = ?, tanggal_lahir = ?, jenis_kelamin = ?, no_hp = ?, alamat = ?, asal_sekolah = ?, tahun_lulus = ?, jalur_pilihan = ?, prodi_pilihan = ? WHERE user_id = ?');
      $stmt->execute([$form['nik'], $form['tempat_lahir'], $form['tanggal_lahir'], $form['jenis_kelamin'], $form['no_hp'], $form['alamat'], $form['asal_sekolah'], $form['tahun_lulus'], $form['jalur_pilihan'], $form['prodi_pilihan'], $user['id']]);
    } else {
      $stmt = $pdo->prepare('INSERT INTO pendaftaran (user_id, nik, tempat_lahir, tanggal_lahir, jenis_kelamin, no_hp, alamat, asal_sekolah, tahun_lulus, jalur_pilihan, prodi_pilihan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
      $stmt->execute([$user['id'], $form['nik'], $form['tempat_lahir'], $form['tanggal_lahir'], $form['jenis_kelamin'], $form['no_hp'], $form['alamat'], $form['asal_sekolah'], $form['tahun_lulus'], $form['jalur_pilihan'], $form['prodi_pilihan']]);
    }

    $successMessage = 'Biodata pendaftaran berhasil disimpan.';
    $data = get_pendaftaran($pdo, (int) $user['id']);
  }
}

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Pendaftaran Online</p>
      <h1>Lengkapi biodata calon mahasiswa</h1>
      <p>Data ini menjadi tahap awal sebelum upload dokumen dan verifikasi berkas.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <form class="contact-form app-form" method="post" action="pendaftaran.php">
        <?php if ($successMessage) { ?><div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div><?php } ?>
        <?php if ($errorMessage) { ?><div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div><?php } ?>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="nik">NIK</label>
            <input class="form-control" type="text" id="nik" name="nik" value="<?= htmlspecialchars($form['nik']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="no_hp">Nomor HP</label>
            <input class="form-control" type="text" id="no_hp" name="no_hp" value="<?= htmlspecialchars($form['no_hp']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="tempat_lahir">Tempat lahir</label>
            <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir" value="<?= htmlspecialchars($form['tempat_lahir']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="tanggal_lahir">Tanggal lahir</label>
            <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($form['tanggal_lahir']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="jenis_kelamin">Jenis kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
              <option value="">Pilih jenis kelamin</option>
              <option value="Laki-laki" <?= $form['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
              <option value="Perempuan" <?= $form['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="tahun_lulus">Tahun lulus</label>
            <input class="form-control" type="number" id="tahun_lulus" name="tahun_lulus" min="2000" max="2035" value="<?= htmlspecialchars($form['tahun_lulus']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="asal_sekolah">Asal sekolah</label>
            <input class="form-control" type="text" id="asal_sekolah" name="asal_sekolah" value="<?= htmlspecialchars($form['asal_sekolah']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="jalur_pilihan">Jalur pilihan</label>
            <select class="form-control" id="jalur_pilihan" name="jalur_pilihan" required>
              <option value="">Pilih jalur</option>
              <?php foreach (['SNBP', 'SNBT', 'SPAN-PTKIN', 'UM-PTKIN', 'Mandiri'] as $jalur) { ?>
                <option value="<?= $jalur ?>" <?= $form['jalur_pilihan'] === $jalur ? 'selected' : '' ?>><?= $jalur ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="prodi_pilihan">Program studi pilihan</label>
            <input class="form-control" type="text" id="prodi_pilihan" name="prodi_pilihan" value="<?= htmlspecialchars($form['prodi_pilihan']) ?>" placeholder="Contoh: Informatika" required>
          </div>
          <div class="col-12">
            <label class="form-label" for="alamat">Alamat lengkap</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="4" required><?= htmlspecialchars($form['alamat']) ?></textarea>
          </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mt-4">
          <button class="btn btn-brand" type="submit">Simpan Biodata</button>
          <a class="btn btn-outline-success" href="dokumen.php">Lanjut Upload Dokumen</a>
        </div>
      </form>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
