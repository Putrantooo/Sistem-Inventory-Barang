 <?php
 include '../../inc/koneksi.php';
 $id_kategori    = $_POST['id_kategori'];
 $nama    = $_POST['nama'];
 $Status = $_POST['Status'];

 if (empty($id_kategori && $nama)) {
 	echo '<script type="text/javascript"> alert("Semua Kolom Harus Terisi");</script>'.mysqli_error($koneksi);
 	echo "<script>window.location='" . ('../../jenis.php') . "';</script>";
 }else{
 	$sql = mysqli_query($koneksi, "INSERT INTO tb_kategori VALUES('$id_kategori','$nama','$Status')");
 	if ($sql) {
 		$_SESSION['message'] = "Data berhasil ditambahkan!";
 		$_SESSION['msg_type'] = "primary";
 		echo '<script type="text/javascript"> alert("Data berhasil ditambahkan");</script>'.mysqli_error($koneksi);
 		echo "<script>window.location='" . ('../../jenis.php') . "';</script>";
 	} else {
 		echo '<script type="text/javascript"> alert("Data tidak berhasil ditambahkan");</script>'.mysqli_error($koneksi);
		echo "<script>window.location='" . ('../../jenis.php') . "';</script>";
 	}	
 }