<?php 
include "header.php";
include "koneksi.php";
?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<div class="alert bg-maroon">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong><i class="fa fa-info"></i></strong> Klik detail penjualan untuk mencetak INVOICE!
</div>
<div class="box box-solid box-success">
	<div class="box-header">
		<h3 class="box-title"> Data Penjualan </h3>
		<a href="laporan.php" class="btn btn-sm pull-right" title='laporan PDF' style='margin-right:5px'><i class='fa fa-file-pdf-o'></i>&nbsp;&nbsp;unduh</a>
		<a class="btn btn-sm pull-right" id="entry" data-toggle="modal" href='#modal-entry' aria-hidden="true" data-backdrop="static">
		<i class="fa fa-pencil"></i>&nbsp;&nbsp;Entry</a>		
	</div>	

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr class="text-red">
					<th>No</th>
					<th class="col-md-2">Order ID</th>
					<th class="col-sm-2">Item</th>
					<th class="col-sm-2">Tgl terjual</th>
					<th>Harga jual</th> 
					<th>jumlah</th> 
					<th>status</th> 
					<th class="col-sm-1">Opsi</th>
				</tr>
			</thead>

			<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT *,penjualan.kode AS kode2 FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode ORDER BY tanggal DESC";
$tampil =mysqli_query($link,$sql);

$no=1;
while ($r=mysqli_fetch_array($tampil)) { 
?>
			
				<tr>
					<td><?php echo $no; ?></td>
					<td id="kode2"><?php echo $r['kode2']; ?></td>
					<td><?php echo $r['nama_barang']; ?></td>
					<td><?php $a=date('d M Y',strtotime($r['tanggal'])); echo $a; ?></td>
					<td><?php echo number_format($r['harga_jual']); ?></td>
					<td><?php echo $r['jumlah']; ?></td>
					<td><center><?php $a=$r['status']; echo $a=='ok'?"<span class='text-success glyphicon glyphicon-ok'>":"<span class='text-danger glyphicon glyphicon-remove'>"; ?></center></td>

					<td><a data-toggle="modal" href="#modal-edit" data-backdrop="static" class="biasa" title="edit"><span class="glyphicon glyphicon-edit"></span></a>

					<a data-toggle="modal" href="#modal-detail" data-backdrop="static" class="biasa" title="detail"><i class="fa fa-newspaper-o"></i></a>
	
					<a href="#" class="biasa hapus" title="hapus ?"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr><?php $no++; } ?>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<?php 
if (isset($_GET['v'])) {
	echo '<script>swal("selamat!", "Tindakan Berhasil Dilakukan!", "success");</script>';
}
?>

<!-- modal entry penjualan -->
<div class="modal fade" id="modal-entry">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove text-danger"></span></button>
				<h4 class="modal-title text-center">Input Penjualan</h4>
			</div>

			<div class="modal-body">
				<form action="jual_aksi.php" method="post" role="form" class="form-inline">

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal">Kode</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="kode" readonly="readonly">
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">pembeli</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="nama_pembeli" placeholder="Nama Pembeli" required="required" pattern="[a-z\s]{4,}" required title="Nama Minimum 4 karakter">
						</div>
					</div>
				</div></br></br>

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal">tanggal</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="tgl form-control input-sm" name="tanggal" placeholder="Tanggal" required="required">
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">kontak</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="kontak" required="required" pattern=".{9,}" required title="Kontak Minimum 9 karakter">
						</div>
					</div>
				</div></br></br>

					
				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">
							<p for="nama">Tenun</p>
						</div>
						<div class="col-md-4">
							<select class="form-control input-sm" name="nama_tenun" id="item1" required="required">
								<option selected="selected" disabled="disabled">- pilih tenun -</option>

								<?php
								$query="SELECT nama_barang FROM data_barang ORDER BY nama_barang";
								$result=mysqli_query($link,$query);

								while($r=mysqli_fetch_assoc($result)){ ?>
								<option value="<?php echo $r['nama_barang']; ?>"><?php echo $r['nama_barang']; } ?></option>
							
							</select>
						</div>
						<div class="col-md-2">
							<p for="kontak">No resi</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="resi" required="required" pattern=".{9,}" required title="No. Resi Minimum 9 karakter"></td>
						</div>
					</div>
				</div><br><br>
					

				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="harga jual" style="font-size: 11px">Harga X jumlah</p>
						</div>
						<div class="col-md-2">
							<input type="text" name="harga_jual" class="jual form-control input-sm" readonly="readonly" size="9px">
						</div>
						<div class="col-md-2" style="margin-left: -10px">
							<select class="form-control input-sm" name="jumlah" required="required"> 
								<?php
									for($i=1;$i<=10;$i++){ ?>
									<option value="<?php echo $i; ?>"><?php echo $i; } ?></option>
							</select>
						</div>
						<div class="col-md-2" style="margin-left: 10px">							
							<p for="kurir">kurir</p>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="kurir" required="required">
								<option disabled="disabled" selected="selected">- pilih kurir -</option>
								<option value="jne">jne</option>
								<option value="tiki">tiki</option>
								<option value="pos_indo">pos indo</option>
							</select>
						</div>
					</div>
				</div><br><br>
						
				
				<div class="container col-md-12">
					<div class="row">	
						<div class="col-md-2">
							<p for="total harga" style="font-size: 13px">total harga</p>
						</div>
						<div class="col-md-4">
							<input type="text" name="total_harga" class="form-control input-sm" readonly="readoly">
						</div>
						<div class="col-md-2">
							<p for="status">status</p>
						</div>
						<div class="col-md-4">
							<select class="form-control input-sm" name="status" required="required">
								<option disabled="disabled" selected="selected">- status -</option>
								<option value="ok">ok</option>
								<option value="sending">sending</option>
							</select>
						</div>
					</div>
				</div><br><br>

				
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="alamat">alamat</p>
						</div>
						<div class="col-md-3">
							<input type="text" class="prov form-control input-sm" name="prov" placeholder="masukkan provinsi" required="required" size="18px">
						</div>
						<div class="col-md-3">
							<select class="kab form-control input-sm" name="kab">
								<option readonly="readonly" selected="selected">- kabupaten -</option>
							</select>
						</div>
						<div class="col-md-3">
							<select class="kec form-control input-sm" name="kec">
								<option readonly="readonly" selected="selected">- kecamatan -</option>
							</select>
						</div>
					</div>
				</div><br><br>
	
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
						</div>
						<div class="col-md-7">
							<textarea class="form-control" name="alamat2" rows="2" cols="32" resize="none" required="required" style="resize: none;" pattern=".{15,}" required title="Alamat Lengkap Minimum 15 karakter"></textarea>
						</div>
						<div class="tampil-laba">
							<h5>&nbsp;&nbsp;</h5>
						</div>
					</div>
				</div>

				<div>
					<input type="hidden" class="modal">
					<input type="hidden" class="laba" name="laba" required="required">
					<input type="hidden" class="input_oleh" name="input_oleh" value="<?php echo $_SESSION['login']; ?>">
				</div>						
			</div><br><br><br>

			<div class="modal-footer">
				<input type="reset" class="reset btn btn-danger btn-sm" value="Reset">
				<input type="submit" class="entry btn btn-success btn-sm" value="entry" name="entry">
			</div></form>	

		</div>
	</div>
</div>
<!-- akhir modal input penjualan -->


<!-- modal edit penjualan -->
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Edit data penjualan</h4>
			</div>

			<div class="modal-body">
				<form action="jual_aksi.php" method="post" role="form" class="form-inline">

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal"> Kode </p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="kode" readonly="readonly">
						</div>
						<div class="col-md-2">
							<p for="nama pembeli"> pembeli </p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="nama_pembeli" required="required">
						</div>
					</div>
				</div></br></br>

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal"> tanggal </p>
						</div>
						<div class="col-md-4">
							<input type="text" class="tgl form-control input-sm" name="tanggal" required="required">
						</div>
						<div class="col-md-2">
							<p for="nama pembeli"> kontak </p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="kontak" required="required">
						</div>
					</div>
				</div></br></br>

					
				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">
							<p for="nama"> Item </p>
						</div>
						<div class="col-md-4">
							<select class="nb form-control input-sm" name="nama_tenun" id="item2" required="required">
								<option selected="selected" disabled="disabled">- pilih tenun -</option>

							<?php
							$query="SELECT nama_barang FROM data_barang ORDER BY nama_barang";
							$result=mysqli_query($link,$query);

							while($r=mysqli_fetch_assoc($result)){ ?>
							<option value="<?php echo $r['nama_barang']; ?>"><?php echo $r['nama_barang']; } ?></option>
								
							</select>
						</div>
						<div class="col-md-2">
							<p for="kontak"> No resi </p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" name="resi" required="required"></td>
						</div>
					</div>
				</div><br><br>
					

				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="harga jual" style="font-size: 11px">Harga X jumlah</p>
						</div>
						<div class="col-md-2">
							<input type="text" name="harga_jual" class="jual form-control input-sm" readonly="readonly" size="9px">
						</div>
						<div class="col-md-2">
							<input type="text" name="jumlah" class="form-control input-sm" size="2">
						</div>
						<div class="col-md-2">							
							<p for="kurir"> kurir </p>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="kurir" required="required">
								<option disabled="disabled" selected="selected">- pilih kurir -</option>
								<option value="jne">jne</option>
								<option value="tiki">tiki</option>
								<option value="pos_indo">pos indo</option>
							</select>
						</div>
					</div>
				</div><br><br>
						
				
				<div class="container col-md-12">
					<div class="row">	
						<div class="col-md-2">
							<p for="total harga" style="font-size: 13px">total harga</p>
						</div>
						<div class="col-md-4">
							<input type="text" name="total_harga" class="form-control input-sm" readonly="readonly">
						</div>
						<div class="col-md-2">
							<p for="status"> status </p>
						</div>
						<div class="col-md-4">
							<select class="form-control input-sm" name="status" required="required">
								<option disabled="disabled" selected="selected">- status -</option>
								<option value="ok">ok</option>
								<option value="sending">sending</option>
							</select>
						</div>
					</div>
				</div><br><br>

				
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="alamat"> alamat </p>
						</div>
						<div class="col-md-3">
							<input type="text" class="prov form-control input-sm" name="prov" required="required" size="15px">
						</div>							
						<div class="col-md-3" style="margin-left: -20px">
							<input type="text" class="kab1 form-control input-sm" name='kab' readonly="readonly" size="18px">
							<select class="kab form-control input-sm" name="kab">

							</select>						
						</div>
						<div class="col-md-3">
							<input type="text" class="kec1 form-control input-sm" name='kec' readonly="readonly">
							<select class="kec form-control input-sm" name="kec">

							</select>						
						</div>
					</div>
				</div><br><br>
	
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
						</div>
						<div class="col-md-7">
							<textarea class="alamat2 form-control" name="alamat2" rows="2" cols="36" resize="none" required="required" style="resize: none;"></textarea>
						</div>
						<div class="tampil-laba">
							<h5>&nbsp;&nbsp;</h5>
						</div>
					</div>
				</div>
				<p id="peringatan" class="text-danger"></p>

				<div>
					<input type="hidden" class="modal" name="modal">
					<input type="hidden" class="laba" name="laba" required="required">
					<input type="hidden" class="jumlahDb">
					<input type="hidden" class="input_oleh" name="input_oleh" value="<?php echo $_SESSION['login']; ?>">
				</div>

			</div>

			<div class="modal-footer">
				<input type="reset" class="reset btn btn-danger btn-sm" value="Reset">
				<input type="submit" class="edit btn btn-success btn-sm" value="simpan" name="edit">
			</div></form>		
		</div>
	</div>
</div>
<!-- akhir modal edit penjualan -->


<!-- modal detail penjualan -->
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Detail penjualan</h4>
			</div>

			<div class="modal-body">
				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="kode">Kode</p>
						</div>
						<div class="col-md-4">
							<p> kode1 </p>
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">pembeli</p>
						</div>
						<div class="col-md-4">
							<p> pembeli1 </p>
						</div>
					</div>
				</div></br></br>

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal">tanggal</p>
						</div>
						<div class="col-md-4">
							<p> tanggal1 </p>
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">kontak</p>
						</div>
						<div class="col-md-4">
							<p> kontak1 </p>
						</div>
					</div>
				</div></br></br>

				<div class="container col-md-12">
					<div class="row">
						<div class="col-md-2">
							<p for="nama">Item</p>
						</div>
						<div class="col-md-4">
							<p> Item1 </p>
						</div>
						<div class="col-md-2">
							<p for="kontak">No resi</p>
						</div>
						<div class="col-md-4">
							<p> resi1 </p>
						</div>
					</div>
				</div><br><br>
					
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="harga jual" style="font-size: 11px">Harga X jumlah</p>
						</div>
						<div class="col-md-4">
							<p> harga1 </p>
						</div>
						<div class="col-md-2">							
							<p for="kurir">kurir</p>
						</div>
						<div class="col-md-4">
							<p> kurir1 </p>
						</div>
					</div>
				</div><br><br>
						
				<div class="container col-md-12">
					<div class="row">	
						<div class="col-md-2">
							<p for="total harga" style="font-size: 13px">total harga</p>
						</div>
						<div class="col-md-4">
							<p> total1 </p>
						</div>
						<div class="col-md-2">
							<p for="status">status</p>
						</div>
						<div class="col-md-4">
							<p> status1 </p>
						</div>
					</div>
				</div><br><br>
	
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="alamat">alamat</p>
						</div>
						<div class="col-md-10">
							<p> alamat1 </p>
						</div>							
					</div>
				</div><br><br>
	
				<div class="container col-md-12">
					<div class="row">		
						<div class="col-md-4" id="tampil-laba">
							<h5>&nbsp;&nbsp;</h5>
						</div>
						<div class="pull-right">
							<a target="blank" class="btn btn-success btn-sm btn-flat">Get Invoices</a>
					</div>
				</div>

				<div>
					<input type="hidden" class="modal">
					<input type="hidden" class="laba" name="laba" required="required">
					<input type="hidden" class="input_oleh" name="input_oleh" value="<?php echo $_SESSION['login']; ?>">
				</div>
			</div>

			<div class="modal-footer">
				
			</div>
	
		</div>
	</div>
</div>

<script type="text/javascript">	
	//script ormat angka ribuan
	function formatAngka(angka) {
	 	if (typeof(angka) != 'string') angka = angka.toString();
		 	var reg = new RegExp('([0-9]+)([0-9]{3})');
			 while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 return angka;
		}

	$('input.prov').bind({
    	change: function(){
    	},
    	focus: function ( ){
        	$(this).data('orig_value', $(this).val());
    	},
   		blur: function () {
        	if ($(this).val() != $(this).data('orig_value')){
            	$(this).change();
        	}
    	}
	});

	//plugin pengganti alert ja
	$('.hapus').click(function(){
		var a=$(this).parent().siblings(':nth-child(2)').text();
		swal({
		  title: 'Apa Anda Yakin?',
		  text: "Ingin Menghapus Order ID "+a,
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(function () {
		    location.href='jual_aksi.php?id='+a
		});
	});

	//script ambil nama tenun dan harga dg AJAX di modal entry
	$a=$('#modal-entry').find('select[name=nama_tenun]');
	$b=$('#modal-entry');

	$a.change(function(){
	var nama=$(this).val();
							
		$.ajax({
			url:'ajax.php',
			data: "nama_db="+nama,
			dataType:'json',
			success : function(data){
					
				$b.find('.jual').val(formatAngka(data.harga_jual));
				$b.find('.modal').val(data.modal);
				if(data.jumlah<=10){
					alert('Stok Barang '+data.nama_barang+' = '+data.jumlah+', Silahkan Restok');
					$('#modal-entry').find('select[name=jumlah]').prop('disabled',true);
					$('#modal-entry').find('input[type=submit]').hide(1000);
				} else {
					$('#modal-entry').find('select[name=jumlah]').prop('disabled',false);
					$('#modal-entry').find('input[type=submit]').show(1000);
				}
			}
		});
	});


	//script total harga penjualan & laba di modal entry
	$b.find('select[name=jumlah]').change(function(){
		var inp = $b.find('input[name=harga_jual]').val().replace(/\./g, '');
		total=new Number(inp);
				
		var total_harga=total*$b.find('select[name=jumlah]').val();

		$b.find('input[name=total_harga]').val(formatAngka(total_harga));
		var modal=$b.find('.modal').val();
				
		var laba=total_harga-(modal*$b.find('select[name=jumlah]').val());
		$b.find('.tampil-laba').html('<h5><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;Rp'+formatAngka(laba)+'</h5>');
		$b.find('.laba').val(laba);
	});


	//hilangkan tampilan laba pada modal entry jika reset diklik
	$('#modal-entry,#modal-edit').find('.reset').click(function(){
		$('#modal-entry,modal-edit').find('.tampil-laba').html('');
	});

	//script ambil nama tenun dan harga dg AJAX di modal edit
	$('#item2').change(function(){
		var nama=$(this).val();
							
		$.ajax({
			url:'ajax.php',
			data: "nama_db="+nama,
			dataType:'json',
			success : function(data){
					
				$('#modal-edit').find('.jual').val(formatAngka(data.harga_jual));
				$('#modal-edit').find('.modal').val(data.modal);
				if(data.jumlah<=20){
					alert('Stok Barang '+data.nama_barang+' = '+data.jumlah+', Silahkan Restok');
					$('#modal-edit').find('input[name=jumlah]').prop('disabled',true);
					$('#modal-edit').find('input[type=submit]').hide(1000);
				} else {
					$('#modal-edit').find('input[name=jumlah]').prop('disabled',false);
					$('#modal-edit').find('input[type=submit]').show(1000);
				}
			}
		});
	});


	//tampilkan value penjualan di modal edit dan detail
	$('#example1').find('td a').click(function(){
		$this=$(this);
		$a=$('#modal-edit').find('input[type=text]');
		$b=$('#modal-edit').find('input[type=text][readonly=readonly]');
		$c=$('#modal-edit').find('select');

		$d=$('#modal-detail').find('p');

		if($this.is(':first-child')){
			$('#modal-edit').find('.kab').hide();
			$('#modal-edit').find('.kab1').show();
			$('#modal-edit').find('.kec').hide();
			$('#modal-edit').find('.kec1').show();
		}
		
		var kode=$this.parent().siblings(':nth-child(2)').text();
		var nama=$this.parent().siblings(':nth-child(3)').text();

		$.ajax({
			url:'ajax.php',
			data: 'kode='+kode+'&nama='+nama,
			dataType:'json',
			success : function(data){		
				if($this.is(':first-child')){

					$a.eq(1).val(data.nama);
					$a.eq(2).val(data.tanggal);
					$a.eq(3).val(data.kontak);
					$a.eq(4).val(data.resi);
					$a.eq(5).val(data.jumlah);			
					$a.eq(6).val(data.jumlah);
					$a.eq(8).val(data.prov);

					$b.eq(0).val(data.kode);
					$b.eq(1).val(formatAngka(data.harga_jual));
					$b.eq(2).val(formatAngka(data.total_harga));
					$b.eq(3).val(data.kab);
					$b.eq(4).val(data.kec);
					
					$c.eq(0).val(data.nama_barang);
					$c.eq(1).val(data.kurir);
					$c.eq(2).val(data.status);
					
					$('#modal-edit').find('input[type=hidden]').filter('.modal').val(data.modal);
					
					$('p#peringatan').html('stok '+data.nama_barang+' = '+data.jumlahDb);
					$('#modal-edit').find('textarea').eq(0).val(data.alamat2);
					$('#modal-edit').find('input[type=hidden]').filter('.laba').val(data.laba);
					$('#modal-edit').find('input[type=hidden]').filter('.jumlahDb').val(data.jumlahDb);
					$('#modal-edit').find('.tampil-laba').html('<strong><i>Laba : Rp'+formatAngka(data.laba)+'</i></strong>');
				}
				else{
					$d.eq(1).html('<strong>:&nbsp</strong>'+data.kode);
					$d.eq(3).html('<strong>:&nbsp</strong>'+data.nama);
					$d.eq(5).html('<strong>:&nbsp</strong>'+data.tanggal);
					$d.eq(7).html('<strong>:&nbsp</strong>'+data.kontak);
					$d.eq(9).html('<strong>:&nbsp</strong>'+data.nama_barang);
					$d.eq(11).html('<strong>:&nbsp</strong>'+data.resi);
					$d.eq(13).html('<strong>:&nbsp</strong>Rp &nbsp'+formatAngka(data.harga_jual)+'&nbsp&nbsp x &nbsp&nbsp'+data.jumlah);
					$d.eq(15).html('<strong>:&nbsp</strong>'+data.kurir);
					$d.eq(17).html('<strong>:&nbsp</strong>Rp &nbsp'+formatAngka(data.total_harga));		
					$d.eq(19).html('<strong>:&nbsp</strong>'+data.status);	
					$d.eq(21).html('<strong>:&nbsp</strong>'+data.alamat2+'&nbsp kec.&nbsp'+data.kec+'&nbsp'+data.kab+'&nbsp'+data.kec+',&nbsp'+data.prov);
										
					$('#modal-detail').find('#tampil-laba').html('<strong><i>Laba : Rp'+formatAngka(data.laba)+'</i></strong>');
					$('#modal-detail').find('.pull-right').children().attr('href','invoice.php?id='+data.kode);
				}
			}						
		});
	});

	//script total harga dan laba di modal edit
	$('#modal-edit').find('input[name=jumlah]').on('keyup',function(){
		$a=$('#modal-edit');

		var inp = $a.find('input[name=harga_jual]').val().replace(/\./g, '');
		total=new Number(inp);
					
		var total_harga=total*$a.find('input[name=jumlah]').val();
		$a.find('input[name=total_harga]').val(formatAngka(total_harga));

		var ink = $a.find('input[name=total_harga]').val().replace(/\./g, '');
		TH=new Number(ink);

		var jumlahDb=$('#modal-edit').find('input[type=hidden]').filter('.jumlahDb').val()-$a.find('input[name=jumlah]').val();
		$('#modal-edit').find('p#peringatan').html('stok = '+jumlahDb);

		var modal=$a.find('.modal').val();
		var laba=TH-(modal*$a.find('input[name=jumlah]').val());
		$a.find('.tampil-laba').html('<strong><i>Rp'+formatAngka(laba)+'</i></strong>');
		$a.find('.laba').val(laba);
	});	


	//script plugin datatable
	$('#example1').dataTable({
       	columnDefs: [ { orderable: false, targets: [0]},{orderable: false, targets:[1]},{orderable: false, targets:[6]},{ orderable: false, targets: [7]}]
    });
    

	//script datepicker jQueryUI
    $('#modal-edit,#modal-entry').find('.tgl').datepicker({dateFormat : 'dd M yy',minDate:0});

    //autocomplete provinsi
   	$('#modal-edit,#modal-entry').find('.prov').autocomplete({
   		source: 'auto_prov.php',  
   		minLength:2   
   	});


   	//tampilkan kabupaten berdasarkan value provinsi
	$('#modal-entry,#modal-edit').find('.prov').change(function(){
		var prov=$(this).val();
		$('.kab').empty();

		if($(this).parents('#modal-edit')){	
			$('#modal-edit').find('.kab1').hide();
			$('#modal-edit').find('.kab').show();
		}

		$.ajax({
			url:'ajax.php',
			data: "prov="+prov,
			dataType:'json',
			success : function(data){
				$.each(data, function(index, row) {
					$('.kab').append($('<option>',{
					value:row.nama,
					text:row.nama
					}));
				});										
			}
		});
	});


	//tampilkan kecamatan berdasarkan value kabupaten
	$('#modal-entry,#modal-edit').find('.kab').change(function(){
		var kab=$(this).val();
		$('#modal-entry').find('.kec').empty();

		if($(this).parents('#modal-edit')){	
			$('#modal-edit').find('.kec1').hide();
			$('#modal-edit').find('.kec').show();
			$('#modal-edit').find('.kec').empty();
		}

		$.ajax({
			url:'ajax.php',
			data: 'kab='+kab,
			dataType:'json',
			success : function(data){
				$.each(data, function(index, row) {
					$('.kec').append($('<option>',{
					value:row.nama,
					text:row.nama
					}));
				});										
			}
		});
	});

	//script kode acak untuk order id
	$('#entry').click(function(){
		var kode=Math.random().toString(36).substr(2, 5);
		$('#modal-entry').find('input[name=kode]').val(kode);
	});
</script>

<?php include "footer.php"; ?>