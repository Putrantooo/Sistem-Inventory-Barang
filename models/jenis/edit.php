  <?php
include '../../inc/koneksi.php';
$id_kategori    = $_POST['id_kategori'];
$nama    = $_POST['nama'];
$Status = $_POST['Status'];

$sql = mysqli_query($koneksi, "UPDATE tb_kategori SET nama = '$nama', Status_kat = '$Status' WHERE id_kategori = '$id_kategori'");
if ($sql) {
    $_SESSION['message'] = "Data berhasil diubah!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . ('../../jenis.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}
