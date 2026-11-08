<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/uploads.php";
require_login();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  $id = (int) ($_POST["id"] ?? 0);
  if ($id > 0 && ($_POST["action"] ?? "") === "delete") {
    $stmt = db()->prepare("SELECT image FROM case_studies WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetchColumn();

    db()->prepare("DELETE FROM case_studies WHERE id = ?")->execute([$id]);
    delete_upload($image ?: null);
  }
  header("Location: case-studies.php?msg=deleted");
  exit;
}

$items = db()->query("SELECT id, title, summary, href, theme, image, arch, sort_order FROM case_studies ORDER BY sort_order, id")->fetchAll();
$msg = $_GET["msg"] ?? "";

$pageTitle = "Admin - Case studies";
include __DIR__ . "/../partials/admin-head.php";
?>
  <div class="toolbar">
    <div>
      <h1>Case studies</h1>
      <p class="admin__sub"><?= count($items) ?> shown in Case Studies</p>
    </div>
    <a class="btn-primary" href="case-study-form.php">+ Add case study</a>
  </div>

  <?php if ($msg === "saved"): ?><p class="alert alert--ok" role="status">Case study saved.</p><?php endif; ?>
  <?php if ($msg === "deleted"): ?><p class="alert alert--ok" role="status">Case study deleted.</p><?php endif; ?>

  <?php if (!$items): ?>
    <p class="empty">No case studies yet. Add your first one.</p>
  <?php else: ?>
    <div class="rows">
      <?php foreach ($items as $c): ?>
        <article class="row">
          <div class="row__thumb">
            <?php if ($c["image"]): ?>
              <img src="../<?= e($c["image"]) ?>" alt="">
            <?php else: ?>
              <span>No image</span>
            <?php endif; ?>
          </div>
          <div class="row__main">
            <div class="row__title"><?= e($c["title"]) ?></div>
            <div class="row__meta"><?= e($c["summary"]) ?></div>
            <div class="row__meta">
              Order: <?= (int) $c["sort_order"] ?> &middot; Theme: <?= e($c["theme"]) ?>
              <?= $c["arch"] ? " &middot; Arch image" : "" ?> &middot; <?= e($c["href"]) ?>
            </div>
          </div>
          <div class="row__actions">
            <a class="btn-sm" href="case-study-form.php?id=<?= (int) $c["id"] ?>">Edit</a>
            <form method="POST" onsubmit="return confirm('Delete this case study?');">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= (int) $c["id"] ?>">
              <input type="hidden" name="action" value="delete">
              <button class="btn-sm btn-sm--danger" type="submit">Delete</button>
            </form>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main></body></html>