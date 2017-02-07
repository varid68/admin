<?php

include '../koneksi.php'; 

$query ="SELECT *,penjualan_temp.kode AS kode2 FROM penjualan_temp INNER JOIN pembeli_temp ON penjualan_temp.kode = pembeli_temp.kode ORDER BY tanggal DESC";
$result = mysqli_query($link, $query);

$arr = array();
if(mysqli_num_rows($result) != 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$arr[] = $row;
	}
}

echo json_encode($arr);

?>