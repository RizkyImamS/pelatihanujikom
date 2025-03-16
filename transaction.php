<?php
// Memanggil file koneksi
include 'koneksi.php';

// Debug: Check if $koneksi is set
if (!isset($koneksi)) {
    die("Koneksi database tidak ditemukan. Periksa file koneksi.php.");
}

// Query untuk mengambil data transaksi dengan JOIN ke tabel item
$query = "SELECT transaction.id_transaction, transaction.id_item, item.nama_item, transaction.quantity, transaction.price, transaction.amount 
          FROM transaction 
          JOIN item ON transaction.id_item = item.id_item";
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
                    <h2 class="mb-3">Daftar Transaksi</h2>
                    <div class="text-right mb-3">
                        <a href="transaction-tambah.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Transaksi
                        </a>
                    </div>
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Transaksi</th>
                                <th>ID Item</th>
                                <th>Nama Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_transaction']); ?></td>
                                    <td><?= htmlspecialchars($row['id_item']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_item']); ?></td>
                                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                                    <td><?= htmlspecialchars($row['price']); ?></td>
                                    <td><?= htmlspecialchars($row['amount']); ?></td>
                                    <td class="d-flex">
                                        <a href="transaction-edit.php?id_transaction=<?= htmlspecialchars($row['id_transaction']); ?>" class="btn btn-warning btn-sm mr-2">Edit</a>
                                        <a href="transaction-hapus.php?id_transaction=<?= htmlspecialchars($row['id_transaction']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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