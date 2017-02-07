<?php 	include "koneksi.php";

if(isset($_POST['tambah'])){
	$nama=strip_tags($_POST['nama_tenun']); $modal=strip_tags(str_replace(".", "", $_POST['modal'])); 
	$jual=strip_tags(str_replace(".", "", $_POST['harga_jual'])); $jumlah=strip_tags($_POST['jumlah']);

	$query="INSERT INTO data_barang VALUES(NULL,'$nama','$modal','$jual','$jumlah')";
	$result=mysqli_query($link,$query);

	if($result){
		header('location:data_barang.php?v');
	}	
}


elseif(isset($_POST['edit'])){
	$nama=strip_tags($_POST['nama_tenun']); $modal=strip_tags(str_replace(".", "", $_POST['modal'])); 
	$jual=strip_tags(str_replace(".", "", $_POST['harga_jual'])); $jumlah=strip_tags($_POST['jumlah']);
	$id = $_POST['id'];

	$query="UPDATE data_barang SET nama_barang='$nama',modal='$modal',harga_jual='$jual',jumlah='$jumlah' WHERE id = '$id'";
	$result=mysqli_query($link,$query);

	if($result){
		header("location:data_barang.php?v");
	}
	
}


elseif(isset($_GET['ref'])){
	$nama=$_GET['ref'];

	$query="DELETE FROM data_barang WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query); var_dump($result,$nama); 

	if($result){
		header("location:data_barang.php?v");
	}
	else echo "gagal";
}


elseif(isset($_POST['jumlah2'])){
	$jumlah=strip_tags($_POST['jumlah']);
	$nama=strip_tags($_POST['nama']);

	$query="UPDATE data_barang SET jumlah='$jumlah' WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query);

	if($result){
		header("location:data_barang.php?v");
	}
}
?>