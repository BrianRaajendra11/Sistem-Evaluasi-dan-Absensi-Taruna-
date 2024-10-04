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
    $status = $_POST['status'];

    $sql = "UPDATE absensi SET taruna_id='$taruna_id', tanggal='$tanggal', status='$status' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_absensi.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Mengambil data absensi
$sql = "SELECT * FROM absensi WHERE id='$id'";
$result = $conn->query($sql);
$absensi = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Absensi</h2>
        <form method="POST">
            <div class="mb-3">
                <label>ID Taruna</label>
                <input type="text" name="taruna_id" class="form-control" value="<?php echo $absensi['taruna_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $absensi['tanggal']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <input type="text" name="status" class="form-control" value="<?php echo $absensi['status']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
</body>
</html>
