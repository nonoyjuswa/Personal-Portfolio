<?php
const UPLOAD_DIR_FS    = __DIR__ . "/../images/uploads/";
const UPLOAD_DIR_URL   = "images/uploads/";          // path stored in the database
const MAX_UPLOAD_BYTES = 2 * 1024 * 1024;            // 2 MB

// Returns [savedPath|null, errorMessage|null]. No file chosen = [null, null].
function save_image(array $file): array {
  $err = $file["error"] ?? UPLOAD_ERR_NO_FILE;
  if ($err === UPLOAD_ERR_NO_FILE) return [null, null];
  if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) return [null, "Image must be 2 MB or smaller."];
  if ($err !== UPLOAD_ERR_OK) return [null, "Upload failed (error code $err)."];
  if ($file["size"] > MAX_UPLOAD_BYTES) return [null, "Image must be 2 MB or smaller."];

  // Check the real file type, not the name the browser claims
  $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file["tmp_name"]);
  $allowed = ["image/jpeg" => "jpg", "image/png" => "png", "image/webp" => "webp"];
  if (!isset($allowed[$mime])) return [null, "Only JPG, PNG or WebP images are allowed."];

  if (!is_dir(UPLOAD_DIR_FS)) mkdir(UPLOAD_DIR_FS, 0755, true);
  $name = bin2hex(random_bytes(8)) . "." . $allowed[$mime];
  if (!move_uploaded_file($file["tmp_name"], UPLOAD_DIR_FS . $name)) {
    return [null, "Could not save the image."];
  }
  return [UPLOAD_DIR_URL . $name, null];
}

// Deletes a previously uploaded file (only inside images/uploads/)
function delete_upload(?string $path): void {
  if ($path && str_starts_with($path, UPLOAD_DIR_URL)) {
    $full = UPLOAD_DIR_FS . basename($path);
    if (is_file($full)) unlink($full);
  }
}