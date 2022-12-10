<?php
@session_start();
include 'security.php';
include 'header.php';
$query = mysqli_query($koneksi, "SELECT max(kd_payung) as kodeTerbesar FROM tb_payung");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "PAY";
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
                        <form action="models/payung/tambah.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><label class=" form-control-label">Kode Payung</label>
                                        <input type="text" id="kd_payung" name="kd_payung" class="form-control" readonly="" value="<?php echo $kodeBarang ?>">
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">Nama</label>
                                        <input type="text" id="Nama" name="Nama" class="form-control">
                                    </div>
                                    <div class="form-group"><label for="select" class=" form-control-label">Kategori</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control">
                                            <option value="">... Pilih ...</option>
                                            <?php
                                            include 'inc/koneksi.php';
                                            $sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE Status_kat='Aktif'") or die(mysqli_error($con));
                                            while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                                echo '<option value="' . $data_nilai['id_kategori'] . '">' . $data_nilai['nama'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><label class=" form-control-label">Stok</label>
                                        <input type="number" id="Stok" name="Stok" class="form-control">
                                    </div>
                                    <div class="form-group"><label class=" form-control-label">Harga</label>
                                        <input type="number" id="Harga" name="Harga" class="form-control">
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
                        <strong class="card-title">Data Payung</strong>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Payung</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Operasi</th>
                                </tr>
                                <?php
                                include 'inc/koneksi.php';
                                $no = 1;
                                $sql = mysqli_query($koneksi, "SELECT tb_payung.kd_payung, tb_payung.Nama, 
                                    tb_kategori.nama, tb_payung.Stok, tb_payung.Harga, tb_kategori.Status_kat FROM tb_payung
                                    INNER JOIN tb_kategori ON tb_payung.id_kategori = tb_kategori.id_kategori ORDER BY kd_payung ASC");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['kd_payung']; ?></td>
                                    <td><?= $data['Nama']; ?></td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['Stok']; ?></td>
                                    <td>Rp.<?= number_format($data['Harga']); ?></td>
                                    <td style="text-align:center">
                                        <a href="#" type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $data['kd_payung']; ?>">
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
    </div><!-- .animated -->
</div><!-- .content -->

<?php
include 'inc/koneksi.php';
$no = 1;
$sql = mysqli_query($koneksi, "SELECT * FROM tb_payung
    INNER JOIN tb_kategori ON tb_payung.id_kategori = tb_kategori.id_kategori");
while ($data = mysqli_fetch_array($sql)) {
?>
    <div class="modal fade" id="editModal<?= $data['kd_payung']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/payung/edit.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="kd_payung" id="kd_payung" value="<?= $data['kd_payung']; ?>">
                                <div class="form-group"><label class=" form-control-label">Nama</label>
                                    <input type="text" id="Nama" name="Nama" value="<?= $data['Nama']; ?>" class="form-control">
                                </div>
                                <div class="form-group"><label for="select" class=" form-control-label">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control">
                                        <option value="">... Pilih ...</option>
                                        <?php
                                        include 'inc/koneksi.php';
                                        $sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                                        while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                            if ($data_nilai['id_kategori'] == $data['id_kategori']) {
                                        ?>
                                                <option value="<?= $data_nilai['id_kategori']; ?>" selected>
                                                    <?= $data_nilai['nama']; ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?= $data_nilai['id_kategori']; ?>">
                                                    <?= $data_nilai['nama']; ?> </option>
                                                }
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label class=" form-control-label">Stok</label>
                                    <input type="number" id="Stok" name="Stok" value="<?= $data['Stok']; ?>" class="form-control">
                                </div>
                                <div class="form-group"><label class=" form-control-label">Harga</label>
                                    <input type="number" id="Harga" name="Harga" value="<?= $data['Harga']; ?>" class="form-control">
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
    </div>

    <div class="modal fade" id="hapusModal<?= $data['kd_payung']; ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="models/payung/hapus.php" method="post">
                        <div>
                            <input type="hidden" id="kd_payung" name="kd_payung" class="form-control" value="<?= $data['kd_payung']; ?>">
                            <h6>
                                Hapus Barang Masuk <?= $data['kd_payung']; ?> <i><?= $data['Nama']; ?></i> ?
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