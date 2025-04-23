<?php
// This is a direct fix script that will create the admin user and redirect to login
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecotrack_db";

// Create database and tables directly
try {
    // Create database connection without selecting a database
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $conn->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    
    // Switch to the database
    $conn->exec("USE $dbname");
    
    // Create admin_users table
    $conn->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Create or update admin user with hardcoded password
    $stmt = $conn->prepare("SELECT id FROM admin_users WHERE username = 'admin'");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Update existing admin user
        $sql = "UPDATE admin_users SET password = '$2y$10$8i5KxMqxjKAYL3.JH/QnAuCQHNPK3QvnSOqJW7dV.FPQlQA2WbZDa' WHERE username = 'admin'";
        $conn->exec($sql);
        echo "Admin user updated with fixed password hash.<br>";
    } else {
        // Insert new admin user
        $sql = "INSERT INTO admin_users (username, password) VALUES ('admin', '$2y$10$8i5KxMqxjKAYL3.JH/QnAuCQHNPK3QvnSOqJW7dV.FPQlQA2WbZDa')";
        $conn->exec($sql);
        echo "Admin user created with fixed password hash.<br>";
    }
    
    echo "<h2>Admin Login Fixed!</h2>";
    echo "<p>Username: admin</p>";
    echo "<p>Password: admin123</p>";
    echo "<p><a href='admin_login.html'>Go to Admin Login</a></p>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
