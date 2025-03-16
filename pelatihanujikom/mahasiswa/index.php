<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_mahasiswa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM mahasiswa");
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Daftar Mahasiswa</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['no']; ?></td>
                        <td><?php echo $row['nim']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['jurusan']; ?></td>
                        <td>
                            <a href="editdata.php?nim=<?php echo $row['nim']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="deletedata.php?nim=<?php echo $row['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <a href="tambahdata.php" class="btn btn-primary">Tambah Mahasiswa</a>
    </div>
</body>
</html>
