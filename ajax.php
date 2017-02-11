<?php

include "koneksi.php";
header('Content-type: text/html; charset=utf-8');

if(isset($_GET['nama_db'])){
	$nama=$_GET['nama_db'];

	$query="SELECT * FROM data_barang WHERE nama_barang='$nama'";
	$result=mysqli_query($link,$query);

	$r=mysqli_fetch_assoc($result);

	$data=array(
		'id'=>$r['id'],
		'harga_jual'=>$r['harga_jual'],
		'modal'=>$r['modal'],
		'jumlah'=>$r['jumlah'],
		'nama_barang'=>$r['nama_barang']);

	echo json_encode($data);	
}

elseif(isset($_GET['prov'])){
	$prov=$_GET['prov'];

	$query="SELECT id FROM provinsi WHERE nama='$prov'";
	$result=mysqli_query($link,$query);

	$r=mysqli_fetch_assoc($result);

	$id=$r['id'];

	$query="SELECT nama FROM  kabupaten WHERE id_prov='$id' ORDER BY nama";
	$result=mysqli_query($link,$query);

	$arr=array();
	while($r=mysqli_fetch_assoc($result)){
		$data=array(
			'nama'=>$r['nama']);
		array_push($arr, $data);
	}
	echo json_encode($arr);	
}


elseif(isset($_GET['kab'])){
	$kab='Kab. '.$_GET['kab'];

	$query="SELECT id FROM kabupaten WHERE nama='$kab'";
	$result=mysqli_query($link,$query);

	$r=mysqli_fetch_assoc($result);

	$id=$r['id'];

	$query="SELECT nama FROM  kecamatan WHERE id_kabupaten='$id' ORDER BY nama";
	$result=mysqli_query($link,$query);

	$arr=array();
	while($r=mysqli_fetch_assoc($result)){
		$data=array(
			'nama'=>$r['nama']);
		array_push($arr, $data);
	}
	echo json_encode($arr);	
}


elseif(isset($_POST['status'])){
	$status=$_POST['status'];
	$kode=$_POST['kode'];

	$query="UPDATE penjualan SET status='$status' WHERE kode='$kode'";
	$result=mysqli_query($link,$query);

	if($result){
		echo json_encode(array('result'=>true));
	}
	else{
		echo json_encode(array('result'=>false));
	}
}


elseif(isset($_GET['kode'])){
	$kode=$_GET['kode'];

	$query="SELECT *,penjualan.kode AS kode2 FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode WHERE penjualan.kode='$kode'";
	$result=mysqli_query($link,$query);

	$r=mysqli_fetch_assoc($result);

	$data=array(
		'kode'=>$r['kode2'],
		'tanggal'=>date('d F Y',strtotime($r['tanggal'])),
		'nama_barang'=>$r['nama_barang'],
		'harga_jual'=>$r['harga_jual'],
		'jumlah'=>$r['jumlah'],
		'total_harga'=>$r['total_harga'],
		'nama'=>$r['nama'],
		'kontak'=>$r['kontak'],
		'prov'=>$r['prov'],
		'kab'=>$r['kab'],
		'kec'=>$r['kec'],
		'alamat2'=>$r['alamat2'],
		'kurir'=>$r['kurir'],
		'resi'=>$r['resi'],
		'laba'=>$r['laba'],
		'status'=>$r['status']);

	if(isset($_GET['nama'])){
		$nama=$_GET['nama'];

		$query="SELECT modal,jumlah FROM data_barang WHERE nama_barang='$nama'";
		$result=mysqli_query($link,$query);
		$r=mysqli_fetch_assoc($result);

		$modal=$r['modal'];
		$jumlahDb=$r['jumlah'];

		function array_push_assoc($array, $key, $value){
			$array[$key] = $value;
			return $array;
		}

		$data = array_push_assoc($data, 'modal', "$modal");
		$data = array_push_assoc($data, 'jumlahDb', "$jumlahDb");
	}	
echo json_encode($data);	
}


elseif ($_POST['data']) {
	$data = $_POST['data'];

	foreach ($data as $value) {
		$queryPen = "DELETE FROM pejualan_temp WHERE kode = '$value'";
		$result = mysqli_query($link,$queryPen);

		$queryPem = "DELETE FROM pembeli_temp WHERE kode = '$value'";
		$result = mysqli_query($link,$queryPem);
	}
	echo true;
}

?>