<?php
$pageTitle = 'Pesan Kontak - Admin PMB';
$activePage = 'kontak';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require_admin();

$messages = $pdo ? $pdo->query('SELECT id, nama, email, pesan, created_at FROM kontak_pesan ORDER BY created_at DESC')->fetchAll() : [];

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Pesan Kontak</p>
      <h1>Pesan yang masuk dari laman Kontak PMB</h1>
      <p>Daftar pesan disimpan di database lokal.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if (!$messages) { ?>
        <div class="alert alert-info">Belum ada pesan masuk.</div>
      <?php } else { ?>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead>
              <tr>
                <th>Waktu</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($messages as $m) { ?>
                <tr>
                  <td><?= htmlspecialchars($m['created_at']) ?></td>
                  <td><?= htmlspecialchars($m['nama']) ?></td>
                  <td><?= htmlspecialchars($m['email']) ?></td>
                  <td><?= nl2br(htmlspecialchars($m['pesan'])) ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } ?>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
