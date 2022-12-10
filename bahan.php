<?php
@session_start();
include 'security.php';
include 'header.php';
$query = mysqli_query($koneksi, "SELECT max(kode_bahan) as kodeTerbesar FROM tb_bahan");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "KOM";
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
                      <form action="models/bahan/tambah.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label class=" form-control-label">Kode Bahan</label>
                                    <input type="text" id="kode_bahan" name="kode_bahan" class="form-control" readonly="" value="<?php echo $kodeBarang ?>">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Nama Bahan</label>
                                    <input type="text" id="nama_bahan" name="nama_bahan" class="form-control">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Stok (Per Kg/M)</label>
                                    <input type="number" id="stok" name="stok" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class=" form-control-label">Harga (Per Kg/M)</label>
                                    <input type="number" id="harga" name="harga" class="form-control">
                                </div>
                                <div class="form-group"><label for="select" class=" form-control-label">Status</label>
                                    <select name="Status" id="Status" class="form-control">
                                        <option value="">...Pilih...</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm" name="submit">
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
                    <strong class="card-title">Data Bahan</strong>
                        <!-- <div class="float-right">
                            <a href="cetak_bahan.php" type="submit" class="btn btn-primary btn-sm mb-2"><i class="fa fa-print" aria-hidden="true"></i>Cetak</a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Operasi</th>
                                </tr>
                                <?php
                                include 'inc/koneksi.php';
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM tb_bahan");
                                while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['kode_bahan']; ?></td>
                                        <td><?= $data['nama_bahan']; ?></td>
                                        <td><?= $data['stok']; ?></td>
                                        <td>Rp. <?= number_format($data['harga']);  ?></td>
                                        <td style="text-align: center;"><?= $data['Status']; ?></td>
                                        <td style="text-align:center">
                                            <a href="#" type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $data['kode_bahan']; ?>">
                                                <i class=" fa fa-pencil"> Ubah</i>
                                            </a>
                                            <!-- <a href="#" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $data; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a> -->
                                        </td>
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
    </div>
</div>

<?php
include 'inc/koneksi.php';
$no = 1;
$sql = mysqli_query($koneksi, "SELECT * FROM tb_bahan");
while ($data = mysqli_fetch_array($sql)) {
    ?>
    <div class="modal fade" id="editModal<?= $data['kode_bahan']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/bahan/edit.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label class=" form-control-label">Kode Bahan</label>
                                    <input type="text" id="kode_bahan" name="kode_bahan" class="form-control" readonly="" value="<?= $data['kode_bahan']; ?>">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Nama Bahan</label>
                                    <input type="text" id="nama_bahan" name="nama_bahan" class="form-control" value="<?= $data['nama_bahan']; ?>">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Stok (Per Kg/M)</label>
                                    <input type="number" id="stok" name="stok" class="form-control" value="<?= $data['stok']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class=" form-control-label">Harga (Per Kg/M)</label>
                                    <input type="number" id="harga" name="harga" class="form-control" value="<?= $data['harga']; ?>">
                                </div>
                                <div class="form-group"><label for="select" class=" form-control-label">Status</label>
                                    <select name="Status" id="Status" class="form-control">
                                        <option value="">...Pilih...</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal<?= $data['kode_bahan']; ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/bahan/hapus.php" method="post">
                        <div>
                            <input type="hidden" id="kode_bahan" name="kode_bahan" class="form-control" value="<?= $data['kode_bahan']; ?>">
                            <h6>
                                Hapus <?= $data['nama_bahan']; ?> ?
                            </h6>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                            <button type="cancel" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Tidak
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php include 'footer.php'; ?>