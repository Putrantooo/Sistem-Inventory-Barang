<?php
include '../../inc/koneksi.php';
$kode_supplier    = $_POST['kode_supplier'];
$nama 			= $_POST['nama'];
$alamat           = $_POST['alamat'];
$telp          = $_POST['telp'];
$Status = $_POST['Status'];

if (empty($kode_supplier && $nama && $alamat && $telp)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../pemasok.php') . "';</script>";
}else {
	$sql = mysqli_query($koneksi, "INSERT INTO tb_suplier VALUES('$kode_supplier','$nama','$alamat','$telp', '$Status')");
	if ($sql) {
		$_SESSION['message'] = "Data berhasil ditambahkan!";
		$_SESSION['msg_type'] = "primary";
		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../pemasok.php') . "';</script>";
	} else {
		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../pemasok.php') . "';</script>";
	}
}