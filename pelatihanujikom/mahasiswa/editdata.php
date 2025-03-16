<?php
include 'koneksi.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $result = $conn->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = $_POST['no'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $jurusan = $_POST['jurusan'];

    $sql = "UPDATE mahasiswa SET nim='$nim', nama='$nama', gender='$gender', jurusan='$jurusan' WHERE no='$no'";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Data berhasil diperbarui.</div>";
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
    <title>Edit Data Mahasiswa</title>
</head>
<body class="container mt-4">
    <h2 class="text-center">Form Edit Data Mahasiswa</h2>
    <div class="card p-4 shadow-lg">
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">No:</label>
                <input type="number" name="no" class="form-control" value="<?php echo $row['no']; ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label">NIM:</label>
                <input type="text" name="nim" class="form-control" value="<?php echo $row['nim']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nama:</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Laki-laki" class="form-check-input" <?php if($row['gender'] == 'Laki-laki') echo 'checked'; ?> >
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="gender" value="Perempuan" class="form-check-input" <?php if($row['gender'] == 'Perempuan') echo 'checked'; ?> >
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Jurusan:</label>
                <input type="text" name="jurusan" class="form-control" value="<?php echo $row['jurusan']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-success">Update</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</body>
</html>
