<?php
// Entry point for user area. Redirects to dashboard if logged in, otherwise to global login.
require __DIR__ . '/../includes/auth.php';

if (is_logged_in() && is_user()) {
  header('Location: /uinssc/user/dashboard.php');
  exit;
}

header('Location: /uinssc/login.php');
exit;
