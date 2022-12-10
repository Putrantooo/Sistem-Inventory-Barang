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
$pdf->MultiCell(19.5, 1, 'LAPORAN MUTASI', 0, 'C');
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
$pdf->Cell(2.5, 1, 'KODE MUTASI', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'KODE PAYUNG', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'NAMA PAYUNG', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'HARGA', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'JUMLAH', 1, 0, 'C');
$pdf->Cell(2.5, 1, 'TOTAL', 1, 1, 'C');

// Isi Data di tabel
$query = mysqli_query($koneksi, "SELECT tb_mutasi.kd_mutasi,tb_mutasi.Tanggal,tb_payung.kd_payung,tb_payung.Nama,tb_detailmutasi.harga,tb_detailmutasi.jumlah, tb_detailmutasi.Total FROM tb_detailmutasi
    INNER JOIN tb_mutasi ON tb_detailmutasi.kd_mutasi = tb_mutasi.kd_mutasi
    INNER JOIN tb_payung ON tb_detailmutasi.kd_payung = tb_payung.kd_payung
    WHERE Tanggal BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $pdf->SetFont('Times', '', 6);
    $pdf->Cell(0.8, 1, $no++, 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['kd_mutasi'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['Tanggal'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['kd_payung'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['Nama'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['harga'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['jumlah'], 1, 0, 'C');
    $pdf->Cell(2.5, 1, $row['Total'], 1, 1, 'C');
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
