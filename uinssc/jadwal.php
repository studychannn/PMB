<?php
$pageTitle = 'Jadwal PMB - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'jadwal';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/db.php';

$jadwalList = $jadwalPmb;
if ($pdo) {
  $stmt = $pdo->query('SELECT tahap AS judul, keterangan AS deskripsi FROM jadwal_pmb ORDER BY id ASC');
  $rows = $stmt->fetchAll();
  if ($rows) {
    $jadwalList = array_map(function ($row, $index) {
      $row['nomor'] = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
      return $row;
    }, $rows, array_keys($rows));
  }
}

require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Jadwal Penting</p>
      <h1>Pantau setiap tahap agar tidak tertinggal</h1>
      <p>Catat setiap fase pendaftaran supaya tidak melewatkan informasi penting.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="schedule-wrap">
        <?php foreach ($jadwalList as $jadwal) { ?>
          <div class="schedule-item">
            <time><?= htmlspecialchars($jadwal['nomor']) ?></time>
            <div>
              <h3><?= htmlspecialchars($jadwal['judul']) ?></h3>
              <p><?= htmlspecialchars($jadwal['deskripsi']) ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
