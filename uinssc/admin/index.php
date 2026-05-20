<?php
// Entry point for admin area. Redirects to dashboard if logged in, otherwise to global login.
require __DIR__ . '/../includes/auth.php';

if (is_logged_in() && is_admin()) {
  header('Location: /uinssc/admin/admin_dashboard.php');
  exit;
}

header('Location: /uinssc/admin/login.php');
exit;
