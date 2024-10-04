<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .dashboard-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 80px auto;
            transition: transform 0.3s; /* Transisi saat hover */
        }
        .dashboard-container:hover {
            transform: scale(1.02); /* Efek zoom saat hover */
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
        }
        .btn-dashboard {
            width: 100%;
            margin-bottom: 15px;
            font-size: 18px;
            transition: transform 0.1s, background-color 0.1s;
        }
        .btn-dashboard:active {
            transform: scale(0.95); /* Efek mengecil saat tombol ditekan */
            background-color: #0a58ca; /* Mengubah warna tombol saat ditekan */
        }
        .btn-logout {
            width: 100%;
            font-size: 18px;
            background-color: #dc3545;
            color: white;
            transition: transform 0.1s, background-color 0.1s;
        }
        .btn-logout:active {
            transform: scale(0.95); /* Efek mengecil saat tombol ditekan */
            background-color: #bd2130; /* Mengubah warna tombol logout saat ditekan */
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
        .card {
            margin-top: 20px; /* Jarak antara tombol */
            border: none; /* Hapus border default */
            border-radius: 10px; /* Radius border */
            transition: transform 0.3s; /* Transisi saat hover */
        }
        .card:hover {
            transform: translateY(-5px); /* Efek angkat saat hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bayangan saat hover */
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h2>Dashboard Admin</h2>
        
        <div class="card">
            <a href="manage_users.php" class="btn btn-primary btn-dashboard">Kelola Pengguna</a>
        </div>
        <div class="card">
            <a href="manage_absensi.php" class="btn btn-primary btn-dashboard">Kelola Absensi</a>
        </div>
        <div class="card">
            <a href="manage_evaluasi.php" class="btn btn-primary btn-dashboard">Kelola Evaluasi Fisik</a>
        </div>
        <div class="card">
            <a href="admin_logout.php" class="btn btn-logout">Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
