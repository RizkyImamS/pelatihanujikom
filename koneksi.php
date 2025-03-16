<?php
// koneksi.php
$host = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$database = "koperasi_pegawai"; // Database name

// Create connection
$koneksi = new mysqli($host, $username, $password, $database);

// Check connection
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>