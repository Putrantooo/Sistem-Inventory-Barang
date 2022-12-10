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
						<form action="models/detbeli/tambah.php" method="post">
							<div class="row">
								<div class="col-md-10">
									<input type="hidden" name="kode" id="kode" >
									<div class="form-group"><label for="select" class=" form-control-label">Bahan</label>
										<select id="kode_bahan" name="kode_bahan" class="form-control" onchange="changeValueHarga(this.value)">
											<option disabled="" selected="">... Pilih ...</option>
											<?php 
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_bahan WHERE Status ='Aktif'");
											$jsArray = "var prdHarga = new Array();\n";
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['kode_bahan'] . '">' . $data_nilai['nama_bahan'] . '</option>';
												$jsArray .= "prdHarga['" . $data_nilai['kode_bahan'] . "'] = {harga:'" . addslashes($data_nilai['harga']) . "'}\n";
											}
											?>
										</select>
										<br>
										<label class=" form-control-label">Harga (Per Kg)</label>
										<input type="text" id="harga" name="harga" class="form-control" readonly="">
										<script type="text/javascript">
											<?php echo $jsArray; ?>
											function changeValueHarga(x){
												document.getElementById('harga').value = prdHarga[x].harga;
											}
										</script>
										<br>
										<label class=" form-control-label">Jumlah (Per Kg)</label>
										<input type="number" id="Jumlah" name="Jumlah" class="form-control">
										<br>
										<label class=" form-control-label">Total Harga</label>
										<input type="text" id="Total" name="Total" class="form-control" readonly="">
										<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
										<script type="text/javascript">
											$(".form-group").keyup(function(){
												var harga = parseInt($("#harga").val())
												var Jumlah = parseInt($("#Jumlah").val())

												var Total = harga * Jumlah;
												$("#Total").attr("value",Total)  
											});
										</script>
									</div>
									<div class="form-group"><label for="select" class=" form-control-label">Tanggal Pembelian</label>
										<select name="id_pembelian" id="id_pembelian" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_pembelian") or die(mysqli_error($con));
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['id_pembelian'] . '">' . $data_nilai['Tanggal'] . '</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group"><label for="select" class="form-control-label">Supplier</label>
										<select name="kode_supplier" id="kode_supplier" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_suplier WHERE Status_sup ='Aktif'") or die(mysqli_error($con));
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['kode_supplier'] . '">' . $data_nilai['nama'] . '</option>';
											}
											?>
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
						<strong class="card-title">Data Detail Pembelian</strong>
					</div>
					<div class="card-body">
						<table id="dataTable" class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Pembelian</th>
									<th>Bahan</th>
									<th>Supplier</th>
									<th>Harga</th>
									<th style="text-align: center;">Jumlah</th>
									<th>Total</th>
								</tr>
								<?php
								include 'inc/koneksi.php';
								$no = 1;
								$sql = mysqli_query($koneksi, "SELECT tb_detailbeli.kode, tb_detailbeli.id_pembelian, tb_bahan.kode_bahan, tb_suplier.kode_supplier, tb_bahan.harga, tb_detailbeli.Harga, tb_detailbeli.Jumlah, tb_detailbeli.Total, tb_bahan.nama_bahan, tb_suplier.nama FROM tb_detailbeli
									INNER JOIN tb_bahan ON tb_detailbeli.kode_bahan = tb_bahan.kode_bahan
									INNER JOIN tb_suplier ON tb_detailbeli.kode_supplier = tb_suplier.kode_supplier ORDER BY Kode DESC");
								while ($data = mysqli_fetch_array($sql)) {
									?>
								</thead>
								<tbody>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $data['id_pembelian']; ?></td>
										<td><?= $data['nama_bahan']; ?></td>
										<td><?= $data['nama']; ?></td>
										<td>Rp.<?= number_format($data['harga']); ?></td>
										<td style="text-align: center;"><?= $data['Jumlah']; ?></td>
										<td>Rp.<?= number_format($data['Total']); ?></td>
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
$sql = mysqli_query($koneksi, "SELECT * FROM tb_detailbeli
	INNER JOIN tb_pembelian ON tb_detailbeli.id_pembelian = tb_pembelian.id_pembelian
	INNER JOIN tb_bahan ON tb_detailbeli.kode_bahan = tb_bahan.kode_bahan");
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
					<form action="models/detbeli/edit.php" method="post">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="kode" id="kode" value="<?= $data['kode']; ?>">
								<div class="form-group"><label for="select" class=" form-control-label">Kode Pembelian</label>
									<select name="id_pembelian" id="id_pembelian" class="form-control">
										<option value="">... Pilih ...</option>
										<?php
										include 'inc/koneksi.php';
										$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_pembelian");
										while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
											if ($data_nilai['id_pembelian'] == $data['id_pembelian']) {
												?>
												<option value="<?= $data_nilai['id_pembelian']; ?>" selected>
													<?= $data_nilai['Tanggal']; ?></option>
													<?php
												} else {
													?>
													<option value="<?= $data_nilai['id_pembelian']; ?>">
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
									</div>
									<div class="col-md-6">
										<div class="form-group"><label class=" form-control-label">Harga</label>
											<input type="number" id="Harga" name="Harga" value="<?= $data['Harga']; ?>" class="form-control">
										</div>
										<div class="form-group"><label class=" form-control-label">Jumlah</label>
											<input type="number" id="Jumlah" name="Jumlah" value="<?= $data['Jumlah']; ?>" class="form-control">
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
							<form action="models/detbeli/hapus.php" method="post">
								<div>
									<input type="hidden" id="kode" name="kode" class="form-control" value="<?= $data['kode']; ?>">
									<h6>
										Hapus Barang Masuk <?= $data['id_pembelian']; ?> <i><?= $data['nama_bahan']; ?></i> ?
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