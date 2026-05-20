<?php
$pageTitle = 'Kelola Peserta - Admin PMB UIN SSC';
$activePage = 'peserta';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/pendaftaran_helpers.php';
require_admin();

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int) ($_POST['pendaftaran_id'] ?? 0);
  $statusBerkas = $_POST['status_berkas'] ?? '';
  $statusSeleksi = $_POST['status_seleksi'] ?? '';

  if ($id <= 0) {
    $errorMessage = 'Data peserta tidak valid.';
  } else {
    $updateFields = [];
    $params = [];

    if (in_array($statusBerkas, ['menunggu', 'diterima', 'ditolak'], true)) {
      $updateFields[] = 'status_berkas = ?';
      $params[] = $statusBerkas;
    }
    if (in_array($statusSeleksi, ['belum_diproses', 'lulus', 'tidak_lulus'], true)) {
      $updateFields[] = 'status_seleksi = ?';
      $params[] = $statusSeleksi;
    }

    if ($updateFields) {
      $params[] = $id;
      $stmt = $pdo->prepare('UPDATE pendaftaran SET ' . implode(', ', $updateFields) . ' WHERE id = ?');
      $stmt->execute($params);
      $successMessage = 'Status peserta berhasil diperbarui.';
    } else {
      $errorMessage = 'Pilih status yang valid untuk diperbarui.';
    }
  }
}

$participants = $pdo ? $pdo->query(
  'SELECT p.id, u.nama, u.email, p.jalur_pilihan, p.prodi_pilihan, p.status_berkas, p.status_seleksi, p.updated_at
   FROM pendaftaran p
   JOIN users u ON u.id = p.user_id
   ORDER BY p.updated_at DESC'
)->fetchAll() : [];

require __DIR__ . '/../includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Admin Peserta</p>
      <h1>Kelola status pendaftaran peserta</h1>
      <p>Edit verifikasi berkas dan hasil seleksi dengan mudah dari sini.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <?php if ($successMessage) { ?><div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div><?php } ?>
      <?php if ($errorMessage) { ?><div class="alert alert-warning"><?= htmlspecialchars($errorMessage) ?></div><?php } ?>

      <?php if (!$participants) { ?>
        <div class="alert alert-info">Belum ada data pendaftaran yang masuk.</div>
      <?php } else { ?>
        <div class="table-responsive">
          <table class="table table-striped table-borderless align-middle">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jalur / Prodi</th>
                <th>Status Berkas</th>
                <th>Status Seleksi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($participants as $row) { ?>
                <tr>
                  <td><?= htmlspecialchars($row['nama']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= htmlspecialchars($row['jalur_pilihan']) ?> / <?= htmlspecialchars($row['prodi_pilihan']) ?></td>
                  <td><?= htmlspecialchars(status_label($row['status_berkas'])) ?></td>
                  <td><?= htmlspecialchars(status_label($row['status_seleksi'])) ?></td>
                  <td>
                    <form method="post" class="d-flex flex-column gap-2">
                      <input type="hidden" name="pendaftaran_id" value="<?= htmlspecialchars($row['id']) ?>">
                      <select class="form-select form-select-sm" name="status_berkas">
                        <option value="">Ubah Status Berkas</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                      </select>
                      <select class="form-select form-select-sm" name="status_seleksi">
                        <option value="">Ubah Status Seleksi</option>
                        <option value="belum_diproses">Belum diproses</option>
                        <option value="lulus">Lulus</option>
                        <option value="tidak_lulus">Tidak lulus</option>
                      </select>
                      <button type="submit" class="btn btn-brand btn-sm">Simpan</button>
                    </form>
                  </td>
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
