<?php

//koneksi database
include '../../inc/koneksi.php';

//menangkap data yang dikirim dari form
$id_barang_masuk = $_POST['id_pembelian'];
$tanggal        = $_POST['Tanggal'];
$kode_barang    = $_POST['kode_bahan'];
$id_supplier    = $_POST['id'];
$jumlah_masuk   = $_POST['Total'];

$selSto = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE kode_bahan = '$kode_barang'");
$sto = mysqli_fetch_array($selSto);
$stok = $sto['stok'];
$sisa = $stok + $jumlah_masuk;

// menginput data ke databse
$sql = mysqli_query($koneksi, "UPDATE tb_pembelian SET Tanggal = '$tanggal', kode_bahan = '$kode_barang', 
id = '$id_supplier', Total = '$jumlah_masuk' WHERE id_pembelian = '$id_barang_masuk'");

if ($sql) {
    $upstok = mysqli_query($koneksi, "UPDATE tb_bahan SET stok='$sisa' WHERE kode_bahan = '$kode_barang'");

    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../beli.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}