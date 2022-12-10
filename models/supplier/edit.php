<?php
include '../../inc/koneksi.php';
$kode_supplier     = $_POST['kode_supplier'];
$nama    = $_POST['nama'];
$alamat           = $_POST['alamat'];
$telp          = $_POST['telp'];
$Status = $_POST['Status'];

$sql = mysqli_query($koneksi, "UPDATE tb_suplier SET nama = '$nama',alamat = '$alamat', telp = '$telp', Status_sup = '$Status' WHERE kode_supplier = '$kode_supplier'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil diubah!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../pemasok.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
