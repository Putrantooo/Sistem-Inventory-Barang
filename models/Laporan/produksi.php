<?php
@session_start();
include '../../security.php';
require('../../phpfpdf/fpdf.php'); {
    date_default_timezone_set('Asia/Jakarta'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
}
require_once '../../inc/koneksi.php';

$tgl_mulai = $_POST["tglm"];
$tgl_selesai = $_POST["tgls"];


$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();
// Header
$pdf->SetFont('Times', 'B', 14);
$pdf->MultiCell(19.5, 1, 'Laporan Bahan Keluar (Produksi)', 0, 'C');
$pdf->SetX(2.8);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(15.5, 0.5, 'Ngentak Rt.01 Pondokrejo, Tempel, Sleman, DI Yogyakarta 55552, Indonesia', 0, 'C');
$pdf->SetX(2.8);
$pdf->MultiCell(15.5, 0.3, 'Kontak: 081328155900', 0, 'C');

$pdf->Line(0.5, 3.8, 20.5, 3.8);
$pdf->SetLineWidth(0.1);
$pdf->Line(0.5, 3.9, 20.5, 3.9);
$pdf->SetLineWidth(0.1);
$pdf->Ln();
// End header
// Format Tanggal
$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(1.5, 1, "Printed By : " . $_SESSION['nama_lengkap'], 0, 0, 'C');

$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(31.5, 1, "Printed On : " . date("D-d/m/Y H:i:s"), 0, 0, 'C');
$pdf->Ln();

// periode
$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(5.1, 1, "TANGGAL : " . $tgl_mulai .  " s/d "  . $tgl_selesai, 0, 0, 'C');

// Tabel
$pdf->SetFont('Times', 'B', 6);
$pdf->SetLineWidth(0);
$pdf->Cell(0.5, 1, '', 0, 1);
$pdf->Cell(0.8, 1, 'NO', 1, 0, 'C');
$pdf->Cell(4.5, 1, 'KODE PRODUKSI', 1, 0, 'C');
$pdf->Cell(4.5, 1, 'KODE BAHAN', 1, 0, 'C');
$pdf->Cell(4.5, 1, 'NAMA BAHAN', 1, 0, 'C');
$pdf->Cell(4.5, 1, 'JUMLAH', 1, 1, 'C');

// Isi Data di tabel
$query = mysqli_query($koneksi, "SELECT tb_produksi.kd_produksi, tb_bahan.kode_bahan, tb_bahan.nama_bahan, tb_detailproduksi.jumlah, tb_produksi.Tanggal FROM tb_detailproduksi
    INNER JOIN tb_produksi ON tb_detailproduksi.kd_produksi = tb_produksi.kd_produksi
    INNER JOIN tb_bahan ON tb_detailproduksi.kode_bahan = tb_bahan.kode_bahan
    WHERE Tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $pdf->SetFont('Times', '', 6);
    $pdf->Cell(0.8, 1, $no++, 1, 0, 'C');
    $pdf->Cell(4.5, 1, $row['kd_produksi'], 1, 0, 'C');
    $pdf->Cell(4.5, 1, $row['kode_bahan'], 1, 0, 'C');
    $pdf->Cell(4.5, 1, $row['nama_bahan'], 1, 0, 'C');
    $pdf->Cell(4.5, 1, $row['jumlah'], 1, 1, 'C');
}

$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(32.5, 1, "Yogyakarta, ................................................", 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(32.5, 5, "(Admin)", 0, 0, 'C');
$pdf->Ln();
$pdf->Output();
