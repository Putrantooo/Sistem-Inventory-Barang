<?php
include '../../inc/koneksi.php';
$kd_payung    = $_POST['kd_payung'];
$Nama    = $_POST['Nama'];
$id_kategori    = $_POST['id_kategori'];
$Stok    = $_POST['Stok'];
$Harga    = $_POST['Harga'];
$sql = mysqli_query($koneksi, "UPDATE tb_payung SET Nama = '$Nama', id_kategori = '$id_kategori', Stok = '$Stok', Harga = '$Harga' WHERE kd_payung = '$kd_payung'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil diubah!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../payung.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
