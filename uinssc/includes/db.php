<?php
$dbHost = 'localhost';
$dbName = 'uinssc_pmb';
$dbUser = 'root';
$dbPass = '';

try {
  $pdo = new PDO(
    "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
    $dbUser,
    $dbPass,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
} catch (PDOException $e) {
  $pdo = null;
  $dbError = 'Database belum tersambung. Import file database/schema.sql di phpMyAdmin, lalu cek konfigurasi includes/db.php.';
}
