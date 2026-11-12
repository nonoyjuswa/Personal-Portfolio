<?php
require __DIR__ . "/cv.php";

if (!is_file(CV_FILE_FS)) {
  http_response_code(404);
  exit("CV not available yet.");
}

header("Content-Type: application/pdf");
header('Content-Disposition: attachment; filename="Joshua-Tamayo-CV.pdf"');
header("Content-Length: " . filesize(CV_FILE_FS));
header("Cache-Control: no-cache, must-revalidate");
readfile(CV_FILE_FS);
exit;