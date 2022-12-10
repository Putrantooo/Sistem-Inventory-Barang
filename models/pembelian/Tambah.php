<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$id_pembelian        = $_POST['id_pembelian'];
$Tanggal        = $_POST['Tanggal'];

// menginput data ke databse
$sql = mysqli_query($koneksi, "INSERT INTO tb_pembelian VALUES('$id_pembelian','$Tanggal')");

if ($sql) {
	$_SESSION['message'] = "Data berhasil ditambahkan!";
	$_SESSION['msg_type'] = "primary";
	echo "<script>window.location='" . ('../../beli.php') . "';</script>";
} else {
	echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
