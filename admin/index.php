<?php
require __DIR__ . "/../php/auth.php";
require_login();

// Handle button clicks (all are POST + CSRF-checked)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  $id     = (int) ($_POST["id"] ?? 0);
  $action = $_POST["action"] ?? "";

  if ($id > 0) {
    if ($action === "read") {
      db()->prepare("UPDATE messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    } elseif ($action === "unread") {
      db()->prepare("UPDATE messages SET is_read = 0 WHERE id = ?")->execute([$id]);
    } elseif ($action === "delete") {
      db()->prepare("DELETE FROM messages WHERE id = ?")->execute([$id]);
    }
  }
  header("Location: index.php");
  exit;
}

$messages = db()->query(
  "SELECT id, name, email, message, is_read, created_at
   FROM messages ORDER BY created_at DESC, id DESC"
)->fetchAll();
$unread = count(array_filter($messages, fn($m) => !$m["is_read"]));

$pageTitle = "Admin - Messages";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1>Messages</h1>
  <p class="admin__sub"><?= count($messages) ?> total &middot; <?= $unread ?> unread</p>

  <?php if (!$messages): ?>
    <p class="empty">No messages yet.</p>
  <?php else: ?>
    <div class="msg-list">
      <?php foreach ($messages as $m): ?>
        <article class="msg<?= $m["is_read"] ? "" : " msg--unread" ?>">
          <div class="msg__head">
            <div class="msg__who">
              <?= e($m["name"]) ?>
              <small><a href="mailto:<?= e($m["email"]) ?>"><?= e($m["email"]) ?></a></small>
            </div>
            <div class="msg__date"><?= e(date("M j, Y g:i A", strtotime($m["created_at"]))) ?></div>
          </div>
          <p class="msg__body"><?= nl2br(e($m["message"])) ?></p>
          <div class="msg__actions">
            <form method="POST">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $m["id"] ?>">
              <input type="hidden" name="action" value="<?= $m["is_read"] ? "unread" : "read" ?>">
              <button class="btn-sm" type="submit"><?= $m["is_read"] ? "Mark unread" : "Mark read" ?></button>
            </form>
            <form method="POST" onsubmit="return confirm('Delete this message?');">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $m["id"] ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn-sm btn-sm--danger" type="submit">Delete</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main></body></html>