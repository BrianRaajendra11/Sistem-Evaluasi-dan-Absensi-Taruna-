<?php
session_start(); // Mulai sesi
session_unset(); // Hapus semua sesi
session_destroy(); // Hapus sesi

header('Location: login.php'); // Redirect ke halaman login
exit;
?>
