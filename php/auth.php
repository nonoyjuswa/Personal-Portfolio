<?php
require_once __DIR__ . "/db.php";

function start_session(): void {
  if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
      "lifetime" => 0,        // ends when the browser closes
      "path"     => "/",
      "secure"   => !empty($_SERVER["HTTPS"]),
      "httponly" => true,     // JavaScript can't read the cookie
      "samesite" => "Lax",
    ]);
    session_start();
  }
}

// Escape text before printing it into HTML
function e(?string $s): string {
  return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8");
}

function is_logged_in(): bool {
  start_session();
  return !empty($_SESSION["admin_id"]);
}

// Put at the top of every admin page that needs a login
function require_login(): void {
  if (!is_logged_in()) {
    header("Location: login.php");
    exit;
  }
}

// CSRF protection: every POST form carries a secret token
function csrf_token(): string {
  start_session();
  if (empty($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(32));
  }
  return $_SESSION["csrf"];
}

function csrf_field(): string {
  return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function csrf_check(): void {
  start_session();
  $ok = isset($_POST["csrf"], $_SESSION["csrf"])
     && hash_equals($_SESSION["csrf"], $_POST["csrf"]);
  if (!$ok) {
    http_response_code(403);
    exit("Invalid request (CSRF check failed).");
  }
}