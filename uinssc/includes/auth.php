<?php
if (session_status() === PHP_SESSION_NONE) {
  $sessionPath = dirname(__DIR__) . '/storage/sessions';

  if (is_dir($sessionPath) && is_writable($sessionPath)) {
    session_save_path($sessionPath);
  }

  session_start();
}

function current_user(): ?array
{
  return $_SESSION['user'] ?? null;
}

function is_logged_in(): bool
{
  return current_user() !== null;
}

function is_admin(): bool
{
  $user = current_user();
  return $user !== null && ($user['role'] ?? '') === 'admin';
}

function is_user(): bool
{
  $user = current_user();
  return $user !== null && ($user['role'] ?? '') === 'calon_mahasiswa';
}

function require_login(): void
{
  if (!is_logged_in()) {
    header('Location: /uinssc/login.php');
    exit;
  }
}

function require_user(): void
{
  if (!is_user()) {
    if (is_admin()) {
      header('Location: /uinssc/admin/admin_dashboard.php');
    } else {
      header('Location: /uinssc/login.php');
    }
    exit;
  }
}

function require_admin(): void
{
  if (!is_admin()) {
    if (is_logged_in()) {
      header('Location: /uinssc/user/dashboard.php');
    } else {
      header('Location: /uinssc/login.php');
    }
    exit;
  }
}

function login_user(array $user): void
{
  session_regenerate_id(true);
  $_SESSION['user'] = [
    'id' => $user['id'],
    'nama' => $user['nama'],
    'email' => $user['email'],
    'role' => $user['role'],
  ];
}

function logout_user(): void
{
  $_SESSION = [];

  if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
  }

  session_destroy();
}
