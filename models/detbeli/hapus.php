<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode    = $_POST['kode'];

//menginput data ke databse
$sql = mysqli_query($koneksi, "DELETE FROM tb_detailbeli WHERE kode = '$kode'");

if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../detbeli.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
