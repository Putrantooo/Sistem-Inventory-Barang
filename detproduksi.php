<?php
@session_start();
include 'security.php';
include 'header.php';
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
						<form action="models/detproduksi/tambah.php" method="post">
							<div class="row">
								<div class="col-md-10">
									<input type="hidden" name="kode" id="kode" >
									<div class="form-group"><label for="select" class=" form-control-label">Tanggal Produksi</label>
										<select name="kd_produksi" id="kd_produksi" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_produksi") or die(mysqli_error($con));
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['kd_produksi'] . '">' . $data_nilai['Tanggal'] . '</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group"><label for="select" class=" form-control-label">Bahan</label>
										<select name="kode_bahan" id="kode_bahan" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE Status = 'Aktif'") or die(mysqli_error($con));
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['kode_bahan'] . '">' . $data_nilai['nama_bahan'] . '</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group"><label class=" form-control-label">Jumlah</label>
										<input type="number" id="jumlah" name="jumlah" class="form-control">
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
						<strong class="card-title">Data Detail Produksi</strong>
					</div>
					<div class="card-body">
						<table id="dataTable" class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Produksi</th>
									<th>Nama Bahan</th>
									<th style="text-align: center;">Jumlah</th>
								</tr>
								<?php
								include 'inc/koneksi.php';
								$no = 1;
								$sql = mysqli_query($koneksi, "SELECT tb_detailproduksi.kode, tb_produksi.kd_produksi, tb_bahan.kode_bahan, 
									tb_detailproduksi.jumlah, tb_bahan.nama_bahan FROM tb_detailproduksi
									INNER JOIN tb_produksi ON tb_detailproduksi.kd_produksi = tb_produksi.kd_produksi
									INNER JOIN tb_bahan ON tb_detailproduksi.kode_bahan = tb_bahan.kode_bahan ORDER BY Kode DESC");
								while ($data = mysqli_fetch_array($sql)) {
									?>
								</thead>
								<tbody>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $data['kd_produksi']; ?></td>
										<td><?= $data['nama_bahan']; ?></td>
										<td style="text-align: center;"><?= $data['jumlah']; ?></td>
<!-- 										<td style="text-align:center">
											<a href="#" type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $data; ?>">
												<i class=" fa fa-pencil"></i>
											</a>
											<a href="#" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusModal<?= $data; ?>">
												<i class="fa fa-trash"></i>
											</a>
										</td> -->
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
$sql = mysqli_query($koneksi, "SELECT * FROM tb_detailproduksi
	INNER JOIN tb_produksi ON tb_detailproduksi.kd_produksi = tb_produksi.kd_produksi
	INNER JOIN tb_bahan ON tb_detailproduksi.kode_bahan = tb_bahan.kode_bahan");
while ($data = mysqli_fetch_array($sql)) {
	?>
	<div class="modal fade" id="editModal<?= $data['kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mediumModalLabel">Edit Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="models/detproduksi/edit.php" method="post">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="kode" id="kode" value="<?= $data['kode']; ?>">
								<input type="hidden" name="kode_bahan" id="kode_bahan" value="<?= $data['kode_bahan']; ?>">
								<input type="hidden" name="jumlah" id="jumlah" value="<?= $data['jumlah']; ?>">
								<div class="form-group"><label for="select" class=" form-control-label">Kode Produksi</label>
									<select name="kd_produksi" id="kd_produksi" class="form-control">
										<option value="">... Pilih ...</option>
										<?php
										include 'inc/koneksi.php';
										$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_produksi");
										while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
											if ($data_nilai['kd_produksi'] == $data['kd_produksi']) {
												?>
												<option value="<?= $data_nilai['kd_produksi']; ?>" selected>
													<?= $data_nilai['Tanggal']; ?></option>
													<?php
												} else {
													?>
													<option value="<?= $data_nilai['kd_produksi']; ?>">
														<?= $data_nilai['Tanggal']; ?> </option>
													}
													<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group"><label for="select" class=" form-control-label">Bahan</label>
										<select name="kode_bahan" id="kode_bahan" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_bahan");
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												if ($data_nilai['kode_bahan'] == $data['kode_bahan']) {
													?>
													<option value="<?= $data_nilai['kode_bahan']; ?>" selected>
														<?= $data_nilai['nama_bahan']; ?></option>
														<?php
													} else {
														?>
														<option value="<?= $data_nilai['kode_bahan']; ?>">
															<?= $data_nilai['nama_bahan']; ?> </option>
														}
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group"><label class=" form-control-label">Jumlah</label>
											<input type="number" id="jumlah" name="jumlah" value="<?= $data['jumlah']; ?>" class="form-control">
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

			<div class="modal fade" id="hapusModal<?= $data['kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="smallmodalLabel">Hapus Data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="models/detproduksi/hapus.php" method="post">
								<div>
									<input type="hidden" id="kode" name="kode" class="form-control" value="<?= $data['kode']; ?>">
									<input type="hidden" id="kode_bahan" name="kode_bahan" class="form-control" value="<?= $data['kode_bahan']; ?>">
									<input type="hidden" id="jumlah" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>">
									<h6>
										Hapus Barang Masuk <?= $data['kd_produksi']; ?> <i><?= $data['nama_bahan']; ?></i> ?
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