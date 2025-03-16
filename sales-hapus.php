<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah parameter id_sales ada di URL
if (isset($_GET['id_sales'])) {
    $id_sales = $_GET['id_sales'];

    // Query untuk menghapus data sales berdasarkan id_sales
    $sql = "DELETE FROM sales WHERE id_sales = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id_sales);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data sales berhasil dihapus!";
            header("Location: sales.php"); // Redirect ke halaman daftar sales
            exit();
        } else {
            die("Error: Gagal menghapus data sales. " . $stmt->error);
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("Error: ID Sales tidak ditemukan.");
}

// Tutup koneksi
$koneksi->close();
?>