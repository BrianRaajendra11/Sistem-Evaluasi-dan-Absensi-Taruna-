<?php
include 'db.php'; // Koneksi ke database
session_start(); // Mulai sesi jika diperlukan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taruna_id = $_POST['taruna_id'];
    $tanggal = date('Y-m-d'); // Ambil tanggal saat ini
    $status = $_POST['status'];

    // Cek jika taruna_id valid di tabel siswa
    $sql_check = "SELECT * FROM siswa WHERE id = '$taruna_id'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Insert data ke tabel absensi
        $sql = "INSERT INTO absensi (taruna_id, tanggal, status) VALUES ('$taruna_id', '$tanggal', '$status')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect ke halaman terima kasih setelah data tersimpan
            header('Location: terimakasih_absensi.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "ID Taruna tidak ditemukan di tabel siswa!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to right, #4b0082, #87cefa); /* Gradasi ungu tua ke biru muda */
            color: white;   
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Full height */
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.8); /* Navbar transparan */
        }
        .card {
            background: rgba(255, 255, 255, 0.2); /* Kartu dengan latar belakang transparan */
            color: white;
            margin-bottom: 20px; /* Spasi di bawah kartu */
        }
        .card-header {
            background-color: #00bfff; /* Warna latar belakang header kartu */
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Warna latar belakang footer */
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto; /* Pindah footer ke bawah */
            width: 100%;
        }
        .container {
            flex: 1; /* Menggunakan sisa ruang */
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
                    <div class="card-header text-white">
                        <h4 class="mb-0">Form Absensi Taruna</h4>
                    </div>
                    <div class="card-body">
                        <form action="absensi.php" method="POST">
                            <div class="mb-3">
                                <label for="taruna_id" class="form-label">ID Taruna:</label>
                                <input type="text" class="form-control" name="taruna_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Kehadiran:</label>
                                <select class="form-select" name="status" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpha">Alpha</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <footer>
        <p>&copy; 2024 BrianRajendra</p>
    </footer>
</body>
</html>
