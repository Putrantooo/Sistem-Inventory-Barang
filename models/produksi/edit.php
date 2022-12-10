<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$id_jenis    = $_POST['kode_produksi'];
$nama_jenis    = $_POST['Tanggal'];

//menginput data ke databse
$sql = mysqli_query($koneksi, "UPDATE tb_produksi SET Tanggal = '$nama_jenis' WHERE kd_produksi = '$id_jenis'");

if ($sql) {
    $_SESSION['message'] = "Data berhasil diubah!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../produksi.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
