<?php
include "../koneksi.php";
date_default_timezone_set('Asia/Jakarta');
$data = json_decode(file_get_contents("php://input"));

$kode = mysqli_real_escape_string($link, $data->kode);
$tanggal = date('Y-m-d');
$item = mysqli_real_escape_string($link, $data->item);
$jual = mysqli_real_escape_string($link, $data->jual);
$jumlah = mysqli_real_escape_string($link, $data->jumlah);
$total = mysqli_real_escape_string($link, $data->total);
$status = 'sending';
$io = 'varid68';

$pembeli = mysqli_real_escape_string($link, $data->pembeli);
$kontak = mysqli_real_escape_string($link, $data->kontak);
$prov = mysqli_real_escape_string($link, $data->prov);
$kab = mysqli_real_escape_string($link, $data->kab);
$kec = mysqli_real_escape_string($link, $data->kec);
$alamat2 = mysqli_real_escape_string($link, $data->alamat2);
$kurir = mysqli_real_escape_string($link, $data->kurir);
$resi = mysqli_real_escape_string($link, $data->resi);

$getModal = "SELECT modal FROM data_barang WHERE nama_barang = '$item'";
$hasil = mysqli_query($link,$getModal);
$r = mysqli_fetch_row($hasil);
$laba = $total - ($r[0] * $jumlah);

$insertPen = "INSERT INTO penjualan VALUES('$kode','$tanggal','$item','$jual','$jumlah','$total','$laba','$status','$io')";
$resultPen = mysqli_query($link,$insertPen);

$insertPem = "INSERT INTO pembeli VALUES('$kode','$pembeli','$kontak','$prov','$kab','$kec','$alamat2','$kurir','$resi')";
$resultPem = mysqli_query($link,$insertPem);

$updateStatus = "UPDATE penjualan_temp SET status = '$status' WHERE kode = '$kode'";
$resultUpdate = mysqli_query($link,$updateStatus);

?>