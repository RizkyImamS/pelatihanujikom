<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Barang</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Tambah Data Barang</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $no = $_POST['no'];
            $nama_merek = $_POST['nama_merek'];
            $warna = $_POST['warna'];
            $jumlah = $_POST['jumlah'];
            
            // Koneksi ke database (gantilah dengan kredensial Anda)
            $conn = new mysqli("localhost", "root", "", "data");
            
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }
            
            $sql = "INSERT INTO printer (no, nama_merek, warna, jumlah) VALUES ('$no', '$nama_merek', '$warna', '$jumlah')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
            
            $conn->close();
        }
        ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="no" class="form-label">No</label>
                <input type="text" class="form-control" id="no" name="no" required>
            </div>
            <div class="mb-3">
                <label for="nama_merek" class="form-label">Nama Merek</label>
                <input type="text" class="form-control" id="nama_merek" name="nama_merek" required>
            </div>
            <div class="mb-3">
                <label for="warna" class="form-label">Warna</label>
                <input type="text" class="form-control" id="warna" name="warna" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </form>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>