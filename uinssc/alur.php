<?php
$pageTitle = 'Alur PMB - UIN Siber Syekh Nurjati Cirebon';
$activePage = 'alur';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/components.php';
require __DIR__ . '/includes/header.php';
?>

<main>
  <section class="page-hero">
    <div class="container">
      <?php render_back_button(); ?>
      <p class="eyebrow">Alur Pendaftaran</p>
      <h1>Proses PMB dari registrasi sampai menjadi mahasiswa</h1>
      <p>Ikuti tahap pendaftaran online, verifikasi berkas, pengumuman, daftar ulang, dan ospek.</p>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="timeline-grid">
        <?php foreach ($alurPmb as $item) {
          render_process_card($item);
        } ?>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
