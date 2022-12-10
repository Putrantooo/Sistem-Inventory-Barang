<?php
include '../../inc/koneksi.php';
$kode_supplier    = $_POST['kode_supplier'];
$sql = mysqli_query($koneksi, "DELETE FROM tb_suplier WHERE kode_supplier = '$kode_supplier'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../pemasok.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
