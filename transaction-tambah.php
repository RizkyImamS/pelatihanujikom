<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan input
    $id_item = htmlspecialchars(trim($_POST['id_item']));
    $quantity = htmlspecialchars(trim($_POST['quantity']));
    $price = htmlspecialchars(trim($_POST['price']));

    // Validasi input tidak boleh kosong
    if (empty($id_item) || empty($quantity) || empty($price)) {
        die("Harap isi semua field yang wajib.");
    }

    // Hitung amount (quantity * price)
    $amount = $quantity * $price;

    // Query untuk insert data menggunakan prepared statement
    $sql = "INSERT INTO transaction (id_item, quantity, price, amount) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("iidd", $id_item, $quantity, $price, $amount);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data transaksi berhasil ditambahkan!";
            header("Location: transaction.php"); // Redirect ke halaman daftar transaksi
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

// Query untuk mengambil data item beserta harga_jual
$query_item = "SELECT id_item, nama_item, harga_jual FROM item";
$result_item = $koneksi->query($query_item);

if (!$result_item) {
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
                                        <h3 class="box-title">Form Tambah Transaksi</h3>
                                    </div>
                                    <form role="form" action="transaction-tambah.php" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_item">Item</label>
                                                <select class="form-control" id="id_item" name="id_item" required>
                                                    <option value="">Pilih Item</option>
                                                    <?php while ($row = $result_item->fetch_assoc()) : ?>
                                                        <option value="<?= htmlspecialchars($row['id_item']); ?>" data-harga-jual="<?= htmlspecialchars($row['harga_jual']); ?>">
                                                            <?= htmlspecialchars($row['nama_item']); ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Quantity" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Harga akan terisi otomatis" readonly required>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="transaction.php" class="btn btn-danger">Batal</a>
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

    <script>
        // JavaScript untuk mengambil harga_jual saat item dipilih
        document.getElementById('id_item').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const hargaJual = selectedOption.getAttribute('data-harga-jual');
            document.getElementById('price').value = hargaJual;
        });
    </script>
</body>

</html>