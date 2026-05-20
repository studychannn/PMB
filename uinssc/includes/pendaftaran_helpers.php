<?php
function get_pendaftaran(?PDO $pdo, int $userId): ?array
{
  if (!$pdo) {
    return null;
  }

  $stmt = $pdo->prepare('SELECT * FROM pendaftaran WHERE user_id = ? LIMIT 1');
  $stmt->execute([$userId]);
  $data = $stmt->fetch();

  return $data ?: null;
}

function get_dokumen_list(?PDO $pdo, int $userId): array
{
  if (!$pdo) {
    return [];
  }

  $stmt = $pdo->prepare('SELECT * FROM dokumen_pendaftaran WHERE user_id = ? ORDER BY uploaded_at DESC');
  $stmt->execute([$userId]);

  return $stmt->fetchAll();
}

function document_labels(): array
{
  return [
    'foto' => 'Pas Foto',
    'ijazah_skl' => 'Ijazah / SKL',
    'ktp_kk' => 'KTP / Kartu Keluarga',
    'rapor' => 'Rapor',
    'prestasi' => 'Sertifikat Prestasi',
  ];
}

function status_label(string $status): string
{
  return [
    'belum_dikirim' => 'Belum dikirim',
    'menunggu' => 'Menunggu verifikasi',
    'diterima' => 'Diterima',
    'ditolak' => 'Ditolak',
    'belum_diproses' => 'Belum diproses',
    'lulus' => 'Lulus',
    'tidak_lulus' => 'Tidak lulus',
  ][$status] ?? $status;
}
