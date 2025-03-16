<?php
// Memanggil file koneksi
include 'koneksi.php';

// Debug: Check if $koneksi is set
if (!isset($koneksi)) {
    die("Koneksi database tidak ditemukan. Periksa file koneksi.php.");
}

// Cek apakah parameter id_customer ada di URL
if (isset($_GET['id_customer'])) {
    $id_customer = $_GET['id_customer'];

    // Query untuk menghapus data customer berdasarkan id_customer
    $query = "DELETE FROM customer WHERE id_customer = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_customer);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman customer.php dengan pesan sukses
        header("Location: customer.php?status=deleted");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        die("Gagal menghapus data: " . $stmt->error);
    }
} else {
    // Jika parameter id_customer tidak ada, redirect ke halaman customer.php
    header("Location: customer.php");
    exit();
}

// Menutup koneksi
$koneksi->close();
?>