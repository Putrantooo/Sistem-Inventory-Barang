<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$id_pembelian    = $_POST['id_pembelian'];

//menginput data ke databse
$sql = mysqli_query($koneksi, "DELETE FROM tb_pembelian WHERE id_pembelian = '$id_pembelian'");

if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../beli.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
