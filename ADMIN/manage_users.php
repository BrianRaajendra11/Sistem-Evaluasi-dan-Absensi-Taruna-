<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /admin/manage_user.php");
    exit;
}

include '../db.php'; // Pastikan path ke db.php benar

// Fungsi untuk membersihkan input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Proses penghapusan jika ada POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Pastikan ID terkirim dan valid
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = clean_input($_POST['id']); // Bersihkan input ID
        
        // Debugging: Tampilkan nilai ID
        error_log("ID yang diterima: " . $id); // Ini akan mencetak ID ke log PHP
        
        // Siapkan query untuk menghapus data
        $sql = "DELETE FROM siswa WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $id); // Mengubah tipe menjadi string
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
        $_SESSION['error'] = "ID siswa tidak ditemukan.";
    }

    // Redirect untuk menghindari pengiriman ulang form saat refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Query untuk mengambil data dari tabel siswa
$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #6A0572;
            margin-bottom: 20px;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .success {
            color: green;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Siswa</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='success'>" . clean_input($_SESSION['message']) . "</div>";
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='error'>" . clean_input($_SESSION['error']) . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <!-- Tombol untuk menambah data -->
        <div class="text-center mb-3">
            <a href="add_siswa.php" class="btn btn-primary">Tambah Data</a>
        </div>

        <?php
        if ($result && $result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["nama"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["password"]) . "</td>
                        <td>
                           <form action='" . $_SERVER['PHP_SELF'] . "' method='post' class='form-delete' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
    <input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>
    <input type='hidden' name='delete' value='1'>
    <button type='submit' class='btn btn-danger'>Delete</button>
</form>
                        </td>
                      </tr>";
            }
        
            echo "</tbody></table>";
        } else {
            echo "<p class='text-center'>Tidak ada data siswa.</p>";
        }

        $conn->close();
        ?>
        
        <!-- Tombol Kembali ke admin_dashboard.php -->
        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary">Kembali</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Menghapus parameter URL setelah menampilkan pesan
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.pathname);
    }
    </script>
    
</body>
</html>
