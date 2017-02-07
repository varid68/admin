<?php include 'koneksi.php'; 

	if (isset($_POST['submit'])) {
		//tabel penjualan temporary
		$kode = strip_tags($_POST['kode']);
		$tanggal = date("Y-m-d",strtotime($_POST['tanggal']));
		$nama_barang = strip_tags($_POST['nb']);
		$harga_jual = strip_tags($_POST['harga_jual']);
		$jumlah = strip_tags($_POST['jumlah']);
		$total_harga = strip_tags($_POST['total_harga']);
		$status = 'ordered';

		//tabel pembeli temporary
		$nama = strip_tags($_POST['nama']);
		$kontak = strip_tags($_POST['kontak']);
		$prov = strip_tags($_POST['provinsi']);
		$kab = strip_tags($_POST['kabupaten']);
		$kec = strip_tags($_POST['kecamatan']);
		$alamat2 = strip_tags($_POST['alamat2']);
		$kurir = strip_tags($_POST['kurir']);

		$query= "INSERT INTO penjualan_temp VALUES(NULL,'$kode',NOW(),'$nama_barang','$harga_jual','$jumlah','$total_harga','$status')";
		$result= mysqli_query($link,$query);

		$query2= "INSERT INTO pembeli_temp VALUES(NULL,'$kode','$nama','$kontak','$prov','$kab','$kec','$alamat2','$kurir')";
		$result2= mysqli_query($link,$query2);

		if ($result) {
			header('location:mobile.php');
		}
	}

?>