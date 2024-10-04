<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: admin_login.php');
    exit;
}

include '../db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk update data siswa
    $sql = "UPDATE siswa SET nama=?, email=?, password=? WHERE id=?";
    
    // Siapkan statement dan bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $email, $password, $id);

    if ($stmt->execute()) {
        // Redirect ke halaman manage_user.php setelah update berhasil
        header("Location: manage_user.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Mengambil data siswa yang akan diedit
$sql = "SELECT * FROM siswa WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$siswa = $result->fetch_assoc();

// Tutup statement
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $siswa['nama']; ?>" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $siswa['email']; ?>" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $siswa['password']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
