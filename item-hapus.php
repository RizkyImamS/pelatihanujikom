<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah parameter id_item ada di URL
if (isset($_GET['id_item'])) {
    $id_item = $_GET['id_item'];

    // Query untuk menghapus data item berdasarkan id_item
    $sql = "DELETE FROM item WHERE id_item = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("s", $id_item);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data item berhasil dihapus!";
            header("Location: item.php"); // Redirect ke halaman daftar item
            exit();
        } else {
            die("Error: Gagal menghapus data item. " . $stmt->error);
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("Error: ID Item tidak ditemukan.");
}

// Tutup koneksi
$koneksi->close();
?>