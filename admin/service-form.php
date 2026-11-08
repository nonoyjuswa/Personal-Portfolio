<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/svg.php";
require_login();

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

$nextOrder = (int) db()->query("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM services")->fetchColumn();
$service = ["title" => "", "text" => "", "icon" => "", "sort_order" => $nextOrder];

if ($id > 0) {
  $stmt = db()->prepare("SELECT * FROM services WHERE id = ?");
  $stmt->execute([$id]);
  $found = $stmt->fetch();
  if (!$found) { http_response_code(404); exit("Service not found."); }
  $service = $found;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();

  $title = trim($_POST["title"] ?? "");
  $text  = trim($_POST["text"] ?? "");
  $icon  = trim($_POST["icon"] ?? "");
  $order = (int) ($_POST["sort_order"] ?? 0);

  $service = array_merge($service, ["title" => $title, "text" => $text, "icon" => $icon, "sort_order" => $order]);

  if ($title === "" || mb_strlen($title) > 100) $errors[] = "Title is required (100 characters max).";
  if ($text === ""  || mb_strlen($text) > 255)  $errors[] = "Description is required (255 characters max).";
  if ($icon === "") {
    $errors[] = "Icon markup is required.";
  } elseif ($svgError = check_svg_inner($icon)) {
    $errors[] = $svgError;
  }

  if (!$errors) {
    if ($id > 0) {
      $sql = "UPDATE services SET title=?, text=?, icon=?, sort_order=? WHERE id=?";
      db()->prepare($sql)->execute([$title, $text, $icon, $order, $id]);
    } else {
      $sql = "INSERT INTO services (title, text, icon, sort_order) VALUES (?, ?, ?, ?)";
      db()->prepare($sql)->execute([$title, $text, $icon, $order]);
    }
    header("Location: services.php?msg=saved");
    exit;
  }
}

$pageTitle = $id > 0 ? "Admin - Edit service" : "Admin - Add service";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1><?= $id > 0 ? "Edit service" : "Add service" ?></h1>
  <p class="admin__sub"><a href="services.php">&larr; Back to services</a></p>

  <?php foreach ($errors as $err): ?>
    <p class="alert alert--error" role="alert"><?= e($err) ?></p>
  <?php endforeach; ?>

  <form class="form" method="POST">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int) $id ?>">

    <label>Title
      <input class="field" type="text" name="title" maxlength="100" required value="<?= e($service["title"]) ?>">
    </label>

    <label>Description <span class="hint">(one or two sentences, 255 max)</span>
      <textarea class="field" name="text" maxlength="255" rows="3" required><?= e($service["text"]) ?></textarea>
    </label>

    <label>Icon markup <span class="hint">(the shapes inside the SVG, drawn on a 24&times;24 grid. Example: &lt;circle cx="12" cy="12" r="8"/&gt;)</span>
      <textarea class="field field--code" name="icon" rows="4" required><?= e($service["icon"]) ?></textarea>
    </label>

    <?php if ($service["icon"] !== "" && !$errors): ?>
      <div class="form__icon-preview">
        <span class="form__image-label">Current icon</span>
        <svg viewBox="0 0 24 24" aria-hidden="true"><?= $service["icon"] ?></svg>
      </div>
    <?php endif; ?>

    <label>Order <span class="hint">(smaller numbers appear first)</span>
      <input class="field" type="number" name="sort_order" value="<?= (int) $service["sort_order"] ?>">
    </label>

    <div class="form__buttons">
      <button class="btn-primary" type="submit">Save service</button>
      <a class="btn-sm" href="services.php">Cancel</a>
    </div>
  </form>
</main></body></html>