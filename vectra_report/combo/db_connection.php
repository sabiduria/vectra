<?php
// Database Configuration
define('DB_HOST', 'localhost');      // Replace with your server host
define('DB_USERNAME', 'root'); // Replace with your database username
define('DB_PASSWORD', ''); // Replace with your database password
define('DB_NAME', 'vectra');     // Replace with your database name

/**
 * Establishes a secure PDO database connection
 * @return PDO
 * @throws PDOException If connection fails
 */
function getDBConnection() {
    try {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Return associative arrays
            PDO::ATTR_EMULATE_PREPARES   => false,                   // Disable emulated prepares
            PDO::ATTR_PERSISTENT         => false                    // Disable persistent connections
        ];

        $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD, $options);
        
        // Set timezone if needed (uncomment and adjust)
        // $conn->exec("SET time_zone = '+00:00';");
        
        return $conn;
    } catch (PDOException $e) {
        // Log error securely (never expose details to users)
        error_log("Database connection failed: " . $e->getMessage());
        
        // Display generic error message
        die("Could not connect to the database. Please try again later.");
    }
}

// Create connection (global variable - use carefully)
$conn = getDBConnection();

// Helper function for secure queries
function executeQuery($conn, $sql, $params = []) {
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("Query failed: " . $e->getMessage() . "\nSQL: " . $sql);
        return false;
    }
}
?>