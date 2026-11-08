<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/uploads.php";
require_login();

// Delete
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  $id = (int) ($_POST["id"] ?? 0);
  if ($id > 0 && ($_POST["action"] ?? "") === "delete") {
    $stmt = db()->prepare("SELECT image FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();

    db()->prepare("DELETE FROM projects WHERE id = ?")->execute([$id]);
    delete_upload($image ?: null);
  }
  header("Location: projects.php?msg=deleted");
  exit;
}

$projects = db()->query("SELECT id, title, tags, href, image, sort_order FROM projects ORDER BY sort_order, id")->fetchAll();
$msg = $_GET["msg"] ?? "";

$pageTitle = "Admin - Projects";
include __DIR__ . "/../partials/admin-head.php";
?>
  <div class="toolbar">
    <div>
      <h1>Projects</h1>
      <p class="admin__sub"><?= count($projects) ?> shown in Featured Work</p>
    </div>
    <a class="btn-primary" href="project-form.php">+ Add project</a>
  </div>

  <?php if ($msg === "saved"): ?><p class="alert alert--ok" role="status">Project saved.</p><?php endif; ?>
  <?php if ($msg === "deleted"): ?><p class="alert alert--ok" role="status">Project deleted.</p><?php endif; ?>

  <?php if (!$projects): ?>
    <p class="empty">No projects yet. Add your first one.</p>
  <?php else: ?>
    <div class="rows">
      <?php foreach ($projects as $p): ?>
        <article class="row">
          <div class="row__thumb">
            <?php if ($p["image"]): ?>
              <img src="../<?= e($p["image"]) ?>" alt="">
            <?php else: ?>
              <span>No image</span>
            <?php endif; ?>
          </div>
          <div class="row__main">
            <div class="row__title"><?= e($p["title"]) ?></div>
            <div class="row__meta"><?= e(str_replace(",", " · ", $p["tags"])) ?></div>
            <div class="row__meta">Order: <?= (int) $p["sort_order"] ?> &middot; <?= e($p["href"]) ?></div>
          </div>
          <div class="row__actions">
            <a class="btn-sm" href="project-form.php?id=<?= (int) $p["id"] ?>">Edit</a>
            <form method="POST" onsubmit="return confirm('Delete this project?');">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $p["id"] ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn-sm btn-sm--danger" type="submit">Delete</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main></body></html>