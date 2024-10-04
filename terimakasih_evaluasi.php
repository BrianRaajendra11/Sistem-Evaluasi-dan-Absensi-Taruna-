<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['taruna_id'])) {
    header('Location: login.php');
    exit;
}

$taruna_id = $_SESSION['taruna_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            color: #fff;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            color: #000;
        }
        .card-header {
            background-color: #28a745; /* Green header */
        }
        .btn {
            border-radius: 5px;
        }
        footer {
            margin-top: auto;
            padding: 10px 0;
            color: #fff;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for the footer */
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white">
                        <h4 class="mb-0">Terima Kasih!</h4>
                    </div>
                    <div class="card-body">
                        <p>Data evaluasi fisik Anda telah berhasil disimpan.</p>
                        <p>Apakah Anda ingin melihat hasil evaluasi atau kembali ke menu utama?</p>
                        <div class="d-grid gap-2">
                            <a href="lihat_hasil.php?taruna_id=<?php echo $taruna_id; ?>" class="btn btn-primary">Lihat Hasil Evaluasi</a>
                            <a href="index.php" class="btn btn-secondary">Kembali ke Menu Utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2024 BrianRajendra</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
