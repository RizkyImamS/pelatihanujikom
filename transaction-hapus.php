<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah parameter id_transaction ada di URL
if (isset($_GET['id_transaction'])) {
    $id_transaction = $_GET['id_transaction'];

    // Query untuk menghapus data transaksi berdasarkan id_transaction
    $sql = "DELETE FROM transaction WHERE id_transaction = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id_transaction);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data transaksi berhasil dihapus!";
            header("Location: transaction.php"); // Redirect ke halaman daftar transaksi
            exit();
        } else {
            die("Error: Gagal menghapus data transaksi. " . $stmt->error);
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("Error: ID Transaksi tidak ditemukan.");
}

// Tutup koneksi
$koneksi->close();
?>