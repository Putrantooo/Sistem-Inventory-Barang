<?php
@session_start();
include 'inc/koneksi.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Junada Payung</title>

  <link href="assets/part2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="assets/part2/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="images/gambarlogin.png">

  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
  <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


  <link rel="stylesheet" href="assets/css/style.css">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading" style="color: white">
          Data dan Laporan
        </div>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" style="color: white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="menu-icon fa fa-laptop" style="color: white"></i>
            <span style="color: white">Data Master</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header" >Data</h6>
              <a class="collapse-item" href="pemasok.php">Data Supplier</a>
              <a class="collapse-item" href="bahan.php">Data Bahan</a>
              <a class="collapse-item" href="jenis.php">Data Kategori</a>
              <a class="collapse-item" href="payung.php">Data Payung</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="menu-icon fa fa-laptop" style="color: white"></i>
            <span style="color: white">Data Transaksi</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Data Transaksi</h6>
              <a class="collapse-item" href="beli.php">Data Pembelian</a>
              <a class="collapse-item" href="produksi.php">Data Produksi</a>
              <a class="collapse-item" href="mutasi.php">Data Mutasi</a>
              <a class="collapse-item" href="detbeli.php">Detail Pembelian</a>
              <a class="collapse-item" href="detmutasi.php">Detail Mutasi</a>
              <a class="collapse-item" href="detproduksifix.php">Detail Produksi</a>
              <a class="collapse-item" href="detproduksi.php">Detail Bahan Keluar</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="menu-icon fa fa-archive" style="color: white"></i>
            <span style="color: white">Laporan</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Laporan</h6>
              <a class="collapse-item" href="lapbeli.php">Laporan Pembelian</a>
              <a class="collapse-item" href="lapmutasi.php">Laporan Mutasi</a>
              <a class="collapse-item" href="lapproduksifix.php">Laporan Produksi</a>
              <a class="collapse-item" href="lapproduksi.php">Laporan Bahan Keluar</a>
            </div>
          </div>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading" style="color: white">
          Pengaturan
        </div>

        <li class="nav-item">
          <a class="nav-link" href="manage_user.php">
            <i class="fas fa-fw fa-users" style="color: white"></i>
            <span style="color: white">Managememnt User</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" style="color: white" href="logout.php" onclick="return confirm('Apakah Anda Yakin ingin keluar ?')">
              <i class="fa fa-power-off" style="color: white"></i>
              Logout
            </a>
          </li>

          <hr class="sidebar-divider d-none d-md-block">

    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow mx-1">

              <div class="topbar-divider d-none d-sm-block"></div>

            </ul>

          </nav>
        </body>
        </html>