<?php 
include 'koneksi.php';

foreach ($_POST['jumlah'] as $key => $value) {

	$query = "UPDATE data_barang SET jumlah = '$value' WHERE nama_barang = '$key'";
	$hasil = mysqli_query($link,$query);
} 

var_dump($hasil);
?>