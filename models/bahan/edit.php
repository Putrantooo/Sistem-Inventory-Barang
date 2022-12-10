<?php
include '../../inc/koneksi.php';
$kode_bahan = $_POST['kode_bahan'];
$nama_bahan    = $_POST['nama_bahan'];
$stok   = $_POST['stok'];
$harga   = $_POST['harga'];
$Status = $_POST['Status'];

$sql = mysqli_query($koneksi, "UPDATE tb_bahan SET nama_bahan = '$nama_bahan', 
stok = '$stok', harga = '$harga', Status = '$Status' WHERE kode_bahan = '$kode_bahan'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../bahan.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}