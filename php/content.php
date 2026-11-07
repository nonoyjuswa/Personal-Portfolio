<?php
require __DIR__ . "/db.php";
header("Content-Type: application/json; charset=utf-8");

try {
  $pdo = db();

  $projects = $pdo->query(
    "SELECT title, label, tags, href, image FROM projects ORDER BY sort_order, id"
  )->fetchAll();
  foreach ($projects as &$p) {
    $p["label"] = $p["label"] ?: $p["title"];                        // placeholder text fallback
    $p["tags"]  = $p["tags"] === "" ? [] : array_map("trim", explode(",", $p["tags"]));
  }
  unset($p);

  $services = $pdo->query(
    "SELECT title, text, icon FROM services ORDER BY sort_order, id"
  )->fetchAll();

  $caseStudies = $pdo->query(
    "SELECT title, summary, href, theme, image, arch FROM case_studies ORDER BY sort_order, id"
  )->fetchAll();
  foreach ($caseStudies as &$c) { $c["arch"] = (bool) $c["arch"]; }
  unset($c);

  echo json_encode([
    "projects"    => $projects,
    "services"    => $services,
    "caseStudies" => $caseStudies,
  ], JSON_UNESCAPED_SLASHES);

} catch (PDOException $e) {
  error_log("content.php: " . $e->getMessage());
  http_response_code(500);
  echo json_encode(["error" => "Could not load content."]);
}