<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $id_customer = htmlspecialchars(trim($_POST['id_customer']));
    $nama_customer = htmlspecialchars(trim($_POST['nama_customer']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $telp = htmlspecialchars(trim($_POST['telp']));
    $fax = htmlspecialchars(trim($_POST['fax']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Validasi input tidak boleh kosong
    if (empty($id_customer) || empty($nama_customer) || empty($alamat) || empty($telp) || empty($email)) {
        die("Harap isi semua field yang wajib.");
    }

    // Query untuk insert data menggunakan prepared statement
    $sql = "INSERT INTO customer (id_customer, nama_customer, alamat, telp, fax, email) 
    VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssssss", $id_customer, $nama_customer, $alamat, $telp, $fax, $email);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data customer berhasil ditambahkan!";
            header("Location: customer.php"); // Redirect ke halaman daftar customer
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
                                        <h3 class="box-title">Form Tambah Customer</h3>
                                    </div>
                                    <form role="form" action="customer-tambah.php" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_customer">ID Customer</label>
                                                <input type="text" class="form-control" id="id_customer" name="id_customer" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_customer">Nama Customer</label>
                                                <input type="text" class="form-control" id="nama_customer" name="nama_customer" placeholder="Masukkan Nama Customer" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">Telepon</label>
                                                <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fax">Fax</label>
                                                <input type="text" class="form-control" id="fax" name="fax" placeholder="Masukkan Nomor Fax">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>