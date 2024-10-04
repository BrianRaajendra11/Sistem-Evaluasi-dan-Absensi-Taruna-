<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: /admin/manage_user.php");
    exit;
}

include '../db.php'; // Pastikan path ke db.php benar

// Proses penghapusan jika ada POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Bersihkan dan pastikan ID adalah angka

    if ($id > 0) {
        // Query untuk menghapus siswa berdasarkan ID
        $sql = "DELETE FROM siswa WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Data siswa berhasil dihapus.";
            } else {
                $_SESSION['error'] = "Gagal menghapus data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Gagal menyiapkan query: " . $conn->error;
        }
    } else {
        $_SESSION['error'] = "ID siswa tidak valid.";
    }
} else {
    $_SESSION['error'] = "ID siswa tidak ditemukan.";
}

// Redirect kembali ke halaman manage_users.php
header("Location: manage_users.php");
exit;
?>
