<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

// Periksa apakah request method adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Query untuk menghapus data siswa
        $sql = "DELETE FROM siswa WHERE id = ?";
        
        // Siapkan statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Data siswa berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        $_SESSION['error'] = "ID siswa tidak valid.";
    }
} else {
    $_SESSION['error'] = "Metode request tidak valid.";
}

// Redirect ke halaman manage_users.php
header("Location: manage_users.php");
exit;

$conn->close();
?>