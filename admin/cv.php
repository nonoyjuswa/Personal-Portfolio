<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/cv.php";
require_login();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();

  if (($_POST["action"] ?? "") === "delete") {
    if (is_file(CV_FILE_FS)) unlink(CV_FILE_FS);
    header("Location: cv.php?msg=deleted");
    exit;
  }

  $error = save_cv($_FILES["cv"] ?? []);
  if ($error) {
    $errors[] = $error;
  } else {
    header("Location: cv.php?msg=saved");
    exit;
  }
}

$exists = is_file(CV_FILE_FS);
$msg = $_GET["msg"] ?? "";

$pageTitle = "Admin - CV";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1>CV</h1>
  <p class="admin__sub">The file visitors get when they click "Download CV" on the hero.</p>

  <?php if ($msg === "saved"): ?><p class="alert alert--ok" role="status">CV updated.</p><?php endif; ?>
  <?php if ($msg === "deleted"): ?><p class="alert alert--ok" role="status">CV removed.</p><?php endif; ?>
  <?php foreach ($errors as $err): ?>
    <p class="alert alert--error" role="alert"><?= e($err) ?></p>
  <?php endforeach; ?>

  <div class="rows">
    <article class="row" style="grid-template-columns: 1fr auto;">
      <div class="row__main">
        <?php if ($exists): ?>
          <div class="row__title">Current CV (PDF)</div>
          <div class="row__meta">
            <?= round(filesize(CV_FILE_FS) / 1024) ?> KB &middot;
            uploaded <?= e(date("M j, Y g:i A", filemtime(CV_FILE_FS))) ?>
          </div>
        <?php else: ?>
          <div class="row__title">No CV uploaded yet</div>
          <div class="row__meta">The Download CV button will show "CV not available yet" until you upload one.</div>
        <?php endif; ?>
      </div>
      <?php if ($exists): ?>
        <div class="row__actions">
          <a class="btn-sm" href="../php/download-cv.php">Preview</a>
          <form method="POST" onsubmit="return confirm('Remove the current CV?');">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <button class="btn-sm btn-sm--danger" type="submit">Remove</button>
          </form>
        </div>
      <?php endif; ?>
    </article>
  </div>

  <form class="form" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="upload">
    <div class="form__image">
      <span class="form__image-label"><?= $exists ? "Replace CV" : "Upload CV" ?> <span class="hint">(PDF only, max 5 MB)</span></span>
      <input class="field" type="file" name="cv" accept="application/pdf" required>
    </div>
    <div class="form__buttons">
      <button class="btn-primary" type="submit">Save CV</button>
    </div>
  </form>
</main></body></html>