<?php
include 'koneksi.php';
require('vendor/setasign/fpdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

//header logo kiri
$pdf->SetMargins(2,1,1);// atur margin tulisan dengan ujung kertas
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','BI',10);
$pdf->Image('image/laporan.png',1,0,7,3);//posisi X , Y , Lebar dan Tinggi

//header info toko
$pdf->SetX(13);            
$pdf->MultiCell(19.5,0.5,'Gudang Tenun, Inc',0,'L');
$pdf->SetX(13);
$pdf->MultiCell(19.5,0.5,'Admin, Inc',0,'L');
$pdf->SetX(13);
$pdf->MultiCell(19.5,0.5,'Kab. Jepara, Jawa Tengah',0,'L');
$pdf->SetX(13);
$pdf->MultiCell(19.5,0.5,'Phone : 0858 7630 3781',0,'L');

//header gambar kanan
$pdf->Image('image/laporan.png',21,0,7,3);//posisi X , Y , Lebar dan Tinggi

if (isset($_GET['hari'])){
	$judul='Laporan penjualan Hari Ini';

	$hari=date('d');
	$bulan=date('n');
	$sql = "SELECT penjualan.kode AS kode2,tanggal,nama_barang,harga_jual,jumlah,laba,status,nama FROM penjualan INNER JOIN pembeli ON penjualan.	kode=pembeli.kode WHERE MONTH(tanggal)='$bulan' AND DAY(tanggal)='$hari' ORDER BY tanggal";
	$tampil =mysqli_query($link,$sql);

	$sql2="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$bulan' AND DAY(tanggal)='$hari'";
	$tampil2=mysqli_query($link,$sql2);

} elseif (isset($_GET['bulan'])) {
	$judul='Laporan Penjualan Bulan '.date('F');

	$bulan=date('n');
	$sql = "SELECT penjualan.kode AS kode2,tanggal,nama_barang,harga_jual,jumlah,laba,status,nama FROM penjualan INNER JOIN pembeli ON penjualan.	kode=pembeli.kode WHERE MONTH(tanggal)='$bulan' ORDER BY tanggal";
	$tampil =mysqli_query($link,$sql);

	$sql2="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$bulan'";
	$tampil2=mysqli_query($link,$sql2);

} elseif (isset($_GET['rentang'])) {
	$ganti=str_replace('/', '-', $_GET['rentang']);//ubah europan style
	$rentang=explode(' - ',$ganti);//ambil tanggal awal dan akhir
	$judul='Laporan penjualan dari tanggal '.date('d F Y',strtotime($rentang[0])).' ~ '.date('d F Y',strtotime($rentang[1]));

	$date=date('Y-m-d',strtotime($rentang[0]));
	$date2=date("Y-m-d",strtotime($rentang[1]));

	$sql = "SELECT penjualan.kode AS kode2,tanggal,nama_barang,harga_jual,jumlah,laba,status,nama FROM penjualan INNER JOIN pembeli ON penjualan.	kode=pembeli.kode WHERE tanggal BETWEEN '$date'AND '$date2' ORDER BY tanggal";
	$tampil =mysqli_query($link,$sql);

	$sql2="SELECT SUM(laba) FROM penjualan WHERE tanggal BETWEEN '$date'AND '$date2'";
	$tampil2=mysqli_query($link,$sql2);

}
//garis setelah header
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
//
$pdf->SetFont('Arial','BI',14);
$pdf->Cell(25.5,0.7, $judul ,0,10,'C');
$pdf->SetFont('Arial','I',9);
date_default_timezone_set('Asia/Jakarta');
$pdf->Cell(5,0.7,"Di cetak pada : ".date("d-m-Y")."  pukul ".date("H:i:s"),0,0,'C');
$pdf->ln(1);

//tabel penjualan
$pdf->SetFont('Arial','B',10);
$pdf->SetX(0.8);			
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Order ID', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'item', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Jual x jumlah', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'laba', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Status', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'pembeli', 1, 1, 'C');
$pdf->SetFont('Arial','',10);

$no=1;
while ($lihat=mysqli_fetch_array($tampil)) { 
	$pdf->SetX(0.8);
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['kode2'] , 1, 0, 'C');
	$pdf->Cell(5, 0.8, date('d M Y',strtotime($lihat['tanggal'])) , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['nama_barang'] , 1, 0, 'C');
	$pdf->Cell(4, 0.8, 'Rp '.number_format($lihat['harga_jual']).' x '.$lihat['jumlah'] , 1, 0, 'C');
	$pdf->Cell(2, 0.8, number_format($lihat['laba']) , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['status'] , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama'] , 1, 1, 'C');
	$no++;
}
$laba=mysqli_fetch_row($tampil2);
$pdf->ln(1);
$pdf->SetX(15);
$pdf->Cell(7,0.7, 'Total Laba : Rp '.number_format($laba[0]) ,0,2,'L');

//footer signature
$pdf->SetX(22);
$pdf->Cell(7,0.7, 'jepara, '.date('d M Y') ,0,1,'L');
$pdf->ln(2);
$pdf->SetX(22);
$pdf->Cell(15,0.7, '(                                 )' ,0,1,'L');
//print
$pdf->Output("laporan_db.pdf","I");
?>