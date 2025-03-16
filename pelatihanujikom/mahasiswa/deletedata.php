<?php
include 'koneksi.php';

$message = "";
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "DELETE FROM mahasiswa WHERE nim='$nim'";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success text-center'>Data mahasiswa dengan NIM <strong>$nim</strong> berhasil dihapus.</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body text-center">
                <h2 class="card-title text-danger">Hapus Data Mahasiswa</h2>
                <?php echo $message; ?>
                <a href="index.php" class="btn btn-primary mt-3">Kembali ke Daftar Mahasiswa</a>
            </div>
        </div>
    </div>
</body>
</html>
