<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['taruna_id'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit;
}
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taruna_id = $_POST['taruna_id']; // ID taruna yang diinput
    $tanggal = date('Y-m-d');
    $push_up = $_POST['push_up'];
    $pull_up = $_POST['pull_up'];
    $sit_up = $_POST['sit_up'];
    $lari_12_menit = $_POST['lari_12_menit'];
    $shuttle_run = $_POST['shuttle_run'];

    // Periksa apakah ID Taruna ada di tabel siswa
    $check_sql = "SELECT * FROM siswa WHERE id = '$taruna_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Jika ID Taruna ditemukan, lanjutkan menyimpan evaluasi fisik
        $sql = "INSERT INTO evaluasi_fisik (taruna_id, tanggal, push_up, pull_up, sit_up, lari_12_menit, shuttle_run) 
                VALUES ('$taruna_id', '$tanggal', '$push_up', '$pull_up', '$sit_up', '$lari_12_menit', '$shuttle_run')";
        
        if ($conn->query($sql) === TRUE) {
            // Simpan taruna_id dalam sesi untuk digunakan di lihat_evaluasi.php
            $_SESSION['taruna_id_evaluasi'] = $taruna_id;
            
            // Redirect ke halaman "Terima Kasih"
            header('Location: terimakasih_evaluasi.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Jika ID Taruna tidak ditemukan, tampilkan pesan error
        echo "<script>alert('ID Taruna tidak terdaftar! Harap periksa ID Anda.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi Fisik</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to right, #4b0082, #87cefa); /* Gradasi ungu tua ke biru muda */
             color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.1); /* Kartu dengan latar belakang transparan */
            color: white;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Warna latar belakang footer */
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto; /* Pindah footer ke bawah */
            width: 100%;
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.2); /* Warna latar belakang input */
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3); /* Warna latar belakang saat fokus */
            border-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Manajemen Taruna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="evaluasi_fisik.php">Evaluasi Fisik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="absensi.php">Absensi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .navbar:hover {
        background-color: rgba(0, 0, 0, 0.9); /* Sedikit lebih gelap saat hover */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bayangan saat hover */
    }

    .nav-link {
        padding: 10px 15px; /* Menambah padding untuk link */
        font-size: 1.1rem; /* Ukuran font yang lebih besar */
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2); /* Efek hover pada link */
        border-radius: 5px; /* Sudut bulat untuk link */
    }
</style>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Form Evaluasi Fisik</h4>
                    </div>
                    <div class="card-body">
                        <form action="evaluasi_fisik.php" method="POST">
                            <div class="mb-3">
                                <label for="taruna_id" class="form-label">ID Taruna:</label>
                                <input type="text" class="form-control" name="taruna_id" required>
                            </div>

                            <div class="mb-3">
                                <label for="push_up" class="form-label">Push Up:</label>
                                <input type="number" class="form-control" name="push_up" required>
                                <small class="form-text text-muted">Jumlah push-up yang dilakukan.</small>
                            </div>
                            <div class="mb-3">
                                <label for="pull_up" class="form-label">Pull Up:</label>
                                <input type="number" class="form-control" name="pull_up" required>
                                <small class="form-text text-muted">Jumlah pull-up yang dilakukan.</small>
                            </div>
                            <div class="mb-3">
                                <label for="sit_up" class="form-label">Sit Up:</label>
                                <input type="number" class="form-control" name="sit_up" required>
                                <small class="form-text text-muted">Jumlah sit-up yang dilakukan.</small>
                            </div>
                            <div class="mb-3">
                                <label for="lari_12_menit" class="form-label">Lari 12 Menit:</label>
                                <input type="number" class="form-control" name="lari_12_menit" required>
                                <small class="form-text text-muted">Jarak tempuh dalam meter.</small>
                            </div>
                            <div class="mb-3">
                                <label for="shuttle_run" class="form-label">Shuttle Run:</label>
                                <input type="number" step="0.01" class="form-control" name="shuttle_run" required>
                                <small class="form-text text-muted">Waktu tempuh dalam detik.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 BrianRajendra</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
