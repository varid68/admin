<?php
include "koneksi.php";

if(isset($_POST['entry'])){
	//input data barang
	$date=strip_tags(date("Y-m-d",strtotime($_POST['tanggal']))); 
	$nama=$_POST['nama_tenun']; 
	$harg=$_POST['harga_jual'];
	$harga=(int)str_replace(".", "", $harg);
	$jumlah=$_POST['jumlah'];
	$total_harg=$_POST['total_harga'];
	$total_harga=(int)str_replace(".", "", $total_harg);
	$status=$_POST['status'];
	$laba=$_POST['laba'];
	$input_oleh=$_POST['input_oleh'];

	//data pembeli
	$nama_pembeli=strip_tags($_POST['nama_pembeli']);
	$kontak=strip_tags($_POST['kontak']);
	$kurir=$_POST['kurir'];
	$prov=strip_tags($_POST['prov']);
	$kab=$_POST['kab'];
	$kec=$_POST['kec'];
	$alamat2=strip_tags($_POST['alamat2']);
	$kode=$_POST['kode'];
	$resi=strip_tags($_POST['resi']);

	$query="SELECT jumlah FROM data_barang WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query);

	$r=mysqli_fetch_assoc($result);

	echo $a=$r['jumlah']-$jumlah;

	$query="UPDATE data_barang SET jumlah='$a' WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query);
	
	$query="INSERT INTO penjualan VALUES('$kode','$date','$nama','$harga','$jumlah','$total_harga','$laba','$status','$input_oleh')";
	$result=mysqli_query($link,$query);
	
		
	$query1="INSERT INTO pembeli VALUES('$kode','$nama_pembeli','$kontak','$prov','$kab','$kec','$alamat2','$kurir','$resi')";
	$result1=mysqli_query($link,$query1);
	
	if ($result && $result1)		
		header("location:penjualan.php?v");			
	
}

elseif(isset($_POST['edit'])){
	//input data barang
	$date=date("Y-m-d",strtotime($_POST['tanggal']));
	$nama=$_POST['nama_tenun'];
	$harg=$_POST['harga_jual'];
	$harga=(int)str_replace(".", "", $harg);
	$jumlah=$_POST['jumlah'];
	$total_harg=$_POST['total_harga'];
	$total_harga=(int)str_replace(".", "", $total_harg);
	$status=$_POST['status']; 
	$laba=$_POST['laba'];
	$input_oleh=$_POST['input_oleh'];

	//data pembeli
	$nama_pembeli=strip_tags($_POST['nama_pembeli']);
	$kontak=strip_tags($_POST['kontak']);
	$kurir=$_POST['kurir'];
	$prov=strip_tags($_POST['prov']);
	$kab=$_POST['kab'];
	$kec=$_POST['kec'];
	$alamat2=strip_tags($_POST['alamat2']);
	$kode=$_POST['kode'];
	$resi=strip_tags($_POST['resi']);

	$query="SELECT data_barang.jumlah AS jum_db, penjualan.jumlah AS jum_pen FROM data_barang INNER JOIN penjualan ON data_barang.nama_barang=penjualan.nama_barang WHERE penjualan.kode='$kode'";
	$result=mysqli_query($link,$query);
	while($r=mysqli_fetch_assoc($result)){

	$a=$r['jum_db'];
	$b=$r['jum_pen'];
}
	$c=$a+$b-$jumlah;

	$query="UPDATE data_barang SET jumlah='$c' WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query);


	$query="UPDATE penjualan SET kode='$kode',tanggal='$date',nama_barang='$nama',harga_jual='$harga',jumlah='$jumlah',total_harga='$total_harga',laba='$laba',status='$status',input_oleh='$input_oleh' WHERE kode='$kode'";
	$result=mysqli_query($link,$query);

	$query1="UPDATE pembeli SET kode='$kode',nama='$nama_pembeli',kontak='$kontak',prov='$prov',kab='$kab',kec='$kec',alamat2='$alamat2',kurir='$kurir',resi='$resi' WHERE kode='$kode'";
	$result1=mysqli_query($link,$query1);

	if($result && $result1){
		header('location:penjualan.php?v');
	}}

	
elseif(isset($_GET['id'])){
	$kode=$_GET['id'];

	$query="DELETE FROM penjualan WHERE kode='$kode'";
	$result=mysqli_query($link,$query);

	$query1="DELETE FROM pembeli WHERE kode='$kode'";
	$result1=mysqli_query($link,$query1);


	if($result && $result1){
		header("location:penjualan.php?v");
	}}

?>