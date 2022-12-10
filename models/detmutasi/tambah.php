<?php
include '../../inc/koneksi.php';

$kode = $_POST['kode'];
$kd_mutasi        = $_POST['kd_mutasi'];
$kd_payung    = $_POST['kd_payung'];
$Harga   = $_POST['Harga'];
$jumlah   = $_POST['jumlah'];
$Total   = $_POST['Total'];

if (empty($kode && $kd_mutasi && $kd_payung && $Harga && $jumlah && $Total)) {
	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
	echo "<script>window.location='" . ('../../detmutasi.php') . "';</script>";	
}else{
	$selSto = mysqli_query($koneksi, "SELECT * FROM tb_payung WHERE kd_payung = '$kd_payung'");
	$sto = mysqli_fetch_array($selSto);
	$stok = $sto['Stok'];
	$sisa = $stok - $jumlah;
	if ($stok < $jumlah) {
		echo '<script type="text/javascript"> alert("jumlah melebihi stok");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../detmutasi.php') . "';</script>";
	}else {
		$sql = mysqli_query($koneksi, "INSERT INTO tb_detailmutasi VALUES (0,'$kd_mutasi','$kd_payung','$Harga','$jumlah','$Total')");
		if ($sql) {
			$upstok = mysqli_query($koneksi, "UPDATE tb_payung SET Stok='$sisa' WHERE kd_payung = '$kd_payung'");
			$_SESSION['message'] = "Data berhasil ditambahkan!";
			$_SESSION['msg_type'] = "primary";
			echo '<script type="text/javascript"> alert("Data berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
			echo "<script>window.location='" . ('../../detmutasi.php') . "';</script>";
		} else {
			echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan!");</script>'.mysqli_error($koneksi);
			echo "<script>window.location='" . ('../../detmutasi.php') . "';</script>";
		}	
	}
}