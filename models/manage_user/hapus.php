<?php
include '../../inc/koneksi.php';
$id_user    = $_POST['id_user'];
$sql = mysqli_query($koneksi, "DELETE FROM tb_login WHERE id = '$id_user'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../manage_user.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
