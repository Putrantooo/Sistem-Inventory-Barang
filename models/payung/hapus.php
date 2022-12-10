<?php
include '../../inc/koneksi.php';
$kd_payung    = $_POST['kd_payung'];
$sql = mysqli_query($koneksi, "DELETE FROM tb_payung WHERE kd_payung = '$kd_payung'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../payung.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
