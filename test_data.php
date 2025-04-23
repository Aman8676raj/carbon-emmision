<?php
session_start();
require_once 'php/db.php';

// Create a test user if not exists
$username = "testuser";
$email = "test@example.com";
$password = password_hash("testpass123", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT IGNORE INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $password]);

// Set session for the test user
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();
$_SESSION['user_id'] = $user['id'];

// Test data
$testData = [
    'electricity' => 150,
    'gas' => 100,
    'water' => 500,
    'vehicleType' => 'car',
    'travelKm' => 30,
    'shopping' => 1000,
    'diet' => 'vegetarian',
    'waste' => 30,
    'totalEmission' => 450.5
];

// Send test data to save_footprint.php
$ch = curl_init('http://localhost:8000/php/save_footprint.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($testData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id());

$response = curl_exec($ch);
curl_close($ch);

echo "Test Response: " . $response . "\n";

// Verify data was saved
$stmt = $pdo->prepare("SELECT * FROM calculations WHERE user_id = ? ORDER BY calculated_at DESC LIMIT 1");
$stmt->execute([$_SESSION['user_id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "\nVerification:\n";
print_r($result);
?>
