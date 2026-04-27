<?php
/**
 * Session verification
 * Checks if user is logged in
 */

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
?>
