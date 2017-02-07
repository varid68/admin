<?php
session_start();
include "koneksi.php";

$user=mysqli_real_escape_string($link,$_POST['user']);
$sandi=mysqli_real_escape_string($link,$_POST['sandi']);
$sandi_db=sha1($sandi);

$query="SELECT * FROM admin WHERE user='$user' AND sandi='$sandi_db'";
$result=mysqli_query($link,$query);

if (mysqli_num_rows($result)==1){
	$_SESSION['login']=$user;
	header("location:beranda.php");
		}
else{
	header("location:index.php?s");
		}				
	
?>