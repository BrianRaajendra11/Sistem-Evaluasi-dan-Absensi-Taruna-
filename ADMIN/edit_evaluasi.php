<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taruna_id = $_POST['taruna_id'];
    $tanggal = $_POST['tanggal'];
    $push_up = $_POST['push_up'];
    $pull_up = $_POST['pull_up'];
    $sit_up = $_POST['sit_up'];
    $lari_12_menit = $_POST['lari_12_menit'];
    $shuttle_run = $_POST['shuttle_run'];

    $sql = "UPDATE evaluasi_fisik SET taruna_id='$taruna_id', tanggal='$tanggal', push_up='$push_up', pull_up='$pull_up', sit_up='$sit_up', lari_12_menit='$lari_12_menit', shuttle_run='$shuttle_run' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_evaluasi.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Mengambil data evaluasi fisik
$sql = "SELECT * FROM evaluasi_fisik WHERE id='$id'";
$result = $conn->query($sql);
$evaluasi = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Evaluasi Fisik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Evaluasi Fisik</h2>
        <form method="POST">
            <div class="mb-3">
                <label>ID Taruna</label>
                <input type="text" name="taruna_id" class="form-control" value="<?php echo $evaluasi['taruna_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $evaluasi['tanggal']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Push Up</label>
                <input type="number" name="push_up" class="form-control" value="<?php echo $evaluasi['push_up']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Pull Up</label>
                <input type="number" name="pull_up" class="form-control" value="<?php echo $evaluasi['pull_up']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Sit Up</label>
                <input type="number" name="sit_up" class="form-control" value="<?php echo $evaluasi['sit_up']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Lari 12 Menit</label>
                <input type="number" name="lari_12_menit" class="form-control" value="<?php echo $evaluasi['lari_12_menit']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Shuttle Run</label>
                <input type="number" name="shuttle_run" class="form-control" value="<?php echo $evaluasi['shuttle_run']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</body>
</html>
