<?php
require_once __DIR__ . "/../php/auth.php";
$pageTitle = $pageTitle ?? "Admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($pageTitle) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600&family=Bodoni+Moda:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/variables.css">
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php if (is_logged_in()): ?>
  <header class="admin-bar">
    <div class="admin-bar__brand">JT <span>Admin</span></div>
    <nav class="admin-bar__nav" aria-label="Admin">
      <a href="index.php">Messages</a>
      <a href="projects.php">Projects</a>
      <a href="../index.php" target="_blank" rel="noopener">View site</a>
    </nav>
    <form action="logout.php" method="POST" class="admin-bar__logout">
      <?= csrf_field() ?>
      <button type="submit">Log out (<?= e($_SESSION["admin_name"] ?? "") ?>)</button>
    </form>
  </header>
<?php endif; ?>
<main class="admin">