<?php
$pageTitle = 'Dashboard - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'dashboard';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_user();

$user = current_user();
$pendaftaran = get_pendaftaran($pdo, (int) $user['id']);
$dokumenList = get_dokumen_list($pdo, (int) $user['id']);
require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Dashboard</p>
      <h1>Halo, <?= htmlspecialchars($user['nama']) ?></h1>
      <p>Langsung klik langkah berikut untuk teruskan pendaftaranmu.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-4">
          <div class="info-card">
            <span>Akun</span>
            <h3>Data Login</h3>
            <p><?= htmlspecialchars($user['email']) ?></p>
            <a href="../logout.php">Logout</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <span>Tahap 1</span>
            <h3>Lengkapi Biodata</h3>
            <p><?= $pendaftaran ? 'Biodata sudah tersimpan dan bisa diedit.' : 'Siapkan data pribadi, asal sekolah, dan pilihan program studi.' ?></p>
            <a href="pendaftaran.php"><?= $pendaftaran ? 'Edit biodata' : 'Isi biodata' ?></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <span>Tahap 2</span>
            <h3>Upload Dokumen</h3>
            <p><?= count($dokumenList) ?> dokumen sudah diupload. Lengkapi berkas agar bisa diverifikasi.</p>
            <a href="dokumen.php">Upload dokumen</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <span>Tahap 3</span>
            <h3>Pengumuman Hasil</h3>
            <p>Periksa hasil seleksi untuk tahu apakah kamu bisa lanjut daftar ulang.</p>
            <a href="pengumuman.php">Lihat pengumuman</a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-card">
            <span>Informasi</span>
            <h3>Alur PMB</h3>
            <p>Pahami proses dari registrasi sampai orientasi kampus.</p>
            <a href="../alur.php">Lihat alur</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
