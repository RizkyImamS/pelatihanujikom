<?php
// Memanggil file koneksi
require 'koneksi.php';

// Ambil keyword pencarian dari parameter GET
$keyword = isset($_GET['keyword']) ? htmlspecialchars(trim($_GET['keyword'])) : '';

// Query untuk mencari data item berdasarkan keyword
$sql = "SELECT * FROM item 
        WHERE nama_item LIKE ? OR uom LIKE ? OR id_item LIKE ?";
$stmt = $koneksi->prepare($sql);
$searchKeyword = "%$keyword%";
$stmt->bind_param("sss", $searchKeyword, $searchKeyword, $searchKeyword);
$stmt->execute();
$result = $stmt->get_result();

// Tampilkan hasil pencarian
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_item']}</td>
                <td>{$row['nama_item']}</td>
                <td>{$row['uom']}</td>
                <td>{$row['harga_beli']}</td>
                <td>{$row['harga_jual']}</td>
                <td>
                    <a href='item-edit.php?id_item={$row['id_item']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='item-hapus.php?id_item={$row['id_item']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Tidak ada data ditemukan.</td></tr>";
}

// Tutup koneksi
$stmt->close();
$koneksi->close();
?>