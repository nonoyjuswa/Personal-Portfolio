<?php
require __DIR__ . "/db.php";

// Only accept form submissions, not someone typing the URL
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Method not allowed");
}

// Send the visitor back to the form with a status code
function back(string $status) {
  header("Location: ../index.php?status=" . $status . "#contact-form");
  exit;
}

// Honeypot: real visitors never see this field. If it's filled, it's a bot.
// Pretend it worked so the bot doesn't learn anything.
if (!empty($_POST["website"])) back("sent");

$name    = trim($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

// Validate
if ($name === "" || $message === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) back("invalid");
if (mb_strlen($name) > 100 || mb_strlen($email) > 150 || mb_strlen($message) > 2000) back("invalid");

// Save (prepared statement = safe from SQL injection)
try {
  $stmt = db()->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
  $stmt->execute([$name, $email, $message]);
} catch (PDOException $e) {
  error_log("Contact form DB error: " . $e->getMessage());
  back("error");
}

back("sent");