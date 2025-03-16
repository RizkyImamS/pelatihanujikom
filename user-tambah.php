<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $nama_user = htmlspecialchars(trim($_POST['nama_user']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $id_level = htmlspecialchars(trim($_POST['id_level']));

    // Validasi input tidak boleh kosong
    if (empty($nama_user) || empty($username) || empty($password) || empty($id_level)) {
        die("Harap isi semua field yang wajib.");
    }

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk insert data menggunakan prepared statement
    $sql = "INSERT INTO users (nama_user, username, password, id_level) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("sssi", $nama_user, $username, $hashed_password, $id_level);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data user berhasil ditambahkan!";
            header("Location: user.php"); // Redirect ke halaman daftar user
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Error: " . $koneksi->error;
    }

    // Tutup koneksi
    $koneksi->close();
}

// Query untuk mengambil data level
$query_level = "SELECT id_level, level FROM level";
$result_level = $koneksi->query($query_level);

if (!$result_level) {
    die("Error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Include Header -->
<?php include 'layout-header.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Include Sidebar -->
        <?php include 'layout-sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Include Topbar -->
                <?php include 'layout-topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="content-wrapper p-5">

                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Form Tambah User</h3>
                                    </div>
                                    <form role="form" action="user-tambah.php" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="nama_user">Nama User</label>
                                                <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan Nama User" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_level">Level</label>
                                                <select class="form-control" id="id_level" name="id_level" required>
                                                    <option value="">Pilih Level</option>
                                                    <?php while ($row = $result_level->fetch_assoc()) : ?>
                                                        <option value="<?= htmlspecialchars($row['id_level']); ?>">
                                                            <?= htmlspecialchars($row['level']); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="user.php" class="btn btn-danger">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- End of Main Content -->

                <!-- Include Footer -->
                <?php include 'layout-footer.php'; ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>