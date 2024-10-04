<?php
ob_start(); // Tambahkan buffer output di atas

// Koneksi ke database
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Jika tidak menggunakan hashing

    // Query untuk update data
    $query = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id='$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Redirect ke halaman admin_dashboard.php setelah update berhasil
        header("Location: /admin/admin_dashboard.php"); // Gunakan path absolut
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

ob_end_flush(); // Jangan lupa tutup buffer di bawah
?>
