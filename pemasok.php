<?php
@session_start();
include 'security.php';
include 'header.php';
$query = mysqli_query($koneksi, "SELECT max(kode_supplier) as kodeTerbesar FROM tb_suplier");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "SUP";
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
                        <form action="models/supplier/tambah.php" method="post">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group"><label class=" form-control-label">Kode Pemasok</label>
                                        <input type="text" id="kode_supplier" name="kode_supplier" class="form-control" readonly="" value="<?php echo $kodeBarang ?>">
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">Nama Pemasok/Toko</label>
                                        <input type="text" id="nama" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">No.Telepon</label>
                                        <input type="text" id="telp" name="telp" class="form-control">
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
                        <strong class="card-title">Data Pemasok</strong>
                        <!-- <div class="float-right">
                            <a href="cetak_bahan.php" type="submit" class="btn btn-primary btn-sm mb-2"><i class="fa fa-print" aria-hidden="true"></i>Cetak</a>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pemasok</th>
                                    <th>Nama Pemasok/Toko</th>
                                    <th width="200">Alamat</th>
                                    <th>No.Telepon</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Operasi</th>
                                </tr>
                                <?php
                                include 'inc/koneksi.php';
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT * FROM tb_suplier order by kode_supplier ASC");
                                while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['kode_supplier']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['alamat']; ?></td>
                                        <td><?= $data['telp']; ?></td>
                                        <td style="text-align: center;"><?= $data['Status_sup']; ?></td>
                                        <td style="text-align:center">
                                            <a href="#" type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $data['kode_supplier']; ?>">
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
$sql = mysqli_query($koneksi, "SELECT * FROM tb_suplier");
while ($data = mysqli_fetch_array($sql)) {
    ?>
    <div class="modal fade" id="editModal<?= $data['kode_supplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/supplier/edit.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"><label class=" form-control-label">Kode Pemasok</label>
                                    <input type="text" id="kode_supplier" name="kode_supplier" class="form-control" readonly="" value="<?= $data['kode_supplier']; ?>">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Nama Pemasok/Toko</label>
                                    <input type="text" id="nama" name="nama" class="form-control" value="<?= $data['nama']; ?>">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"><?php echo$data['alamat']; ?></textarea>
                                </div>
                                <div class="form-group"><label class=" form-control-label">No.Telepon</label>
                                    <input type="text" id="telp" name="telp" class="form-control" value="<?= $data['telp']; ?>">
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

    <div class="modal fade" id="hapusModal<?= $data['kode_supplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/supplier/hapus.php" method="post">
                        <div>
                            <input type="hidden" id="kode_supplier" name="kode_supplier" class="form-control" value="<?= $data['kode_supplier']; ?>">
                            <h6>
                                Hapus <?= $data['nama']; ?> ?
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