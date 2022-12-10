<?php
include '../../inc/koneksi.php';

$kode        = $_POST['kode'];
$id_pembelian        = $_POST['id_pembelian'];
$kode_bahan    			= $_POST['kode_bahan'];
$kode_supplier = $_POST['kode_supplier'];
$harga   = $_POST['harga'];
$Jumlah   = $_POST['Jumlah'];
$Total   = $_POST['Total'];

if (empty($kode && $id_pembelian && $kode_bahan && $kode_supplier && $harga && $Jumlah && $Total)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../detbeli.php') . "';</script>";
}else{
	$selSto = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE kode_bahan = '$kode_bahan'");
	$sto = mysqli_fetch_array($selSto);
	$stok = $sto['stok'];
	$sisa = $stok + $Jumlah;
	$sql = mysqli_query($koneksi, "INSERT INTO tb_detailbeli VALUES (0,'$id_pembelian','$kode_bahan','$kode_supplier','$harga','$Jumlah','$Total')");
	if ($sql) {
		$upstok = mysqli_query($koneksi, "UPDATE tb_bahan SET stok='$sisa' WHERE kode_bahan = '$kode_bahan'");
		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detbeli.php') . "';</script>";
	} else {
		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detbeli.php') . "';</script>";
	}	
}