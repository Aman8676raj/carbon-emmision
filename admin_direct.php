<?php
// Start a session
session_start();

// Set admin session variables
$_SESSION['admin_id'] = 1;
$_SESSION['admin_username'] = 'admin';

// Redirect to admin dashboard
header("Location: php/admin_dashboard.php");
exit;
?>
