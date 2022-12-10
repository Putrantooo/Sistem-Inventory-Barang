<?php
include '../../inc/koneksi.php';
$kd_payung        = $_POST['kd_payung'];
$Nama    			= $_POST['Nama'];
$id_kategori    	= $_POST['id_kategori'];
$Stok   = $_POST['Stok'];
$Harga   = $_POST['Harga'];
if (empty($kd_payung && $Nama && $id_kategori && $Stok && $Harga)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../payung.php') . "';</script>";
}else{
	$sql = mysqli_query($koneksi, "INSERT INTO tb_payung VALUES ('$kd_payung','$Nama','$id_kategori','$Stok','$Harga')");
	if ($sql) {
		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../payung.php') . "';</script>";
	} else {
		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../payung.php') . "';</script>";
	}
}