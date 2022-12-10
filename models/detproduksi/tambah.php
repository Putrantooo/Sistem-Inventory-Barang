<?php
include '../../inc/koneksi.php';

$kode = $_POST['kode'];
$kd_produksi        = $_POST['kd_produksi'];
$kode_bahan    = $_POST['kode_bahan'];
$jumlah   = $_POST['jumlah'];

if (empty($kd_produksi && $kode_bahan && $jumlah)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
}else{
	$selSto = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE kode_bahan = '$kode_bahan'");
	$sto = mysqli_fetch_array($selSto);
	$stok = $sto['stok'];
	$sisa = $stok - $jumlah;
	if ($stok < $jumlah) {
		echo '<script type="text/javascript"> alert("jumlah melebihi stok");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
	}else {
		$sql = mysqli_query($koneksi, "INSERT INTO tb_detailproduksi VALUES (0,'$kd_produksi','$kode_bahan','$jumlah')");
		if ($sql) {
			$upstok = mysqli_query($koneksi, "UPDATE tb_bahan SET stok='$sisa' WHERE kode_bahan = '$kode_bahan'");
			$_SESSION['message'] = "Data berhasil ditambahkan!";
			$_SESSION['msg_type'] = "primary";
			echo '<script type="text/javascript"> alert("Data berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
			echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
		} else {
			echo '<script type="text/javascript"> alert("Data Tidak berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
			echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
		}	
	}	
}