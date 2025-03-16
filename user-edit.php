<?php
// Memanggil file koneksi
require 'koneksi.php';

// Ambil ID user dari parameter URL
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Query untuk mengambil data user berdasarkan ID
    $sql = "SELECT * FROM users WHERE id_user = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        } else {
            die("User tidak ditemukan.");
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("ID User tidak ditemukan.");
}

// Query untuk mengambil data level
$query_level = "SELECT id_level, level FROM level";
$result_level = $koneksi->query($query_level);

if (!$result_level) {
    die("Error: " . $koneksi->error);
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $nama_user = htmlspecialchars(trim($_POST['nama_user']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $id_level = htmlspecialchars(trim($_POST['id_level']));

    // Validasi input tidak boleh kosong
    if (empty($nama_user) || empty($username) || empty($id_level)) {
        die("Harap isi semua field yang wajib.");
    }

    // Jika password diisi, hash password baru
    $password_update = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $row['password'];

    // Query untuk update data menggunakan prepared statement
    $sql = "UPDATE users 
            SET nama_user = ?, username = ?, password = ?, id_level = ? 
            WHERE id_user = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("sssii", $nama_user, $username, $password_update, $id_level, $id_user);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data user berhasil diperbarui!";
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
                                        <h3 class="box-title">Form Edit User</h3>
                                    </div>
                                    <form role="form" action="user-edit.php?id_user=<?= htmlspecialchars($id_user); ?>" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="nama_user">Nama User</label>
                                                <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?= htmlspecialchars($row['nama_user']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($row['username']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_level">Level</label>
                                                <select class="form-control" id="id_level" name="id_level" required>
                                                    <option value="">Pilih Level</option>
                                                    <?php while ($level = $result_level->fetch_assoc()) : ?>
                                                        <option value="<?= htmlspecialchars($level['id_level']); ?>" <?= ($level['id_level'] == $row['id_level']) ? 'selected' : ''; ?>>
                                                            <?= htmlspecialchars($level['level']); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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