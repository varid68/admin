<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>halaman login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bower_components/jquery-ripples/jquery.ripples.js"></script>
</head>
<body background="image/banner-bg.jpg">

<div class="container">

<?php
	if (isset($_GET['s'])){
		echo "<script> alert('User Atau Sandi Yang Anda Masukkan Salah'); </script>";
		echo "<div style='margin-bottom:-55px' class='alert alert-danger fade in col-md-5 col-md-offset-3' role='alert'><center><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>Login Gagal !! Username dan Password Salah !!</center></div>";
	}
?>

 <div class="row">
	<div class="col-md-3 col-md-offset-4" >
		<form action="login-act.php" method="post" style="margin-top: 210px">
			<div class="input-group">
				<span class="input-group-addon">
				  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</span>
				<input type="text" name="user" class="input-lg form-control" required="required">
			</div>
			<div class="input-group" style="margin-top: 7px">
				<span class="input-group-addon">
				  <span class="glyphicon glyphicon-lock"></span>
				</span>
				<input type="password" name="sandi" placeholder="kata sandi . . ." class="input-lg form-control" required="required">
				<span class="input-group-addon" style="cursor:pointer;background-color:white!important">
				  <a type="button" class="glyphicon glyphicon-eye-close"></a>
				</span>
			</div><br>

			<button class="btn btn-lg btn-danger btn-block" type="submit" name="masuk">Sign in</button>
		</form>
	</div>
</div> 
</div>

<button type="button" class="btn btn-xs btn-success" style="margin-top: 230px">button</button>

<script type="text/javascript">
		
		$('a[type=button]').click(function(){
			$a = $('input[name=sandi]');

			if($a.attr('type')=='password'){
				$a.attr('type','text');
				$(this).attr({
					'class':'glyphicon glyphicon-eye-open',
					'title':'sembunyikan password'});
				}
			else {
				$a.attr('type','password');
				$(this).attr({
					'class':'glyphicon glyphicon-eye-close',
					'title':'tampilkan password'});
				}
		});


		"use strict"; // Start of use strict
     
	    //Water effer
	    $('body').ripples({
	        resolution: 512,
	        dropRadius: 20,
	        perturbance: 0.01,
	    });    
</script>

</body>
</html>