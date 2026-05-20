<?php
function render_visual(string $visual): void
{
  if ($visual === 'mini-screen') {
    echo '<div class="mini-screen"><span></span><span></span><span></span></div>';
    return;
  }

  if ($visual === 'doc-stack') {
    echo '<div class="doc-stack"><i></i><i></i><i></i></div>';
    return;
  }

  if ($visual === 'exam-room') {
    echo '<div class="exam-room"><i></i><i></i><i></i><i></i></div>';
    return;
  }

  if ($visual === 'phone-result') {
    echo '<div class="phone-result">LULUS</div>';
    return;
  }

  if ($visual === 'payment-line') {
    echo '<div class="payment-line"><i></i><i></i><i></i></div>';
    return;
  }

  echo '<div class="student-row"><i></i><i></i><i></i><i></i></div>';
}

function render_back_button(): void
{
  echo '<a class="btn btn-outline-light btn-sm mb-3" href="javascript:history.back()">&larr; Kembali</a>';
}

function render_process_card(array $item): void
{
  $wideClass = !empty($item['wide']) ? ' wide-card' : '';
  $target = !empty($item['external']) ? ' target="_blank" rel="noopener"' : '';
  ?>
  <article class="process-card<?= $wideClass ?>">
    <div class="visual-panel <?= htmlspecialchars($item['kelas']) ?>">
      <span class="process-number"><?= htmlspecialchars($item['nomor']) ?></span>
      <?php render_visual($item['visual']); ?>
    </div>
    <h3><?= htmlspecialchars($item['judul']) ?></h3>
    <p><?= htmlspecialchars($item['deskripsi']) ?></p>
    <a href="<?= htmlspecialchars($item['link']) ?>"<?= $target ?>><?= htmlspecialchars($item['label']) ?></a>
  </article>
  <?php
}
