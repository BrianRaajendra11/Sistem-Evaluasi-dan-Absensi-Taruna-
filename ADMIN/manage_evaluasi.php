<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

// Fetch all physical evaluation data grouped by taruna_id
$sql = "SELECT * FROM evaluasi_fisik ORDER BY taruna_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Evaluasi Fisik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .btn-sm {
            margin-right: 5px;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kelola Evaluasi Fisik</h2>

        <!-- Tabel Evaluasi Fisik -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Taruna</th>
                    <th>Tanggal</th>
                    <th>Push Up</th>
                    <th>Pull Up</th>
                    <th>Sit Up</th>
                    <th>Lari 12 Menit</th>
                    <th>Shuttle Run</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['taruna_id']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['push_up']; ?></td>
                        <td><?php echo $row['pull_up']; ?></td>
                        <td><?php echo $row['sit_up']; ?></td>
                        <td><?php echo $row['lari_12_menit']; ?></td>
                        <td><?php echo $row['shuttle_run']; ?></td>
                        <td>
                            <a href="edit_evaluasi.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <a href="admin_dashboard.php" class="btn btn-primary btn-back">Kembali ke Dashboard</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
