<?php
require_once 'php/db.php';

try {
    // Test database connection
    $stmt = $pdo->query("SELECT 1");
    echo "Database connection successful!\n";
    
    // Test users table
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "Users table exists!\n";
    } else {
        echo "Users table does not exist!\n";
    }
    
    // Test calculations table
    $stmt = $pdo->query("SHOW TABLES LIKE 'calculations'");
    if ($stmt->rowCount() > 0) {
        echo "Calculations table exists!\n";
        
        // Show table structure
        $stmt = $pdo->query("DESCRIBE calculations");
        echo "\nCalculations table structure:\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($row);
        }
    } else {
        echo "Calculations table does not exist!\n";
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
