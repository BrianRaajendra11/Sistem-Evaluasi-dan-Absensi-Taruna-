<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

// Mengambil semua data absensi
$sql = "SELECT * FROM absensi";
$result = $conn->query($sql);
?>  

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .btn-sm {
            margin-right: 5px;
        }
        .btn-kembali {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kelola Absensi</h2>

        <!-- Tabel Absensi -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Taruna</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['taruna_id']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="edit_absensi.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <a href="admin_dashboard.php" class="btn btn-primary btn-kembali">Kembali ke Dashboard</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
