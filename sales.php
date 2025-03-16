<?php
// Memanggil file koneksi
include 'koneksi.php';

// Debug: Check if $koneksi is set
if (!isset($koneksi)) {
    die("Koneksi database tidak ditemukan. Periksa file koneksi.php.");
}

// Query untuk mengambil data sales dengan JOIN ke tabel customer
$query = "SELECT sales.id_sales, sales.tgl_item, sales.id_customer, customer.nama_customer, sales.do_customer, sales.status
          FROM sales
          JOIN customer ON sales.id_customer = customer.id_customer";
$result = $koneksi->query($query);

if (!$result) {
    die("Query gagal: " . $koneksi->error);
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

                <div class="container-fluid">
                    <h2 class="mb-3">Daftar Sales</h2>
                    <div class="text-right mb-3">
                        <a href="sales-tambah.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Sales
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Sales</th>
                                <th>Tanggal Item</th>
                                <th>ID Customer</th>
                                <th>Nama Customer</th>
                                <th>DO Customer</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_sales']); ?></td>
                                    <td><?= htmlspecialchars($row['tgl_item']); ?></td>
                                    <td><?= htmlspecialchars($row['id_customer']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_customer']); ?></td>
                                    <td><?= htmlspecialchars($row['do_customer']); ?></td>
                                    <td><?= htmlspecialchars($row['status']); ?></td>
                                    <td class="d-flex">
                                        <a href="sales-edit.php?id_sales=<?= htmlspecialchars($row['id_sales']); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                        <a href="sales-hapus.php?id_sales=<?= htmlspecialchars($row['id_sales']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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

<?php
// Menutup koneksi setelah selesai digunakan
$koneksi->close();
?>