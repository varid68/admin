<?php
//connect ke database
 include 'koneksi.php';
//harus selalu gunakan variabel term saat memakai autocomplete,
//jika variable term tidak bisa, gunakan variabel q
$term = trim(strip_tags($_GET['term']));
  
$qstring = "SELECT * FROM  provinsi WHERE nama LIKE '$term%'";
//query database untuk mengecek tabel anime 
$result = mysqli_query($link,$qstring);

while ($row = mysqli_fetch_assoc($result)){

	$data[]=$row['nama'];
}

    
//data hasil query yang dikirim kembali dalam format json
echo json_encode($data);
?>