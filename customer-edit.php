<?php
// Memanggil file koneksi
require 'koneksi.php';

// Ambil ID customer dari parameter URL
if (isset($_GET['id_customer'])) {
    $id_customer = $_GET['id_customer'];

    // Query untuk mendapatkan data customer berdasarkan ID
    $sql = "SELECT * FROM customer WHERE id_customer = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $id_customer);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();
        $stmt->close();
    }
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_customer = htmlspecialchars(trim($_POST['id_customer']));
    $nama_customer = htmlspecialchars(trim($_POST['nama_customer']));
    $alamat = htmlspecialchars(trim($_POST['alamat']));
    $telp = htmlspecialchars(trim($_POST['telp']));
    $fax = htmlspecialchars(trim($_POST['fax']));
    $email = htmlspecialchars(trim($_POST['email']));

    // Query untuk update data
    $sql = "UPDATE customer SET nama_customer=?, alamat=?, telp=?, fax=?, email=? WHERE id_customer=?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("ssssss", $nama_customer, $alamat, $telp, $fax, $email, $id_customer);
        if ($stmt->execute()) {
            echo "Data customer berhasil diperbarui!";
            header("Location: customer.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'layout-header.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'layout-sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'layout-topbar.php'; ?>
                <div class="content-wrapper p-5">
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Form Edit Customer</h3>
                                    </div>
                                    <form role="form" action="customer-edit.php?id_customer=<?php echo $id_customer; ?>" method="POST">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="id_customer">ID Customer</label>
                                                <input type="text" class="form-control" id="id_customer" name="id_customer" value="<?php echo $customer['id_customer']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_customer">Nama Customer</label>
                                                <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="<?php echo $customer['nama_customer']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $customer['alamat']; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">Telepon</label>
                                                <input type="text" class="form-control" id="telp" name="telp" value="<?php echo $customer['telp']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fax">Fax</label>
                                                <input type="text" class="form-control" id="fax" name="fax" value="<?php echo $customer['fax']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['email']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            <a href="customer.php" class="btn btn-danger">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php include 'layout-footer.php'; ?>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
