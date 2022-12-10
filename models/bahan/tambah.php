<?php
include '../../inc/koneksi.php';
$kode_bahan        = $_POST['kode_bahan'];
$nama_bahan    = $_POST['nama_bahan'];
$stok   = $_POST['stok'];
$harga	= $_POST['harga'];
$Status = $_POST['Status'];

if(empty($kode_bahan && $nama_bahan && $stok && $harga)){
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../bahan.php') . "';</script>";
		// header("location:bahan.php?failed");
}else{
	$sql = mysqli_query($koneksi, "INSERT INTO tb_bahan VALUES('$kode_bahan','$nama_bahan','$stok', '$harga', '$Status')");
	if ($sql) {
		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../bahan.php') . "';</script>";
	} else {
		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../bahan.php') . "';</script>";
	}
}