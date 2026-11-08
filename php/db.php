<?php
date_default_timezone_set("Asia/Manila"); 
// Database connection. Include with: require __DIR__ . "/db.php";
// Then use: db()->prepare("...")

const DB_HOST = "localhost";
const DB_NAME = "portfolio";
const DB_USER = "root";
const DB_PASS = "";   // XAMPP default is empty. Change if you set a password.

function db(): PDO {
  static $pdo = null;
  if ($pdo === null) {
    $pdo = new PDO(
      "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
      DB_USER,
      DB_PASS,
      [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
      ]
    );
    $pdo->exec("SET time_zone = '+08:00'");
  }
  return $pdo;
}