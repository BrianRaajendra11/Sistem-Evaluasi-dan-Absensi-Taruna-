<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}
header('Location: admin_dashboard.php');
exit;
?>
