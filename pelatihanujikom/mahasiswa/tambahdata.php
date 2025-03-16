<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = $_POST['no'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $jurusan = $_POST['jurusan'];

    $sql = "INSERT INTO mahasiswa (no, nim, nama, gender, jurusan) VALUES ('$no', '$nim', '$nama', '$gender', '$jurusan')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Data berhasil ditambahkan.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <title>Tambah Data Mahasiswa</title>
</head>
<body class="container mt-4">
    <h2 class="text-center">Form Tambah Data Mahasiswa</h2>
    <div class="card p-4 shadow-lg">
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">No:</label>
                <input type="number" name="no" class="form-control" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label">NIM:</label>
                <input type="text" name="nim" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Laki-laki" class="form-check-input" required>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Perempuan" class="form-check-input" required>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jurusan:</label>
                <input type="text" name="jurusan" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</body>
</html>
