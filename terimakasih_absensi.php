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
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #6a5acd, #00bfff); /* Gradasi ungu ke biru muda */
            margin: 0;
            flex-direction: column; /* Allow footer to be below the content */
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent white background */
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-custom:focus {
            box-shadow: none;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Warna latar belakang footer */
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto; /* Footer di bawah */
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="display-4">Terima Kasih!</h2>
            <p class="lead">Data absensi Anda telah berhasil disimpan.</p>
            <a href="index.php">
                <button class="btn btn-custom">Kembali ke Menu Awal</button>
            </a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 BrianRajendra</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
