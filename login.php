<?php
include 'db.php'; // Koneksi ke database
session_start(); // Mulai sesi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taruna_id = $_POST['taruna_id'];
    $password = $_POST['password'];

    // Cek kredensial pengguna
    $sql = "SELECT * FROM siswa WHERE id = '$taruna_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password (langsung, tanpa hash)
        if ($password === $user['password']) {
            $_SESSION['taruna_id'] = $taruna_id;
            header('Location: index.php'); // Redirect ke halaman utama
            exit;
        } else {
            $error = "ID atau Password salah!";
        }
    } else {
        $error = "ID atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: "Open Sans", sans-serif;
            color: #333333;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        .box-form {
            width: 80%;
            background: #FFFFFF;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            box-shadow: 0 0 20px 6px #090b6f85;
        }
        @media (max-width: 980px) {
            .box-form {
                flex-flow: wrap;
                text-align: center;
                align-content: center;
                align-items: center;
            }
        }
        .box-form .left {
            color: #FFFFFF;
            background-image: url("https://eduwara.com/ke-lapangan-cara-merdeka-belajar-smkn-3-yogyakarta");
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }
        .box-form .left .overlay {
            padding: 30px;
            width: 100%;
            height: 100%;
            background: rgba(89, 97, 249, 0.7);
            box-sizing: border-box;
        }
        .box-form .right {
            padding: 40px;
        }
        .box-form .right h5 {
            font-size: 6vmax;
            line-height: 0;
        }
        .box-form .right input {
            width: 100%;
            padding: 10px;
            margin-top: 25px;
            font-size: 16px;
            border: none;
            outline: none;
            border-bottom: 2px solid #B0B3B9;
        }
        .box-form .right button {
            float: right;
            color: #fff;
            font-size: 16px;
            padding: 12px 35px;
            border-radius: 50px;
            border: 0;
            outline: 0;
            box-shadow: 0px 4px 20px 0px #49c628a6;
            background-image: linear-gradient(135deg, #70F570 10%, #49C628 100%);
        }
        label {
            display: block;
            position: relative;
            margin-left: 30px;
        }
        label::before {
            content: ' \f00c';
            position: absolute;
            font-family: FontAwesome;
            background: transparent;
            border: 3px solid #70F570;
            border-radius: 4px;
            color: transparent;
            left: -30px;
            transition: all 0.2s linear;
        }
        label:hover::before {
            font-family: FontAwesome;
            content: ' \f00c';
            color: #fff;
            cursor: pointer;
            background: #70F570;
        }
        label span.text-checkbox {
            display: inline-block;
            height: auto;
            position: relative;
            cursor: pointer;
            transition: all 0.2s linear;
        }
        label input[type="checkbox"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 box-form">
                <div class="left">
                    <div class="overlay">
                        <h1>Selamat Datang!</h1>
                        <p>Silakan login untuk melanjutkan.</p>
                    </div>
                </div>
                <div class="right">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Login</h4>
                        </div>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="taruna_id" class="form-label">ID Taruna:</label>
                                    <input type="text" class="form-control" name="taruna_id" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
