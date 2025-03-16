<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $tgl_item = htmlspecialchars(trim($_POST['tgl_item']));
    $id_customer = htmlspecialchars(trim($_POST['id_customer']));
    $do_customer = htmlspecialchars(trim($_POST['do_customer']));
    $status = htmlspecialchars(trim($_POST['status']));

    // Validasi input tidak boleh kosong
    if (empty($tgl_item) || empty($id_customer) || empty($do_customer) || empty($status)) {
        die("Harap isi semua field yang wajib.");
    }

    // Query untuk insert data menggunakan prepared statement
    $sql = "INSERT INTO sales (tgl_item, id_customer, do_customer, status) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("siss", $tgl_item, $id_customer, $do_customer, $status);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data sales berhasil ditambahkan!";
            header("Location: sales.php"); // Redirect ke halaman daftar sales
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

// Query untuk mengambil data customer
$query_customer = "SELECT id_customer, nama_customer FROM customer";
$result_customer = $koneksi->query($query_customer);

if (!$result_customer) {
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
                                        <h3 class="box-title">Form Tambah Sales</h3>
                                    </div>
                                    <form role="form" action="sales-tambah.php" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="tgl_item">Tanggal Item</label>
                                                <input type="date" class="form-control" id="tgl_item" name="tgl_item" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_customer">Customer</label>
                                                <select class="form-control" id="id_customer" name="id_customer" required>
                                                    <option value="">Pilih Customer</option>
                                                    <?php while ($row = $result_customer->fetch_assoc()) : ?>
                                                        <option value="<?= htmlspecialchars($row['id_customer']); ?>">
                                                            <?= htmlspecialchars($row['nama_customer']); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="do_customer">DO Customer</label>
                                                <input type="text" class="form-control" id="do_customer" name="do_customer" placeholder="Masukkan DO Customer" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="Pending">Pending</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="sales.php" class="btn btn-danger">Batal</a>
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