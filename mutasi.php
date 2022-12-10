<?php
@session_start();
include 'security.php';
include 'header.php';
$query = mysqli_query($koneksi, "SELECT max(kd_mutasi) as kodeTerbesar FROM tb_mutasi");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "MUT";
$kodeBarang = $huruf . sprintf("%03s", $urutan);
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Tambah Data</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="models/mutasi/tambah.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class=" form-control-label">Kode Mutasi</label>
                                        <input type="text" id="kd_mutasi" name="kd_mutasi" class="form-control" readonly="" value="<?php echo $kodeBarang ?>">
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">Tanggal</label>
                                        <input type="date" id="Tanggal" name="Tanggal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Mutasi</strong>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Mutasi</th>
                                    <th>Tanggal</th>
                                </tr>
                                <?php
                                include 'inc/koneksi.php';
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM tb_mutasi");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['kd_mutasi']; ?></td>
                                    <td><?= $data['Tanggal']; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<?php include 'footer.php'; ?>