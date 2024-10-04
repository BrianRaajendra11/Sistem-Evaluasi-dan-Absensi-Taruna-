<?php
session_start();
include '../db.php'; // Pastikan path ke db.php benar

// Fungsi untuk membersihkan input
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan
    $id = clean_input($_POST["id"]);
    $nama = clean_input($_POST["nama"]);
    $email = clean_input($_POST["email"]);
    $password = clean_input($_POST["password"]);

    // Siapkan query untuk menambah data siswa
    $sql = "INSERT INTO siswa (id, nama, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $id, $nama, $email, $password); // Menggunakan string untuk semua parameter

        // Eksekusi dan cek hasilnya
        if ($stmt->execute()) {
            $_SESSION['message'] = "Data siswa berhasil ditambahkan.";
        } else {
            $_SESSION['error'] = "Gagal menambahkan data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Gagal menyiapkan query: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();

// Redirect ke manage_users.php
header("Location: manage_users.php");
exit();
?>
