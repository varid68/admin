<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Font Awesome -->
   <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">  

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body background="image/banner-bg.jpg" style="color:#fcf8e3">

<div class="container">
	<h3 class="text-center">Lorem ipsum dolor sit amet.</h3><br><br><br>

<form action="order_insert.php" method="POST" class="form-horizontal" role="form">
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>kode pesanan</p>
				</div>
				<div class="col-md-3">
					<p id="kode">g6hg0</p>
					<input type="hidden" name="kode" class="form-control">
					<?php date_default_timezone_set('Asia/Jakarta'); $waktu = date('Y-m-d H:i'); ?>
					<input type="hidden" name="tanggal" class="form-control" value="<?php echo $waktu; ?>">
				</div>
				<div class="col-md-2">
					<p>nama anda</p>
				</div>
				<div class="col-md-3">
					<input type="text" name="nama" class="form-control" required="required">
				</div>
			</div>
		</div><br><br>

		
		
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>item</p>
				</div>
				<div class="col-md-3">
					<select name="nb" id="nb" class="form-control" required="required">
						<?php include 'koneksi.php';

							$query="SELECT nama_barang FROM data_barang ORDER BY nama_barang";
							$result=mysqli_query($link,$query);

							while($r=mysqli_fetch_array($result)){ ?>
						<option value="<?php echo $r['nama_barang']; ?>"><?php echo $r['nama_barang']; }?></option>
					</select>
				</div>

				<div class="col-md-2">
					<p>kontak</p>
				</div>
				<div class="col-md-3">
					<input type="text" name="kontak" class="form-control" required="required">
				</div>
			</div>
		</div><br><br>

		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>harga jual X jumlah</p>
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="col-md-4">
							<p id="harga_jual">12.000</p>
							<input type="hidden" name="harga_jual" class="form-control">
						</div>

						<div class="col-md-8">
							<input type="text" name="jumlah" class="form-control" required="required">
						</div>
					</div>
				</div>


				<div class="col-md-2">
					<p>prov</p>
				</div>
				<div class="col-md-3">
					<select name="provinsi" id="provinsi" class="form-control" required="required">						
						<option value="provinsi">provinsi</option>
					</select>			
				</div>
			</div>
		</div><br><br>


		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>total harga</p>
				</div>
				<div class="col-md-3">
					<p id="total_harga">67.000</p>
					<input type="hidden" name="total_harga" class="form-control" required="required">
				</div>
				
				<div class="col-md-2">
					<p id="kab">kab</p>
				</div>

				<div class="col-md-3">
					<select name="kabupaten" id="kab2" class="form-control" required="required">
						<option value=""></option>
					</select>
				</div>
				<div class="col-md-1">
					<span><i class="fa fa-spinner fa-pulse fa-2x fa-fw" id="loading" style="display: none"></i></span>
				</div>
			</div>
		</div><br><br>


		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>kurir pengiriman</p> 
				</div>
				<div class="col-md-3">
					<select name="kurir" class="form-control" required="required" id="kurir">
						<option value="jne">jne</option>
						<option value="pos">pos</option>
						<option value="tiki">tiki</option>
					</select>
				</div>
				<div class="col-md-offset-2 col-md-3">
					<select name="kecamatan" id="kec2" class="form-control" required="required">
						<option value=""></option>
					</select>
				</div>
			</div>
		</div><br><br>
		
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<p>Berat (Gram)</p> 
				</div>
				<div class="col-md-2">
					<input type="text" id="berat" class="form-control" id="berat">
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-success btn-sm"  id="ambilHarga">Hitung</button>
				</div>
				<div class="col-md-offset-2 col-md-3">
					<textarea name="alamat2" id="input" class="form-control" rows="3" required="required"></textarea>
				</div>
			</div>
		</div><br><br>


		<div class="form-group">
			<div class= "pull-right">
				<button type="submit" name="submit" class="btn btn-block btn-primary">Submit</button>
			</div>
		</div>
</form>

	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center">Ongkir<i class="fa fa-spinner fa-pulse fa-2x fa-fw" id="loading2" style="display: none;"></i></h3>

		</div>
		<div class="col-md-12">
			<table class="table table-responsive">
				<thead>
					<tr>
						<th>No.</th>
						<th class="col-md-2">Kurir</th>
						<th class="col-md-3">Servis</th>
						<th class="col-md-3">Deskripsi Servis</th>
						<th class="col-md-2">Lama Kirim (hari)</th>
						<th class="col-md-2">Total Biaya (Rp)</th>
					</tr>
				</thead>
				<tbody id="resultsbox"></tbody>
			</table>
		</div>
	</div>

</div>

<script type="text/javascript">

	//script kode acak untuk order id
	$('document').ready(function(){
		var kode=Math.random().toString(36).substr(2, 5);
		$('#kode').html(kode);
		$('input[name=kode]').val(kode);
	});
	
	//script ambil nama tenun dan harga dg AJAX di modal edit
	$('#nb').change(function(){
		var nama=$(this).val();
								
		$.ajax({
			url:'ajax.php',
			data: "nama_db="+nama,
			dataType:'json',
			success : function(data){
						
				$('p#harga_jual').html(data.harga_jual);
				$('input[name=harga_jual').val(data.harga_jual);
			}
		});
	});


	$('input[name=jumlah]').keyup(function(){
		$('p#total_harga').html($(this).val()*$('input[name=harga_jual').val());
		$('input[name=total_harga]').val($(this).val()*$('input[name=harga_jual').val());
	});


	//tampilkan kecamatan berdasarkan value kabupaten
	$('#kab2').change(function(){
		var kab=$('#kab2 option:selected').text();
		$('#kec2').empty();

		$.ajax({
			url:'ajax.php',
			data: 'kab='+kab,
			dataType:'json',
			success : function(data){
				$.each(data, function(index, row) {
					$('#kec2').append($('<option>',{
					value:row.nama,
					text:row.nama
					}));
				});										
			}
		});
	});
</script>

<script>
	$(document).ready(function(){
		loadProvinsi('#provinsi');

		function loadProvinsi(id){
			$.ajax({
				url:'hitungOngkir/proses.php?act=tampilprovinsi',
				dataType:'json',
				success : function(response){		
					$.each(response['rajaongkir']['results'], function(index, row) {
						$(id).append($('<option>',{
							value:row.province_id,
							text:row.province
						}));
					});			  		
				}						
			});
		}

		$('#provinsi').change(function(){
			var idProvinsi = $('#provinsi').val();
			$('#kab2').empty();
			loadKabupaten (idProvinsi,'#kab2');
		});

		function loadKabupaten (idProvinsi , id){
			$.ajax({
				url:'hitungOngkir/proses.php?act=tampilkabupaten',
				dataType:'json',
				data:{provinsi : idProvinsi},
				beforeSend : function(){ 
					$('#loading').show();
					$(id).prop('disabled',true);
				},
				complete :function(){ 
					$('#loading').hide();
					$(id).prop('disabled',false); 
				},
				success : function(response){		
					$.each(response['rajaongkir']['results'], function(index, row) {
						$(id).append($('<option>',{
							value:row.city_id,
							text:row.city_name
						}));
					});			  	
				}						
			});
		}

		$('#ambilHarga').click(function(){
			cekHarga();
		})

		function cekHarga(){
			var asal = 163 ;
			var tujuan = $('#kab2').val();
			var berat = $('#berat').val();
			var kurir = $('#kurir').val();
			$.ajax({
				url:'hitungOngkir/proses.php?act=cost',
				data:{asal:asal,tujuan:tujuan,berat:berat,kurir:kurir},
				beforeSend : function(){ 
					$('#loading2').show();
				},
				complete :function(){ 
					$('#loading2').hide();
				},
				success:function(response){
					$('#resultsbox').html(response);
				},
				error:function(){
					$('#resultsbox').html('ERROR');
				}
			});
		}

	});
</script>

</body>
</html>