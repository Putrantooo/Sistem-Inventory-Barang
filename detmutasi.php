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
						<form action="models/detmutasi/tambah.php" method="post">
							<div class="row">
								<div class="col-md-10">
								<input type="hidden" name="kode" id="kode" >
								<div class="form-group"><label for="select" class=" form-control-label">Tanggal Mutasi</label>
									<select name="kd_mutasi" id="kd_mutasi" class="form-control">
										<option value="">... Pilih ...</option>
										<?php
										include 'inc/koneksi.php';
										$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_mutasi") or die(mysqli_error($con));
										while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
											echo '<option value="' . $data_nilai['kd_mutasi'] . '">' . $data_nilai['Tanggal'] . '</option>';
										}
										?>
									</select>
									<br>
									<div class="form-group"><label for="select" class=" form-control-label">Payung</label>
										<select id="kd_payung" name="kd_payung" class="form-control" onchange="changeValueHarga(this.value)">
											<option disabled="" selected="">... Pilih ...</option>
											<?php 
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_payung");
											$jsArray = "var prdHarga = new Array();\n";
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												echo '<option value="' . $data_nilai['kd_payung'] . '">' . $data_nilai['kd_payung'] . '</option>';
												$jsArray .= "prdHarga['" . $data_nilai['kd_payung'] . "'] = {Harga:'" . addslashes($data_nilai['Harga']) . "'}\n";
											}
											?>
										</select>
										<br>
										<label class=" form-control-label">Harga (Per Kg)</label>
										<input type="text" id="Harga" name="Harga" class="form-control" readonly="">
										<script type="text/javascript">
											<?php echo $jsArray; ?>
											function changeValueHarga(x){
												document.getElementById('Harga').value = prdHarga[x].Harga;
											}
										</script>
										<br>
										<label class=" form-control-label">Jumlah (Per Kg)</label>
										<input type="number" id="jumlah" name="jumlah" class="form-control">
										<br>
										<label class=" form-control-label">Total Harga</label>
										<input type="text" id="Total" name="Total" class="form-control" readonly="">
										<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
										<script type="text/javascript">
											$(".form-group").keyup(function(){
												var harga = parseInt($("#Harga").val())
												var jumlah = parseInt($("#jumlah").val())

												var Total = harga * jumlah;
												$("#Total").attr("value",Total)  
											});
										</script>
									</div>
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
						<strong class="card-title">Data Detail Mutasi</strong>
					</div>
					<div class="card-body">
						<table id="dataTable" class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Mutasi</th>
									<th>Nama payung</th>
									<th>Harga</th>
									<th style="text-align: center;">Jumlah</th>
									<th>Total Harga</th>
								</tr>
								<?php
								include 'inc/koneksi.php';
								$no = 1;
								$sql = mysqli_query($koneksi, "SELECT tb_detailmutasi.kode, tb_mutasi.kd_mutasi, tb_payung.kd_payung, tb_payung.Harga, tb_detailmutasi.harga, tb_detailmutasi.jumlah, tb_detailmutasi.Total, tb_payung.Nama FROM tb_detailmutasi
									INNER JOIN tb_mutasi ON tb_detailmutasi.kd_mutasi = tb_mutasi.kd_mutasi
									INNER JOIN tb_payung ON tb_detailmutasi.kd_payung = tb_payung.kd_payung ORDER BY Kode DESC");
								while ($data = mysqli_fetch_array($sql)) {
									?>
								</thead>
								<tbody>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $data['kd_mutasi']; ?></td>
										<td><?= $data['Nama']; ?></td>
										<td>Rp.<?= number_format($data['Harga']); ?></td>
										<td style="text-align: center;"><?= $data['jumlah']; ?></td>
										<td>Rp.<?= number_format($data['Total']); ?></td>
										<!-- <td style="text-align:center">
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
$sql = mysqli_query($koneksi, "SELECT * FROM tb_detailmutasi
	INNER JOIN tb_mutasi ON tb_detailmutasi.kd_mutasi = tb_mutasi.kd_mutasi
	INNER JOIN tb_payung ON tb_detailmutasi.kd_payung = tb_payung.kd_payung");
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
					<form action="models/detmutasi/edit.php" method="post">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" name="kode" id="kode" value="<?= $data['kode']; ?>">
								<div class="form-group"><label for="select" class=" form-control-label">Kode Mutasi</label>
									<select name="kd_mutasi" id="kd_mutasi" class="form-control">
										<option value="">... Pilih ...</option>
										<?php
										include 'inc/koneksi.php';
										$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_mutasi");
										while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
											if ($data_nilai['kd_mutasi'] == $data['kd_mutasi']) {
												?>
												<option value="<?= $data_nilai['kd_mutasi']; ?>" selected>
													<?= $data_nilai['Tanggal']; ?></option>
													<?php
												} else {
													?>
													<option value="<?= $data_nilai['kd_mutasi']; ?>">
														<?= $data_nilai['Tanggal']; ?> </option>
													}
													<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group"><label for="select" class=" form-control-label">Payung</label>
										<select name="kd_payung" id="kd_payung" class="form-control">
											<option value="">... Pilih ...</option>
											<?php
											include 'inc/koneksi.php';
											$sql_nilai = mysqli_query($koneksi, "SELECT * FROM tb_payung");
											while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
												if ($data_nilai['kd_payung'] == $data['kd_payung']) {
													?>
													<option value="<?= $data_nilai['kd_payung']; ?>" selected>
														<?= $data_nilai['Nama']; ?></option>
														<?php
													} else {
														?>
														<option value="<?= $data_nilai['kd_payung']; ?>">
															<?= $data_nilai['Nama']; ?> </option>
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
							<form action="models/detmutasi/hapus.php" method="post">
								<div>
									<input type="hidden" id="kode" name="kode" class="form-control" value="<?= $data['kode']; ?>">
									<input type="hidden" id="kd_payung" name="kd_payung" class="form-control" value="<?= $data['kd_payung']; ?>">
									<input type="hidden" id="jumlah" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>">
									<h6>
										Hapus Barang Masuk <?= $data['kd_mutasi']; ?> <i><?= $data['Nama']; ?></i> ?
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