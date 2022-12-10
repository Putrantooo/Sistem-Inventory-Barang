<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode    = $_POST['kode'];
$kd_payung    = $_POST['kd_payung'];
$jumlah   = $_POST['jumlah'];

$selSto = mysqli_query($koneksi, "SELECT * FROM tb_payung WHERE kd_payung = '$kd_payung'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['Stok'];
$sisa = $stok - $jumlah;

//menginput data ke databse
$sql = mysqli_query($koneksi, "DELETE FROM tb_produksifix WHERE kode = '$kode'");

if ($sql) {
	$upstok = mysqli_query($koneksi, "UPDATE tb_payung SET Stok='$sisa' WHERE kd_payung = '$kd_payung'");
	$_SESSION['message'] = "Data berhasil dihapus!";
	$_SESSION['msg_type'] = "primary";
	echo "<script>window.location='" . ('../../detproduksifix.php') . "';</script>";
} else {
	echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
