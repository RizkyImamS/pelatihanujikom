<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $id_item = htmlspecialchars(trim($_POST['id_item']));
    $nama_item = htmlspecialchars(trim($_POST['nama_item']));
    $uom = htmlspecialchars(trim($_POST['uom']));
    $harga_beli = htmlspecialchars(trim($_POST['harga_beli']));
    $harga_jual = htmlspecialchars(trim($_POST['harga_jual']));

    // Validasi input tidak boleh kosong
    if (empty($id_item) || empty($nama_item) || empty($uom) || empty($harga_beli) || empty($harga_jual)) {
        die("Harap isi semua field yang wajib.");
    }

    // Query untuk insert data menggunakan prepared statement
    $sql = "INSERT INTO item (id_item, nama_item, uom, harga_beli, harga_jual) 
            VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("sssdd", $id_item, $nama_item, $uom, $harga_beli, $harga_jual);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data item berhasil ditambahkan!";
            header("Location: item.php"); // Redirect ke halaman daftar item
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
                                        <h3 class="box-title">Form Tambah Item</h3>
                                    </div>
                                    <form role="form" action="item-tambah.php" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_item">ID Item</label>
                                                <input type="text" class="form-control" id="id_item" name="id_item" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_item">Nama Item</label>
                                                <input type="text" class="form-control" id="nama_item" name="nama_item" placeholder="Masukkan Nama Item" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="uom">UOM (Unit of Measure)</label>
                                                <input type="text" class="form-control" id="uom" name="uom" placeholder="Masukkan UOM" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_beli">Harga Beli</label>
                                                <input type="number" step="0.01" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Beli" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual</label>
                                                <input type="number" step="0.01" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual" required>
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