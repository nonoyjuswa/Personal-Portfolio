<?php
require __DIR__ . "/../php/auth.php";
require_login();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  $id = (int) ($_POST["id"] ?? 0);
  if ($id > 0 && ($_POST["action"] ?? "") === "delete") {
    db()->prepare("DELETE FROM services WHERE id = ?")->execute([$id]);
  }
  header("Location: services.php?msg=deleted");
  exit;
}

$services = db()->query("SELECT id, title, text, icon, sort_order FROM services ORDER BY sort_order, id")->fetchAll();
$msg = $_GET["msg"] ?? "";

$pageTitle = "Admin - Services";
include __DIR__ . "/../partials/admin-head.php";
?>
  <div class="toolbar">
    <div>
      <h1>Services</h1>
      <p class="admin__sub"><?= count($services) ?> shown in What I Do</p>
    </div>
    <a class="btn-primary" href="service-form.php">+ Add service</a>
  </div>

  <?php if ($msg === "saved"): ?><p class="alert alert--ok" role="status">Service saved.</p><?php endif; ?>
  <?php if ($msg === "deleted"): ?><p class="alert alert--ok" role="status">Service deleted.</p><?php endif; ?>

  <?php if (!$services): ?>
    <p class="empty">No services yet. Add your first one.</p>
  <?php else: ?>
    <div class="rows">
      <?php foreach ($services as $s): ?>
        <article class="row">
          <div class="row__thumb row__thumb--icon">
            <?php /* icon markup was validated by check_svg_inner() when saved */ ?>
            <svg viewBox="0 0 24 24" aria-hidden="true"><?= $s["icon"] ?></svg>
          </div>
          <div class="row__main">
            <div class="row__title"><?= e($s["title"]) ?></div>
            <div class="row__meta"><?= e($s["text"]) ?></div>
            <div class="row__meta">Order: <?= (int) $s["sort_order"] ?></div>
          </div>
          <div class="row__actions">
            <a class="btn-sm" href="service-form.php?id=<?= (int) $s["id"] ?>">Edit</a>
            <form method="POST" onsubmit="return confirm('Delete this service?');">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $s["id"] ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn-sm btn-sm--danger" type="submit">Delete</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main></body></html>