<?php include "koneksi.php";
if(isset($_POST['submit'])){

	$jenis_gambar=$_FILES['avatar']['type'];

	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/png")
 	{
        $nama_lengkap=$_POST['nama']; 
        $user=$_POST['user']; $sandi=$_POST['pass']; 
		$tempat=$_FILES['avatar']['tmp_name']; 
		$avatar=$_FILES['avatar']['name'];

	$path="image/$avatar";
	move_uploaded_file($tempat,$path);

	$query="UPDATE admin SET nama_lengkap='$nama_lengkap',user='$user',sandi='$sandi',foto='$avatar'";
	$result=mysqli_query($link,$query);
	if($result){
		header('location:beranda.php');	}}
	else {
        echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
  	}	
}

?>