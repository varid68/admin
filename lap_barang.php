<?php
include 'koneksi.php';
require('vendor/setasign/fpdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(2,1,1);// atur margin tulisan dengan ujung kertas
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','BI',10);
$pdf->Image('image/laporan.png',1,0,6,3);//posisi X , Y , Lebar dan Tinggi

$pdf->SetX(14);            
$pdf->MultiCell(19.5,0.5,'Gudang Tenun, Inc',0,'L');
$pdf->SetX(14);
$pdf->MultiCell(19.5,0.5,'Admin, Inc',0,'L');
$pdf->SetX(14);
$pdf->MultiCell(19.5,0.5,'Kab. Jepara, Jawa Tengah',0,'L');
$pdf->SetX(14);
$pdf->MultiCell(19.5,0.5,'Phone : 0858 7630 3781',0,'L');

$pdf->Line(1,3.1,20.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,20.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','',14);
$pdf->Cell(14.5,0.7,"Laporan Data Barang",0,10,'L');
$pdf->SetFont('Arial','I',8);
date_default_timezone_set('Asia/Jakarta');
$pdf->Cell(5,0.7,"Di cetak pada : ".date("d-m-Y")."  pukul ".date("H:i:s"),0,0,'C');
$pdf->ln(1);

$pdf->SetFont('Arial','B',10);			
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'modal', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'harga jual', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query="SELECT * FROM data_barang ORDER BY nama_barang";
$result=mysqli_query($link,$query);
while($lihat=mysqli_fetch_assoc($result)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, ucwords($lihat['nama_barang']),1, 0, 'C');
	$pdf->Cell(3, 0.8, number_format($lihat['modal']), 1, 0,'C');
	$pdf->Cell(4, 0.8, number_format($lihat['harga_jual']),1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['jumlah'], 1, 1,'C');
	$no++;
}

$pdf->Output("laporan_db.pdf","I");


?>