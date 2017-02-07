<?php
include "koneksi.php";
$data = json_decode(file_get_contents("php://input"));
	
	
$kode = mysqli_real_escape_string($link, $data->kode);
	
	$deletePen = "DELETE FROM penjualan_temp WHERE kode='$kode'"; 
	$resultPen = mysqli_query($link,$deletePen);
	
	$deletePem = "DELETE FROM pembeli_temp WHERE kode='$kode'";
	$resultPem = mysqli_query($link,$deletePem);

	echo true;

?>