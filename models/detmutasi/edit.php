<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode = $_POST['kode'];
$kd_mutasi        = $_POST['kd_mutasi'];
$kd_payung    = $_POST['kd_payung'];
$jumlah   = $_POST['jumlah'];

$selSto = mysqli_query($koneksi, "SELECT * FROM tb_payung WHERE kd_payung = '$kd_payung'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['Stok'];
$sisa = $stok - $jumlah;

// menginput data ke databse
$sql = mysqli_query($koneksi, "UPDATE tb_detailmutasi SET kd_mutasi = '$kd_mutasi', kd_payung = '$kd_payung', 
	jumlah = '$jumlah' WHERE kode = '$kode'");

if ($stok != $sisa) {
	if ($sql) {
		$upstok = mysqli_query($koneksi, "UPDATE tb_payung SET Stok='$sisa' WHERE kd_payung = '$kd_payung'");

		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo "<script>window.location='" . ('../../detmutasi.php') . "';</script>";
	} else {
		echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
	}	
}