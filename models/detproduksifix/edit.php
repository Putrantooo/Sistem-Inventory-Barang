<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode = $_POST['kode'];
$kd_produksi        = $_POST['kd_produksi'];
$kd_payung    = $_POST['kd_payung'];
$jumlah   = $_POST['jumlah'];

$selSto = mysqli_query($koneksi, "SELECT * FROM tb_payung WHERE kd_payung = '$kd_payung'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['Stok'];
$sisa = $stok + $jumlah;

// menginput data ke databse
if ($stok < $sisa) {
	echo "jumlah melebihi stok";		
}else{
	$sql = mysqli_query($koneksi, "UPDATE tb_produksifix SET kd_produksi = '$kd_produksi', kd_payung = '$kd_payung', 
		jumlah = '$jumlah' WHERE kode = '$kode'");
	if ($sql) {
		$upstok = mysqli_query($koneksi, "UPDATE tb_payung SET Stok='$sisa' WHERE kd_payung = '$kd_payung'");

		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo "<script>window.location='" . ('../../detproduksifix.php') . "';</script>";
	} else {
		echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
	}
}