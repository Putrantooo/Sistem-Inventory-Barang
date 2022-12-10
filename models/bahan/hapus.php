<?php
include '../../inc/koneksi.php';
$id_barang_masuk    = $_POST['kode_bahan'];
$sql = mysqli_query($koneksi, "DELETE FROM tb_bahan WHERE kode_bahan = '$id_barang_masuk'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../bahan.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
