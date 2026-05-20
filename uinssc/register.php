<?php
$pageTitle = 'Registrasi Akun - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'register';
require __DIR__ . '/includes/db.php';
require __DIR__ . '/includes/auth.php';

if (is_logged_in()) {
  if (is_admin()) {
    header('Location: /uinssc/admin/admin_dashboard.php');
  } else {
    header('Location: /uinssc/user/dashboard.php');
  }
  exit;
}

$errorMessage = '';

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($requestMethod === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $konfirmasi = $_POST['konfirmasi'] ?? '';

  if ($nama === '' || $email === '' || $password === '' || $konfirmasi === '') {
    $errorMessage = 'Semua field wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage = 'Format email belum benar.';
  } elseif (strlen($password) < 6) {
    $errorMessage = 'Password minimal 6 karakter.';
  } elseif ($password !== $konfirmasi) {
    $errorMessage = 'Konfirmasi password tidak sama.';
  } elseif (!$pdo) {
    $errorMessage = $dbError ?? 'Database belum tersambung.';
  } else {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
      $errorMessage = 'Email sudah terdaftar. Silakan login.';
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)');
      $stmt->execute([$nama, $email, $hash, 'calon_mahasiswa']);

      $userId = (int) $pdo->lastInsertId();
      login_user([
        'id' => $userId,
        'nama' => $nama,
        'email' => $email,
        'role' => 'calon_mahasiswa',
      ]);

      header('Location: /uinssc/user/dashboard.php');
      exit;
    }
  }
}

require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero auth-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Registrasi Akun</p>
      <h1>Buat akun calon mahasiswa</h1>
      <p>Daftar sekarang untuk mulai isi biodata dan unggah dokumen PMB.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="auth-card mx-auto">
        <div class="auth-logo-wrap">
          <img src="assets/img/logo-uinssc.png" alt="Logo UINSSC" class="auth-logo">
        </div>
        <?php if ($errorMessage) { ?>
          <div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div>
        <?php } ?>
        <form method="post" action="register.php">
          <div class="mb-3">
            <label class="form-label" for="nama">Nama lengkap</label>
            <input class="form-control" type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password" minlength="6" required>
          </div>
          <div class="mb-4">
            <label class="form-label" for="konfirmasi">Konfirmasi password</label>
            <input class="form-control" type="password" id="konfirmasi" name="konfirmasi" minlength="6" required>
          </div>
          <button class="btn btn-brand w-100" type="submit">Daftar</button>
        </form>
        <p class="auth-note">Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
