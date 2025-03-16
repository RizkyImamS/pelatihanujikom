<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "data"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$kode_barang = $_POST['no'];
$nama_barang = $_POST['nama_merek'];
$kategori = $_POST['warna'];
$harga = $_POST['jumlah'];

// Menyimpan data ke database
$sql = "INSERT INTO printer (no, nama_merek, warna, jumlah) 
        VALUES ('$no', '$nama_merek', '$warna', $jumlah)";

if ($conn->query($sql) === TRUE) {
    echo "Data barang berhasil ditambahkan!";
    echo "<br><a href='database_printer.php'>Tambah Barang Lagi</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
