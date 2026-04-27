<?php
session_start();

// Destroy session
session_destroy();

// Clear cookie
setcookie('admin_logged', '', time() - 3600, '/admin/');

// Redirect to login
header('Location: login.php');
exit;
?>
