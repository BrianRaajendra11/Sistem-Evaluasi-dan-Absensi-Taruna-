<?php
session_start(); // Mulai sesi
include 'db.php'; // Menghubungkan ke database

// Periksa apakah ada ID Taruna di session dari evaluasi_fisik.php
if (!isset($_SESSION['taruna_id_evaluasi'])) {
    echo "ID Taruna tidak ditemukan. Harap isi formulir evaluasi fisik terlebih dahulu.";
    exit; // Hentikan eksekusi jika ID Taruna tidak ada
}

$taruna_id = $_SESSION['taruna_id_evaluasi']; // Ambil ID Taruna dari sesi

// Query untuk mengambil data evaluasi fisik berdasarkan ID Taruna
$sql = "SELECT * FROM evaluasi_fisik WHERE taruna_id = '$taruna_id' ORDER BY tanggal DESC";
$result = $conn->query($sql); // Eksekusi query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Evaluasi Fisik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc); /* Gradient background */
            color: #fff;
        }
        .container {
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 800px;
        }
        h2 {
            color: #333;
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
        <h2>Hasil Evaluasi Fisik untuk ID Taruna: <?php echo htmlspecialchars($taruna_id); ?></h2>
        <?php if ($result->num_rows > 0): ?>
            <table id="table-id" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Taruna</th>
                        <th>Tanggal</th>
                        <th>Push Up</th>
                        <th>Pull Up</th>
                        <th>Sit Up</th>
                        <th>Lari 12 Menit</th>
                        <th>Shuttle Run</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['taruna_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        <td><?php echo htmlspecialchars($row['push_up']); ?></td>
                        <td><?php echo htmlspecialchars($row['pull_up']); ?></td>
                        <td><?php echo htmlspecialchars($row['sit_up']); ?></td>
                        <td><?php echo htmlspecialchars($row['lari_12_menit']); ?></td>
                        <td><?php echo htmlspecialchars($row['shuttle_run']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-3">
                <a href="#" id="download-pdf" class="btn btn-success">Download as PDF</a>
                <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Belum ada data evaluasi fisik untuk ID Taruna ini.</div>
            <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
        <?php endif; ?>
    </div>

    <footer>
        <p>© 2024 BrianRajendra</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.9/jspdf.plugin.autotable.min.js"></script>

    <script>
      // Fungsi untuk mengenerate file PDF
      function generatePdf() {
          var doc = new jsPDF();
          var table = document.getElementById('table-id');
          var rows = [];

          // Ambil data dari tabel
          for (var i = 0; i < table.rows.length; i++) {
              var row = [];
              for (var j = 0; j < table.rows[i].cells.length; j++) {
                  row.push(table.rows[i].cells[j].innerText);
              }
              rows.push(row);
          }

          // Buat tabel di PDF
          doc.autoTable({
              head: [rows[0]], // Header
              body: rows.slice(1), // Data (exclude header)
              theme: 'grid', // Tema tabel
              margin: { top: 10 }, // Margin atas
          });

          // Simpan PDF
          doc.save('hasil-evaluasi-fisik.pdf');
      }

      // Event listener untuk tombol download PDF
      document.getElementById('download-pdf').addEventListener('click', generatePdf);
    </script>
</body>
</html>
