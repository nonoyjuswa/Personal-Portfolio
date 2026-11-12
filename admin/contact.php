<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/settings.php";
require_login();

$errors = [];
$values = get_settings();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();
  foreach (CONTACT_KEYS as $k) $values[$k] = trim($_POST[$k] ?? "");

  if (!filter_var($values["email"], FILTER_VALIDATE_EMAIL) || mb_strlen($values["email"]) > 150) {
    $errors[] = "Enter a valid email address.";
  }
  foreach (["github", "linkedin", "instagram"] as $k) {
    $v = $values[$k];
    if ($v !== "" && (!filter_var($v, FILTER_VALIDATE_URL) || !preg_match('#^https?://#i', $v) || mb_strlen($v) > 255)) {
      $errors[] = ucfirst($k) . " must be a full http(s) URL, or left blank.";
    }
  }
  if (mb_strlen($values["location"]) > 100) $errors[] = "Location is too long (100 max).";

  if (!$errors) {
    $stmt = db()->prepare(
      "INSERT INTO settings (name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)"
    );
    foreach (CONTACT_KEYS as $k) $stmt->execute([$k, $values[$k]]);
    header("Location: contact.php?msg=saved");
    exit;
  }
}

$msg = $_GET["msg"] ?? "";
$pageTitle = "Admin - Contact";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1>Contact</h1>
  <p class="admin__sub">Shown in the contact section of the site. Leave a link blank to hide it.</p>

  <?php if ($msg === "saved"): ?><p class="alert alert--ok" role="status">Contact details saved.</p><?php endif; ?>
  <?php foreach ($errors as $err): ?>
    <p class="alert alert--error" role="alert"><?= e($err) ?></p>
  <?php endforeach; ?>

  <form class="form" method="POST">
    <?= csrf_field() ?>
    <label>Email
      <input class="field" type="email" name="email" maxlength="150" required value="<?= e($values["email"]) ?>">
    </label>
    <label>LinkedIn <span class="hint">(full URL)</span>
      <input class="field" type="text" name="linkedin" maxlength="255" value="<?= e($values["linkedin"]) ?>">
    </label>
    <label>GitHub <span class="hint">(full URL)</span>
      <input class="field" type="text" name="github" maxlength="255" value="<?= e($values["github"]) ?>">
    </label>
    <label>Instagram <span class="hint">(full URL, optional)</span>
      <input class="field" type="text" name="instagram" maxlength="255" value="<?= e($values["instagram"]) ?>">
    </label>
    <label>Location
      <input class="field" type="text" name="location" maxlength="100" value="<?= e($values["location"]) ?>">
    </label>
    <div class="form__buttons">
      <button class="btn-primary" type="submit">Save contact details</button>
    </div>
  </form>
</main></body></html>