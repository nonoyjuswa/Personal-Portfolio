<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/uploads.php";
require_login();

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);
$themes = ["wine" => "Wine (dark red)", "blush" => "Blush (light pink)"];

$nextOrder = (int) db()->query("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM case_studies")->fetchColumn();
$cs = ["title" => "", "summary" => "", "href" => "#", "theme" => "wine", "image" => null, "arch" => 0, "sort_order" => $nextOrder];

if ($id > 0) {
  $stmt = db()->prepare("SELECT * FROM case_studies WHERE id = ?");
  $stmt->execute([$id]);
  $found = $stmt->fetch();
  if (!$found) { http_response_code(404); exit("Case study not found."); }
  $cs = $found;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();

  $title   = trim($_POST["title"] ?? "");
  $summary = trim($_POST["summary"] ?? "");
  $href    = trim($_POST["href"] ?? "");
  $theme   = $_POST["theme"] ?? "";
  $arch    = empty($_POST["arch"]) ? 0 : 1;
  $order   = (int) ($_POST["sort_order"] ?? 0);

  $cs = array_merge($cs, [
    "title" => $title, "summary" => $summary, "href" => $href,
    "theme" => $theme, "arch" => $arch, "sort_order" => $order,
  ]);

  if ($title === "" || mb_strlen($title) > 150)     $errors[] = "Title is required (150 characters max).";
  if ($summary === "" || mb_strlen($summary) > 255) $errors[] = "Summary is required (255 characters max).";
  if (!isset($themes[$theme]))                       $errors[] = "Please choose a valid theme.";
  if ($href === "") $href = "#";
  $validLink = $href === "#" || (filter_var($href, FILTER_VALIDATE_URL) && preg_match('#^https?://#i', $href));
  if (!$validLink || mb_strlen($href) > 255)         $errors[] = "Link must be # or a full http(s) URL.";
  $cs["href"] = $href;

  $newImage = null;
  if (!$errors) {
    [$newImage, $uploadError] = save_image($_FILES["image"] ?? []);
    if ($uploadError) $errors[] = $uploadError;
  }

  if (!$errors) {
    $image = $cs["image"];
    if ($newImage) {
      delete_upload($image);
      $image = $newImage;
    } elseif (!empty($_POST["remove_image"])) {
      delete_upload($image);
      $image = null;
    }

    if ($id > 0) {
      $sql = "UPDATE case_studies SET title=?, summary=?, href=?, theme=?, image=?, arch=?, sort_order=? WHERE id=?";
      db()->prepare($sql)->execute([$title, $summary, $href, $theme, $image, $arch, $order, $id]);
    } else {
      $sql = "INSERT INTO case_studies (title, summary, href, theme, image, arch, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)";
      db()->prepare($sql)->execute([$title, $summary, $href, $theme, $image, $arch, $order]);
    }
    header("Location: case-studies.php?msg=saved");
    exit;
  }
}

$pageTitle = $id > 0 ? "Admin - Edit case study" : "Admin - Add case study";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1><?= $id > 0 ? "Edit case study" : "Add case study" ?></h1>
  <p class="admin__sub"><a href="case-studies.php">&larr; Back to case studies</a></p>

  <?php foreach ($errors as $err): ?>
    <p class="alert alert--error" role="alert"><?= e($err) ?></p>
  <?php endforeach; ?>

  <form class="form" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int) $id ?>">

    <label>Title
      <input class="field" type="text" name="title" maxlength="150" required value="<?= e($cs["title"]) ?>">
    </label>

    <label>Summary <span class="hint">(a short line about the result, 255 max)</span>
      <textarea class="field" name="summary" maxlength="255" rows="3" required><?= e($cs["summary"]) ?></textarea>
    </label>

    <label>Link <span class="hint">(# or a full URL like https://github.com/...)</span>
      <input class="field" type="text" name="href" maxlength="255" value="<?= e($cs["href"]) ?>">
    </label>

    <label>Theme
      <select class="field" name="theme">
        <?php foreach ($themes as $value => $labelText): ?>
          <option value="<?= e($value) ?>"<?= $cs["theme"] === $value ? " selected" : "" ?>><?= e($labelText) ?></option>
        <?php endforeach; ?>
      </select>
    </label>

    <label class="check"><input type="checkbox" name="arch" value="1"<?= $cs["arch"] ? " checked" : "" ?>> Show the image in an arch shape</label>

    <label>Order <span class="hint">(smaller numbers appear first)</span>
      <input class="field" type="number" name="sort_order" value="<?= (int) $cs["sort_order"] ?>">
    </label>

    <div class="form__image">
      <span class="form__image-label">Image <span class="hint">(JPG, PNG or WebP, max 2 MB)</span></span>
      <?php if ($cs["image"]): ?>
        <img class="form__preview" src="../<?= e($cs["image"]) ?>" alt="Current image">
        <label class="check"><input type="checkbox" name="remove_image" value="1"> Remove current image</label>
      <?php endif; ?>
      <input class="field" type="file" name="image" accept="image/jpeg,image/png,image/webp">
    </div>

    <div class="form__buttons">
      <button class="btn-primary" type="submit">Save case study</button>
      <a class="btn-sm" href="case-studies.php">Cancel</a>
    </div>
  </form>
</main></body></html>