<?php
include "koneksi.php";
include "header.php";

$sesi=$_SESSION['login'];
$query="SELECT * FROM admin WHERE user='$sesi'";
$result=mysqli_query($link,$query);

$r=mysqli_fetch_assoc($result);
?>
<h3 class="text-center">edit profil</h3>

<form action="edit_profil.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post">             
  
	<div class="form-group">
		<label class="col-sm-4 control-label">Nama Lengkap</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" required="required" name="nama" value="<?php echo $r['nama_lengkap']; ?>">
		</div>
	</div>
  
	<div class="form-group">
    	<label class="col-sm-4 control-label">Username</label>
    	<div class="col-sm-5">
      		<input type="text" class="form-control" required="required" name="user" value="<?php echo $r['user']; ?>">
    	</div>
  	</div>  

  	<div class="form-group">
    	<label class="col-sm-4 control-label">Password</label>
    	<div class="col-sm-5">
      		<input type="password" id="password1"class="form-control" required="required" name="pass" value="<?php echo $r['sandi']; ?>">
	  		<a class="text-red">*ubah password secara berkala demi menjaga keamanan</a>
    	</div>
  	</div>

  	<div class="form-group">
    	<label class="col-sm-4 control-label">Konfirmasi Password</label>
    	<div class="col-sm-5">
      		<input type="password" id="password2"class="form-control" required="required">
      		<a class="password2 text-red"></a>	  
    	</div>
  	</div>

  	<div class="form-group">
    	<label class="col-sm-4 control-label">ubah avatar</label>
    	<div class="col-sm-5">
      		<input type="file" name="avatar" id="preview_gambar" class="form-control" data-icon="false">	  
    	</div>
  	</div>

  	<div class="form-group">
  	<div class="col-sm-offset-4">
  		<img src="image/<?php echo $r['foto']; ?>" id="avatar" width="100" alt=" " />
  	</div>
  	</div>

  	<div class="form-group">
    	<label class="col-sm-4 control-label">  </label>
    	<div class="col-sm-5">
    		<a href="javascript:history.back()" class="btn btn-info pull-right">Kembali</a>
    		<button type="submit" name="submit" class="btn btn-success">Simpan</button>	
    	</div>
  	</div>   
</form>
<script type="text/javascript">
	function bacaGambar(input) {
   		if (input.files && input.files[0]) {
     	var reader = new FileReader();
 
      	reader.onload = function (e) {
          $('#avatar').attr('src', e.target.result);
      }
 
      	reader.readAsDataURL(input.files[0]);
   	}
}

$("#preview_gambar").change(function(){
   bacaGambar(this);
});

$('#password2').on('keyup',function(){
	var password1=$('#password1').val();
	var password2=$('#password2').val();

	if (password1!=password2){
		$('.password2').html('password tidak sama');
    $('button[name=submit]').hide(500);
	}
	else{
    $('.password2').html(' ');
    $('button[name=submit]').show();}
});
</script>
<?php include "footer.php"; ?>