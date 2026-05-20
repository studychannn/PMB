<?php
$pageTitle = 'PMB UIN Siber Syekh Nurjati Cirebon';
$activePage = 'beranda';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<main id="beranda">
  <section class="hero-section">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide pendaftaran"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide kampus digital"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide mahasiswa baru"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="hero-slide hero-one">
            <div class="container hero-content">
              <p class="eyebrow">Penerimaan Mahasiswa Baru</p>
              <h1>Universitas Islam Negeri Siber Syekh Nurjati Cirebon</h1>
              <p class="lead">Daftar kuliah lebih mudah melalui alur online yang jelas, terarah, dan ramah untuk calon mahasiswa baru.</p>
              <div class="hero-actions">
                <a class="btn btn-brand" href="alur.php">Lihat Alur PMB</a>
                <a class="btn btn-outline-light" href="jalur.php">Pilih Jalur Masuk</a>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="hero-slide hero-two">
            <div class="container hero-content">
              <p class="eyebrow">Kampus Islam Digital</p>
              <h2>Belajar modern dengan nilai keislaman yang kuat</h2>
              <p class="lead">UIN Siber Syekh Nurjati Cirebon menghadirkan akses pendidikan tinggi yang adaptif, inklusif, dan berbasis teknologi.</p>
              <div class="hero-actions">
                <a class="btn btn-brand" href="jadwal.php">Cek Jadwal</a>
                <a class="btn btn-outline-light" href="kontak.php">Hubungi Admin</a>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="hero-slide hero-three">
            <div class="container hero-content">
              <p class="eyebrow">Mulai Perjalanan Akademik</p>
              <h2>Dari pendaftaran sampai orientasi kampus</h2>
              <p class="lead">Ikuti setiap tahap seleksi, lengkapi berkas, pantau pengumuman, lalu lakukan daftar ulang dengan tenang.</p>
              <div class="hero-actions">
                <a class="btn btn-brand" href="https://ciu.uinssc.ac.id/" target="_blank" rel="noopener">Akses Pendaftaran</a>
                <a class="btn btn-outline-light" href="alur.php">Pelajari Tahapannya</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Slide sebelumnya">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Slide berikutnya">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </button>
    </div>
  </section>

  <section class="quick-access" aria-label="Akses cepat">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-4">
          <a class="access-tile" href="https://uinssc.ac.id/" target="_blank" rel="noopener">
            <span class="tile-icon">01</span>
            <span><strong>Portal Kampus</strong><small>Buka website resmi UINSSC</small></span>
          </a>
        </div>
        <div class="col-md-4">
          <a class="access-tile" href="alur.php">
            <span class="tile-icon">02</span>
            <span><strong>Alur Seleksi</strong><small>Pahami proses dari awal hingga ospek</small></span>
          </a>
        </div>
        <div class="col-md-4">
          <a class="access-tile" href="kontak.php">
            <span class="tile-icon">03</span>
            <span><strong>Bantuan PMB</strong><small>Kontak admin bila ada kendala</small></span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="section-pad">
    <div class="container">
      <div class="section-heading">
        <p class="eyebrow dark">Informasi PMB</p>
        <h2>Satu website untuk memahami proses PMB</h2>
        <p>Temukan semua informasi pendaftaran, jadwal, jalur masuk, dan kontak panitia di sini.</p>
      </div>
    </div>
  </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
