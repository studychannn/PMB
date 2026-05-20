<?php
$pageTitle = 'Login Admin - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'login';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';

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
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if ($email === '' || $password === '') {
    $errorMessage = 'Email dan password wajib diisi.';
  } elseif (!$pdo) {
    $errorMessage = $dbError ?? 'Database belum tersambung.';
  } else {
    $stmt = $pdo->prepare('SELECT id, nama, email, password FROM admins WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
      $errorMessage = 'Email atau password salah.';
    } else {
      login_user([
        'id' => $user['id'],
        'nama' => $user['nama'],
        'email' => $user['email'],
        'role' => 'admin',
      ]);
      header('Location: /uinssc/admin/admin_dashboard.php');
      exit;
    }
  }
}

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero auth-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Login Admin</p>
      <h1>Masuk ke area admin</h1>
      <p>Hanya akun dengan peran admin yang dapat mengakses halaman ini.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="auth-card mx-auto">
        <div class="auth-logo-wrap">
          <img src="/uinssc/assets/img/logo-uinssc.png" alt="Logo UINSSC" class="auth-logo">
        </div>
        <?php if ($errorMessage) { ?>
          <div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div>
        <?php } ?>
        <form method="post" action="/uinssc/admin/login.php">
          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
          <div class="mb-4">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password" required>
          </div>
          <button class="btn btn-brand w-100" type="submit">Login sebagai Admin</button>
        </form>
        <p class="auth-note">Bukan admin? <a href="/uinssc/login.php">Masuk sebagai User</a>.</p>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
