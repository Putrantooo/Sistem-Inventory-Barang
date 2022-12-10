<?php
include '../../inc/koneksi.php';

$kode = $_POST['kode'];
$kd_produksi        = $_POST['kd_produksi'];
$kd_payung    = $_POST['kd_payung'];
$jumlah   = $_POST['jumlah'];

if (empty($kd_produksi && $kd_payung && $jumlah)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../detproduksifix.php') . "';</script>";	
}else{
	$selSto = mysqli_query($koneksi, "SELECT * FROM tb_payung WHERE kd_payung = '$kd_payung'");
	$sto = mysqli_fetch_array($selSto);
	$stok = $sto['Stok'];
	$sisa = $stok + $jumlah;
	$sql = mysqli_query($koneksi, "INSERT INTO tb_produksifix VALUES (0,'$kd_produksi','$kd_payung','$jumlah')");
	if ($sql) {
		$upstok = mysqli_query($koneksi, "UPDATE tb_payung SET Stok='$sisa' WHERE kd_payung = '$kd_payung'");
		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detproduksifix.php') . "';</script>";
	} else {
		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detproduksifix.php') . "';</script>";
	}
}