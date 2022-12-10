<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode = $_POST['kode'];
$kd_produksi        = $_POST['kd_produksi'];
$kode_bahan    = $_POST['kode_bahan'];
$jumlah   = $_POST['jumlah'];

$selSto = mysqli_query($koneksi, "SELECT stok FROM tb_bahan WHERE kode_bahan = '$kode_bahan'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['stok'];
$sisa = $stok - $jumlah;

// menginput data ke databse
if ($stok < $sisa) {
	echo "jumlah melebihi dari stok";
}else{
	$sql = mysqli_query($koneksi, "UPDATE tb_detailproduksi SET kd_produksi = '$kd_produksi', kode_bahan = '$kode_bahan', 
		jumlah = '$jumlah' WHERE kode = '$kode'");

	if ($stok != $sisa) {
		if ($sql) {
			$upstok = mysqli_query($koneksi, "UPDATE tb_bahan SET stok='$sisa' WHERE kode_bahan = '$kode_bahan'");

			$_SESSION['message'] = "Data berhasil ditambahkan!";
			$_SESSION['msg_type'] = "primary";
			echo "<script>window.location='" . ('../../detproduksi.php') . "';</script>";
		} else {
			echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
		}	
	}
}
