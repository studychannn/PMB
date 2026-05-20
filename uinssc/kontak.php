<?php
$pageTitle = 'Kontak PMB - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'kontak';
require __DIR__ . '/includes/db.php';

$successMessage = '';
$errorMessage = '';

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($requestMethod === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pesan = trim($_POST['pesan'] ?? '');

  if ($nama === '' || $email === '' || $pesan === '') {
    $errorMessage = 'Nama, email, dan pesan wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = 'Format email belum benar.';
  } elseif (!$pdo) {
    $errorMessage = $dbError ?? 'Database belum tersambung.';
  } else {
    $stmt = $pdo->prepare('INSERT INTO kontak_pesan (nama, email, pesan) VALUES (?, ?, ?)');
    $stmt->execute([$nama, $email, $pesan]);
    $successMessage = 'Pesan berhasil dikirim dan tersimpan ke database.';
  }
}

require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Kontak PMB</p>
      <h1>Hubungi layanan PMB UIN Siber Syekh Nurjati Cirebon</h1>
      <p>Isi form di bawah dan tim PMB akan segera merespons pertanyaanmu.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="info-card contact-info">
            <span>Informasi Resmi</span>
            <h2>Pastikan semua akses dari sumber kampus</h2>
            <p>Website resmi dan CIU Super App menjadi rujukan utama untuk admisi, registrasi, dan pembayaran.</p>
            <a class="btn btn-brand me-2 mb-2" href="https://ciu.uinssc.ac.id/" target="_blank" rel="noopener">CIU Super App</a>
            <a class="btn btn-outline-success mb-2" href="https://uinssc.ac.id/" target="_blank" rel="noopener">Website Kampus</a>
          </div>
        </div>
        <div class="col-lg-7">
          <form class="contact-form" method="post" action="kontak.php">
            <?php if ($successMessage) { ?>
              <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
            <?php } ?>
            <?php if ($errorMessage) { ?>
              <div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div>
            <?php } elseif (!empty($dbError)) { ?>
              <div class="alert alert-info"><?= htmlspecialchars($dbError) ?></div>
            <?php } ?>

            <div class="mb-3">
              <label class="form-label" for="nama">Nama lengkap</label>
              <input class="form-control" type="text" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" type="email" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label" for="pesan">Pesan</label>
              <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
            </div>
            <button class="btn btn-brand" type="submit">Kirim Pesan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
