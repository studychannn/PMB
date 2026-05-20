<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/components.php';

$pageTitle = $pageTitle ?? 'PMB UIN Siber Syekh Nurjati Cirebon';
$activePage = $activePage ?? '';
$loggedInUser = current_user();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="Informasi alur penerimaan mahasiswa baru Universitas Islam Negeri Siber Syekh Nurjati Cirebon.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/uinssc/styles.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top site-nav">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="/uinssc/" aria-label="Beranda UIN Siber Syekh Nurjati Cirebon">
        <span class="brand-mark">
          <img src="/uinssc/assets/img/logo-uinssc.png" alt="Logo UINSSC" class="brand-logo">
        </span>
        <span class="brand-text">
          <strong>UIN Siber</strong>
          <small>Syekh Nurjati Cirebon</small>
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Buka navigasi">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <?php if ($loggedInUser && $loggedInUser['role'] === 'admin') { ?>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="/uinssc/admin/">Admin Dashboard</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'peserta' ? 'active' : '' ?>" href="/uinssc/admin/admin_peserta.php">Kelola Peserta</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'kontak' ? 'active' : '' ?>" href="/uinssc/admin/kontak_pesan.php">Pesan Kontak</a></li>
            <li class="nav-item ms-lg-3"><a class="btn btn-outline-success btn-sm" href="/uinssc/logout.php">Logout</a></li>
          <?php } else { ?>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'beranda' ? 'active' : '' ?>" href="/uinssc/index.php">Beranda</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'alur' ? 'active' : '' ?>" href="/uinssc/alur.php">Alur PMB</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'jalur' ? 'active' : '' ?>" href="/uinssc/jalur.php">Jalur</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'jadwal' ? 'active' : '' ?>" href="/uinssc/jadwal.php">Jadwal</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'kontak' ? 'active' : '' ?>" href="/uinssc/kontak.php">Kontak</a></li>
            <?php if ($loggedInUser) { ?>
              <li class="nav-item"><a class="nav-link <?= $activePage === 'dashboard' ? 'active' : '' ?>" href="/uinssc/user/">Dashboard</a></li>
              <li class="nav-item ms-lg-3"><a class="btn btn-outline-success btn-sm" href="/uinssc/logout.php">Logout</a></li>
            <?php } else { ?>
              <li class="nav-item"><a class="nav-link <?= $activePage === 'login' ? 'active' : '' ?>" href="/uinssc/login.php">Login</a></li>
              <li class="nav-item ms-lg-3"><a class="btn btn-brand btn-sm" href="/uinssc/register.php">Registrasi</a></li>
            <?php } ?>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
