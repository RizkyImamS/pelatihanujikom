<?php
// Memanggil file koneksi
require 'koneksi.php';

// Ambil ID item dari parameter URL
if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];

    // Query untuk mendapatkan data item berdasarkan ID
    $sql = "SELECT * FROM item WHERE id_item = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $id_item);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $item = $result->fetch_assoc();
        } else {
            die("Item tidak ditemukan.");
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("ID Item tidak ditemukan.");
}

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

    // Query untuk update data menggunakan prepared statement
    $sql = "UPDATE item 
            SET nama_item = ?, uom = ?, harga_beli = ?, harga_jual = ? 
            WHERE id_item = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssdds", $nama_item, $uom, $harga_beli, $harga_jual, $id_item);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data item berhasil diperbarui!";
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
                                        <h3 class="box-title">Form Edit Item</h3>
                                    </div>
                                    <form role="form" action="item-edit.php?id_item=<?= htmlspecialchars($id_item); ?>" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_item">ID Item</label>
                                                <input type="text" class="form-control" id="id_item" name="id_item" value="<?= htmlspecialchars($item['id_item']); ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_item">Nama Item</label>
                                                <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?= htmlspecialchars($item['nama_item']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="uom">UOM (Unit of Measure)</label>
                                                <input type="text" class="form-control" id="uom" name="uom" value="<?= htmlspecialchars($item['uom']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_beli">Harga Beli</label>
                                                <input type="number" step="0.01" class="form-control" id="harga_beli" name="harga_beli" value="<?= htmlspecialchars($item['harga_beli']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual</label>
                                                <input type="number" step="0.01" class="form-control" id="harga_jual" name="harga_jual" value="<?= htmlspecialchars($item['harga_jual']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <a href="item.php" class="btn btn-danger">Batal</a>
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