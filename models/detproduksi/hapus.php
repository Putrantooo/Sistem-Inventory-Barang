<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode    = $_POST['kode'];
$kode_bahan    = $_POST['kode_bahan'];
$jumlah   = $_POST['jumlah'];

$selSto = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE kode_bahan = '$kode_bahan'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['stok'];
$sisa = $stok + $jumlah;

//menginput data ke databse
$sql = mysqli_query($koneksi, "DELETE FROM tb_detailproduksi WHERE kode = '$kode'");

if ($sql) {
	$upstok = mysqli_query($koneksi, "UPDATE tb_bahan SET stok='$sisa' WHERE kode_bahan = '$kode_bahan'");
	$_SESSION['message'] = "Data berhasil dihapus!";
	$_SESSION['msg_type'] = "primary";
	echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
} else {
	echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
