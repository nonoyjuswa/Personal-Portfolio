<?php
const CV_DIR_FS    = __DIR__ . "/../files/";
const CV_FILE_FS   = CV_DIR_FS . "cv.pdf";
const CV_MAX_BYTES = 5 * 1024 * 1024;   // 5 MB

// Returns an error message, or null on success.
function save_cv(array $file): ?string {
  $err = $file["error"] ?? UPLOAD_ERR_NO_FILE;
  if ($err === UPLOAD_ERR_NO_FILE) return "Please choose a PDF file.";
  if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) return "PDF must be 5 MB or smaller.";
  if ($err !== UPLOAD_ERR_OK) return "Upload failed (error code $err).";
  if ($file["size"] > CV_MAX_BYTES) return "PDF must be 5 MB or smaller.";

  $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file["tmp_name"]);
  if ($mime !== "application/pdf") return "Only PDF files are allowed.";

  if (!is_dir(CV_DIR_FS)) mkdir(CV_DIR_FS, 0755, true);
  $tmp = CV_DIR_FS . "cv.tmp";
  if (!move_uploaded_file($file["tmp_name"], $tmp)) return "Could not save the PDF.";
  rename($tmp, CV_FILE_FS);               // replaces the old CV
  return null;
}