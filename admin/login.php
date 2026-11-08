<?php
require __DIR__ . "/../php/auth.php";
start_session();

if (is_logged_in()) {
  header("Location: index.php");
  exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  $username = trim($_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";

  $stmt = db()->prepare("SELECT id, password_hash FROM admins WHERE username = ?");
  $stmt->execute([$username]);
  $admin = $stmt->fetch();

  if ($admin && password_verify($password, $admin["password_hash"])) {
    session_regenerate_id(true);               // new session ID after login
    $_SESSION["admin_id"]   = (int) $admin["id"];
    $_SESSION["admin_name"] = $username;
    header("Location: index.php");
    exit;
  }

  usleep(500000);                              // slow down guessing (0.5s)
  $error = "Wrong username or password.";     // same message either way
}

$pageTitle = "Admin Login";
include __DIR__ . "/../partials/admin-head.php";
?>
  <div class="auth-card">
    <h1>Log in</h1>
    <p class="admin__sub">Admin area</p>
    <?php if (isset($_GET["created"])): ?><p class="alert alert--ok" role="status">Admin created. You can log in now.</p><?php endif; ?>
    <?php if ($error): ?><p class="alert alert--error" role="alert"><?= e($error) ?></p><?php endif; ?>
    <form method="POST">
      <?= csrf_field() ?>
      <label>Username <input class="field" type="text" name="username" required autocomplete="username" value="<?= e($_POST["username"] ?? "") ?>"></label>
      <label>Password <input class="field" type="password" name="password" required autocomplete="current-password"></label>
      <button class="btn-primary" type="submit">Log in</button>
    </form>
  </div>
</main></body></html>