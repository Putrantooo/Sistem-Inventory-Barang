<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$kode = $_POST['kode'];
$id_pembelian        = $_POST['id_pembelian'];
$kode_bahan    			= $_POST['kode_bahan'];
$Harga   = $_POST['Harga'];
$Jumlah   = $_POST['Jumlah'];

//menginput data ke databse
$sql = mysqli_query($koneksi, "UPDATE tb_detailbeli SET id_pembelian = '$id_pembelian', kode_bahan = '$kode_bahan', Harga = '$Harga', Jumlah = '$Jumlah' WHERE kode = '$kode'");

if ($sql) {
	$_SESSION['message'] = "Data berhasil diubah!";
	$_SESSION['msg_type'] = "primary";
	echo "<script>window.location='" . ('../../detbeli.php') . "';</script>";
} else {
	echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
