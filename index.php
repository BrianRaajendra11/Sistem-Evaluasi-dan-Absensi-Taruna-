<?php
session_start(); // Mulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['taruna_id'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit;
}

include 'db.php'; // Koneksi ke database

// Query untuk mendapatkan jumlah kehadiran per tanggal
$sql = "SELECT tanggal, COUNT(*) as jumlah_absensi FROM absensi WHERE status = 'Hadir' GROUP BY tanggal";
$result = $conn->query($sql);

// Menyimpan hasil
$labels = [];
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['tanggal']; 
        $data[] = $row['jumlah_absensi'];
    }
} else {
    echo "Tidak ada data absensi.";
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kegiatan Taruna</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
       body {
             background: linear-gradient(to right, #4b0082, #87cefa); /* Gradasi ungu tua ke biru muda */
             color: white;
            
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.8); /* Navbar transparan */
        }
        .navbar-brand,
        .nav-link {
            font-weight: bold;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background: rgba(255, 255, 255, 0.2); /* Kartu dengan latar belakang transparan */
            color: white;
            transition: transform 0.3s; /* Transition for card */
        }
        .card:hover {
            transform: scale(1.02); /* Slightly enlarge the card on hover */
        }
        .card-title {
            font-size: 1.5rem;
        }
        .btn-primary {
            background-color: #00bfff;
            border-color: #00bfff;
            transition: background-color 0.3s, transform 0.3s; /* Transition for background and transform */
        }
        .btn-primary:hover {
            background-color: #1e90ff;
            border-color: #1e90ff;
            transform: scale(1.05); /* Slightly enlarge the button on hover */
        }
        h1 {
            font-size: 2.5rem;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Latar belakang footer */
            padding: 10px 0; /* Padding untuk footer */
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
                    <a class="nav-link active" href="absensi.php">Absensi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="evaluasi_fisik.php">Evaluasi Fisik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
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


    <div class="container text-center">
        <h1>Selamat Datang di Dashboard Kegiatan Taruna</h1>
        <p class="lead">Pantau Absensi Dan Evaluasi Fisik Taruna Di Sini.</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Absensi Taruna</h5>
                        <p class="card-text">Lakukan absensi kehadiran dengan cepat dan mudah.</p>
                        <a href="absensi.php" class="btn btn-primary">Lihat Absensi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Evaluasi Fisik</h5>
                        <p class="card-text">Isi atau periksa hasil evaluasi fisik taruna.</p>
                        <a href="evaluasi_fisik.php" class="btn btn-primary">Lihat Evaluasi Fisik</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menambahkan bagian untuk grafik statistik kehadiran -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Statistik Kehadiran</h5>
                        <canvas id="attendanceChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="text-white">&copy; 2024 BrianRajendra. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = <?php echo json_encode($labels); ?>; // Data tanggal dari PHP
        const data = <?php echo json_encode($data); ?>; // Data jumlah absensi dari PHP

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const attendanceChart = new Chart(ctx, {
            type: 'bar', // Jenis grafik
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Kehadiran',
                    data: data,
                    backgroundColor: 'rgba(0, 191, 255, 0.6)', // Warna latar belakang
                    borderColor: 'rgba(0, 0, 255, 1)', // Warna garis
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true, // Mulai dari 0
                        title: {
                            display: true,
                            text: 'Jumlah Kehadiran'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
