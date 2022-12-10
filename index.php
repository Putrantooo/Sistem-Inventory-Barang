<?php
@session_start();
include 'security.php';
include 'header.php';
?>

<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div>
  <!-- <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div> -->
</div>

<div class="content mt-3">

  <div class="col-xl-3 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-desktop text-success border-success"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">
              <a class="nav-link" href="bahan.php">
                Total Bahan
              </a>
            </div>
            <?php
            include "inc/koneksi.php";
            $sql = "SELECT * FROM tb_bahan";
            $query = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($query);
            ?>
            <div class="stat-digit"><?= $count; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-shopping-cart-full text-primary border-primary"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">
              <a class="nav-link" href="payung.php">
                Total Payung
              </a>
            </div>
            <?php
            include "inc/koneksi.php";
            $sql = "SELECT * FROM tb_payung";
            $query = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($query);
            ?>
            <div class="stat-digit"><?= $count ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-shopping-cart-full text-warning border-warning"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">
              <a class="nav-link" href="detbeli.php">
                Total Pembelian
              </a>
            </div>
            <?php
            include "inc/koneksi.php";
            $sql = "SELECT * FROM tb_pembelian";
            $query = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($query);
            ?>
            <div class="stat-digit"><?= $count ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="stat-widget-one">
          <div class="stat-icon dib"><i class="ti-shopping-cart-full text-danger border-danger"></i></div>
          <div class="stat-content dib">
            <div class="stat-text">
              <a class="nav-link" href="produksi.php">
                Total Produksi
              </a>
            </div>
            <?php
            include "inc/koneksi.php";
            $sql = "SELECT * FROM tb_produksi";
            $query = mysqli_query($koneksi, $sql);
            $count = mysqli_num_rows($query);
            ?>
            <div class="stat-digit"><?= $count ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>



</div> <!-- .content -->


<?php include 'footer.php'; ?>