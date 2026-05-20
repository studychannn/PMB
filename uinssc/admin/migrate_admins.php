<?php
// One-time migration script: create `admins` table and move admin accounts from `users`.
// USAGE: run in browser or CLI, then delete this file.

require __DIR__ . '/../includes/db.php';

if (!$pdo) {
  echo "Database connection not available.";
  exit;
}

try {
  $pdo->beginTransaction();

  // create admins table if not exists
  $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(191) NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

  // select users with role admin
  $stmt = $pdo->prepare('SELECT id, nama, email, password FROM users WHERE role = ?');
  $stmt->execute(['admin']);
  $admins = $stmt->fetchAll();

  $moved = 0;
  foreach ($admins as $a) {
    // insert into admins if not exists
    $check = $pdo->prepare('SELECT id FROM admins WHERE email = ? LIMIT 1');
    $check->execute([$a['email']]);
    if ($check->fetch()) {
      continue;
    }

    $ins = $pdo->prepare('INSERT INTO admins (nama, email, password) VALUES (?, ?, ?)');
    $ins->execute([$a['nama'], $a['email'], $a['password']]);
    $moved++;
  }

  // optional: reset role on users table to calon_mahasiswa for moved emails
  if ($moved > 0) {
    $pdo->exec("UPDATE users SET role = 'calon_mahasiswa' WHERE role = 'admin'");
  }

  $pdo->commit();

  echo "Migration complete. Admins moved: " . $moved . ". Please remove this file after verifying.";
} catch (Exception $e) {
  $pdo->rollBack();
  echo "Migration failed: " . $e->getMessage();
}
