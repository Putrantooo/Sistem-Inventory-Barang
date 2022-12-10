<?php
@session_start();
include 'security.php';
include 'header.php';
$query = mysqli_query($koneksi, "SELECT max(id_pembelian) as kodeTerbesar FROM tb_pembelian");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "PEM";
$kodeBarang = $huruf . sprintf("%02s", $urutan);
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
                        <form action="models/pembelian/Tambah.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class="form-control-label">Kode Pembelian</label>
                                        <input type="text" id="id_pembelian" name="id_pembelian" class="form-control" readonly="" value="<?php echo $kodeBarang ?>">
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
                        <strong class="card-title">Bahan Masuk</strong>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pembelian</th>
                                    <th>Tanggal</th>
                                </tr>
                                <?php
                                include 'inc/koneksi.php';
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT tb_pembelian.id_pembelian, DATE_FORMAT(Tanggal, '%d %M %Y') AS Tanggal FROM tb_pembelian ORDER BY Tanggal DESC");
                                while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['id_pembelian']; ?></td>
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