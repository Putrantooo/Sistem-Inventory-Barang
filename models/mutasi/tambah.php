<?php
include '../../inc/koneksi.php';
$kd_mutasi        = $_POST['kd_mutasi'];
$Tanggal    			= $_POST['Tanggal'];
$sql = mysqli_query($koneksi, "INSERT INTO tb_mutasi VALUES ('$kd_mutasi','$Tanggal')");
if ($sql) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../mutasi.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
