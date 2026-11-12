<?php
require_once __DIR__ . "/auth.php";   // gives us db() and e()

const CONTACT_KEYS = ["email", "github", "linkedin", "instagram", "location"];

function get_settings(): array {
  $rows = db()->query("SELECT name, value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
  return array_merge(array_fill_keys(CONTACT_KEYS, ""), $rows);
}

// https://www.github.com/x/ -> github.com/x
function pretty_url(string $url): string {
  return preg_replace('#^https?://(www\.)?#i', '', rtrim($url, "/"));
}

function contact_rows(array $c): array {
  return [
    ["label" => "Email", "value" => $c["email"], "href" => $c["email"] !== "" ? "mailto:" . $c["email"] : "",
     "copy" => true, "external" => false,
     "icon" => '<path d="M3 5h18v14H3z"/><path d="M3 6l9 7 9-7"/>'],
    ["label" => "Instagram", "value" => pretty_url($c["instagram"]), "href" => $c["instagram"],
     "copy" => false, "external" => true,
     "icon" => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>'],
    ["label" => "LinkedIn", "value" => pretty_url($c["linkedin"]), "href" => $c["linkedin"],
     "copy" => false, "external" => true,
     "icon" => '<path d="M6 9v10M6 5v.01M10 19v-6a3 3 0 0 1 6 0v6M10 9v10"/>'],
    ["label" => "GitHub", "value" => pretty_url($c["github"]), "href" => $c["github"],
     "copy" => false, "external" => true,
     "icon" => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a13 13 0 0 1 0 18 13 13 0 0 1 0-18z"/>'],
    ["label" => "Location", "value" => $c["location"], "href" => "",
     "copy" => false, "external" => false,
     "icon" => '<path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/>'],
  ];
}