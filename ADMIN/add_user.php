<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taruna_id = $_POST['taruna_id'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Anda bisa mengenkripsi password sebelum menyimpannya

    $sql = "INSERT INTO users (taruna_id, username, password) VALUES ('$taruna_id', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Tambah Pengguna</h2>
        <form method="POST">
            <div class="mb-3">
                <label>ID Taruna</label>
                <input type="text" name="taruna_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</body>
</html>
