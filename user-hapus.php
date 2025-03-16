<?php
// Memanggil file koneksi
require 'koneksi.php';

// Cek apakah parameter id_user ada di URL
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    // Query untuk menghapus data user berdasarkan id_user
    $sql = "DELETE FROM users WHERE id_user = ?";
    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id_user);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "Data user berhasil dihapus!";
            header("Location: user.php"); // Redirect ke halaman daftar user
            exit();
        } else {
            die("Error: Gagal menghapus data user. " . $stmt->error);
        }

        // Tutup statement
        $stmt->close();
    } else {
        die("Error: " . $koneksi->error);
    }
} else {
    die("Error: ID User tidak ditemukan.");
}

// Tutup koneksi
$koneksi->close();
?>