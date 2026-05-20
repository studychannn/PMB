<?php
$pageTitle = 'Logout - UIN Siber Syekh Nurjati Cirebon';
$activePage = '';
require __DIR__ . '/includes/auth.php';

logout_user();
require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero auth-hero">
    <div class="container">
      <p class="eyebrow">Logout</p>
      <h1>Kamu sudah keluar dari akun</h1>
      <p>Terima kasih sudah menggunakan layanan PMB UIN Siber Syekh Nurjati Cirebon.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="auth-card logout-card mx-auto text-center">
        <div class="auth-logo-wrap">
          <img src="assets/img/logo-uinssc.png" alt="Logo UINSSC" class="auth-logo">
        </div>
        <h2>Session berhasil diakhiri</h2>
        <p class="auth-note">Untuk keamanan, silakan login kembali jika ingin masuk ke dashboard.</p>
        <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
          <a class="btn btn-brand" href="/uinssc/login.php">Login Lagi</a>
          <a class="btn btn-outline-success" href="/uinssc/">Ke Beranda</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
