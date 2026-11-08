<?php
require __DIR__ . "/../php/auth.php";
require __DIR__ . "/../php/uploads.php";
require_login();

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

// Starting values (blank form for "add")
$nextOrder = (int) db()->query("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM projects")->fetchColumn();
$project = ["title" => "", "label" => "", "tags" => "", "href" => "#", "image" => null, "sort_order" => $nextOrder];

// Editing: load the existing row
if ($id > 0) {
  $stmt = db()->prepare("SELECT * FROM projects WHERE id = ?");
  $stmt->execute([$id]);
  $found = $stmt->fetch();
  if (!$found) { http_response_code(404); exit("Project not found."); }
  $project = $found;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  csrf_check();

  $title = trim($_POST["title"] ?? "");
  $label = trim($_POST["label"] ?? "");
  $href  = trim($_POST["href"] ?? "");
  $order = (int) ($_POST["sort_order"] ?? 0);

  // Tags: "a, b,, c" -> "a,b,c"
  $tagList = array_filter(array_map("trim", explode(",", $_POST["tags"] ?? "")), fn($t) => $t !== "");
  $tags = implode(",", $tagList);

  // Keep what they typed if validation fails
  $project = array_merge($project, [
    "title" => $title, "label" => $label, "tags" => $tags, "href" => $href, "sort_order" => $order,
  ]);

  if ($title === "" || mb_strlen($title) > 150) $errors[] = "Title is required (150 characters max).";
  if (mb_strlen($label) > 100)                  $errors[] = "Placeholder label is too long (100 max).";
  if (mb_strlen($tags) > 255)                   $errors[] = "Tags are too long.";
  if ($href === "") $href = "#";
  $validLink = $href === "#" || (filter_var($href, FILTER_VALIDATE_URL) && preg_match('#^https?://#i', $href));
  if (!$validLink || mb_strlen($href) > 255)    $errors[] = "Link must be # or a full http(s) URL.";
  $project["href"] = $href;

  // Image upload (only if the text fields are fine)
  $newImage = null;
  if (!$errors) {
    [$newImage, $uploadError] = save_image($_FILES["image"] ?? []);
    if ($uploadError) $errors[] = $uploadError;
  }

  if (!$errors) {
    $image = $project["image"];
    if ($newImage) {                                   // replaced
      delete_upload($image);
      $image = $newImage;
    } elseif (!empty($_POST["remove_image"])) {        // removed
      delete_upload($image);
      $image = null;
    }

    $labelValue = $label === "" ? null : $label;
    if ($id > 0) {
      $sql = "UPDATE projects SET title=?, label=?, tags=?, href=?, image=?, sort_order=? WHERE id=?";
      db()->prepare($sql)->execute([$title, $labelValue, $tags, $href, $image, $order, $id]);
    } else {
      $sql = "INSERT INTO projects (title, label, tags, href, image, sort_order) VALUES (?, ?, ?, ?, ?, ?)";
      db()->prepare($sql)->execute([$title, $labelValue, $tags, $href, $image, $order]);
    }
    header("Location: projects.php?msg=saved");
    exit;
  }
}

$pageTitle = $id > 0 ? "Admin - Edit project" : "Admin - Add project";
include __DIR__ . "/../partials/admin-head.php";
?>
  <h1><?= $id > 0 ? "Edit project" : "Add project" ?></h1>
  <p class="admin__sub"><a href="projects.php">&larr; Back to projects</a></p>

  <?php foreach ($errors as $err): ?>
    <p class="alert alert--error" role="alert"><?= e($err) ?></p>
  <?php endforeach; ?>

  <form class="form" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= (int) $id ?>">

    <label>Title
      <input class="field" type="text" name="title" maxlength="150" required value="<?= e($project["title"]) ?>">
    </label>

    <label>Placeholder label <span class="hint">(shown on the card when there's no image; leave blank to use the title)</span>
      <input class="field" type="text" name="label" maxlength="100" value="<?= e($project["label"]) ?>">
    </label>

    <label>Tags <span class="hint">(comma-separated, e.g. HTML/CSS, JavaScript)</span>
      <input class="field" type="text" name="tags" maxlength="255" value="<?= e($project["tags"]) ?>">
    </label>

    <label>Link <span class="hint">(# or a full URL like https://github.com/...)</span>
      <input class="field" type="text" name="href" maxlength="255" value="<?= e($project["href"]) ?>">
    </label>

    <label>Order <span class="hint">(smaller numbers appear first)</span>
      <input class="field" type="number" name="sort_order" value="<?= (int) $project["sort_order"] ?>">
    </label>

    <div class="form__image">
      <span class="form__image-label">Thumbnail <span class="hint">(JPG, PNG or WebP, max 2 MB)</span></span>
      <?php if ($project["image"]): ?>
        <img class="form__preview" src="../<?= e($project["image"]) ?>" alt="Current thumbnail">
        <label class="check"><input type="checkbox" name="remove_image" value="1"> Remove current image</label>
      <?php endif; ?>
      <input class="field" type="file" name="image" accept="image/jpeg,image/png,image/webp">
    </div>

    <div class="form__buttons">
      <button class="btn-primary" type="submit">Save project</button>
      <a class="btn-sm" href="projects.php">Cancel</a>
    </div>
  </form>
</main></body></html>