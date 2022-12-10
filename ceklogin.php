<?php
session_start();
include 'inc/koneksi.php';
$username = $_POST['username'];
$pass = $_POST['password'];


$koneksi = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE username = '$username' and password = '$pass'");
$data = mysqli_fetch_array($koneksi);
$cek = mysqli_num_rows($koneksi);
if ($cek > 0) {
	$_SESSION['Admin'] = $data['id'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
	echo "<script>window.location='" . ('index.php') . "';</script>";
} else {
	echo '<script type="text/javascript"> alert("username dan password salah/ semua kolom harus terisi");</script>'.mysqli_error($koneksi);
	$_SESSION['message'] = 'Username atau Password salah!';
	$_SESSION['msg_type'] = "danger";
	echo "<script>window.location='" . ('login.php') . "';</script>";
}