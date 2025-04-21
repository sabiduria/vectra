<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'vectra');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Create PDO instance
try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
    DB_USER,
    DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
?>