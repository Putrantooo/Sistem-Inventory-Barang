<?php
include '../../inc/koneksi.php';
$id_jenis    = $_POST['kode_produksi'];
$nama_jenis    = $_POST['Tanggal'];
$selSto = mysqli_query($koneksi, "SELECT * FROM tb_produksi WHERE kd_produksi = '$id_jenis'");
$sql = mysqli_query($koneksi, "INSERT INTO tb_produksi VALUES('$id_jenis','$nama_jenis')");
if ($sql) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../produksi.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
