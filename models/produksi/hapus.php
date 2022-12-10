<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$id    = $_POST['kd_produksi'];

//menginput data ke databse
$sql = mysqli_query($koneksi, "DELETE FROM tb_produksi WHERE kd_produksi = '$id'");

if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../produksi.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
