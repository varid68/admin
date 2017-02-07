<?php 
include 'header.php';
?>

<!-- TABLE: LATEST ORDERS -->
<div class="box box-solid box-danger">
	<div class="box-header">
		<h3 class="box-title"> list Order Pending </h3>		
	</div>  

	<div class="box-body">
		<table class="table table-condensed table-striped">
	        <thead>
		        <tr>
		          <th>Order ID</th>
		          <th>Tanggal</th>
		          <th>Item</th>
		          <th>Pembeli</th>
		          <th>Status</th>
		          <th class="col-md-2">Edit</th>
		        </tr>
	        </thead>

	<?php
	$query="SELECT penjualan.kode AS order_id,tanggal,nama_barang,nama FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode	WHERE status='sending' ORDER BY tanggal";
	$result=mysqli_query($link,$query);

	while($r=mysqli_fetch_assoc($result)){ 
	?>    
	        <tbody>
		        <tr class="pending">
		          <td><a data-toggle="modal" href='#modal-barang' data-backdrop="static" aria-hidden="true" class="tebal" style="color: inherit;"><?php echo $r['order_id']; ?></a></td>

		          <td><?php $a=date("d M Y",strtotime($r['tanggal'])); echo $a; ?></td>
		          <td><?php echo ucwords($r['nama_barang']); ?></td>
		          <td><a data-toggle="modal" href='#modal-pembeli' data-backdrop="static" aria-hidden="true" class="tebal" style="color:inherit;"><?php echo ucwords($r['nama']); ?></a></td>

		      	 <td><span class='label label-info'>Sending</span></td>

		          <td><select class="form-control input-sm" style="border-radius: 4px">
		          		<option disabled="disabled" selected="selected">- Edit Status -</option>
		           		<option value="ok">Delivered</option>
		              </select></td>
		        </tr> <?php } ?>
	        </tbody>
	    </table><!-- /.table-responsive -->           
	</div><!-- /.box body-->
</div>



<!-- modal detail order -->
<div class="modal fade" id="modal-barang">
	<div class="modal-dialog" style="width:400px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
				<h4 class="modal-title text-center">Detail Order</h4>
			</div>
			<div class="modal-body">
			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-6">
			 			<label>Order ID</label>
			 		</div>
			 		<div class="col-md-6">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-6">
			 			<label>Tanggal Beli</label>
			 		</div>
			 		<div class="col-md-6">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-6">
			 			<label>Item</label>
			 		</div>
			 		<div class="col-md-6">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-6">
			 			<label>Harga x Jumlah</label>
			 		</div>
			 		<div class="col-md-6">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-6">
			 			<label>Total</label>
			 		</div>
			 		<div class="col-md-6">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>	
			</div>

			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<!-- akhir modal detail order -->

<!-- modal detail pembeli -->
<div class="modal fade" id="modal-pembeli">
	<div class="modal-dialog" style="width:400px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
				<h4 class="modal-title text-center">Detail Pembeli</h4>
			</div>

			<div class="modal-body">
			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-5">
			 			<label>Nama Pembeli</label>
			 		</div>
			 		<div class="col-md-7">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-5">
			 			<label>Kontak</label>
			 		</div>
			 		<div class="col-md-7">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-5">
			 			<label>Alamat</label>
			 		</div>
			 		<div class="col-md-7">
			 			<p></p>
			 			<p></p>
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			  <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-5">
			 			<label>Kurir</label>
			 		</div>
			 		<div class="col-md-7">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>

			   <div class="col-md-12">
			 	<div class="row">
			 		<div class="col-md-5">
			 			<label>No. resi</label>
			 		</div>
			 		<div class="col-md-7">
			 			<p></p>
			 		</div>
			 	</div>
			  </div>
				
			</div>

			<div class="modal-footer">
				
			</div>
		</div>
	</div>
</div>
<!-- akhir modal detail pembeli -->

<div class="row">
	<div class="col-md-6">
        <div class="box box-success">
           	<div class="box-header with-border">
           	   <h3 class="box-title">List stok < 20</h3>
	           <div class="box-tools pull-right">
               	   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
           	   </div> <!-- /.box-tools --> 
           	</div>

            <!-- /.box-header -->
            <div class="box-body">
             	<div class="box-body">
	            	<div class="table-responsive">
	                	<table class="table table-condensed no-margin">
	                  		<thead>
		                  		<tr>
		                  		  <th>No</th>
		                    	  	  <th>Item</th>
		                    	  	  <th>jumlah</th>
		                    	  	  <th>Edit</th>
		                  		</tr>
	                  		</thead>

<?php 
$query="SELECT * FROM data_barang WHERE jumlah<= 20 ORDER BY jumlah";
$result=mysqli_query($link,$query);

$no=1;
while($r=mysqli_fetch_assoc($result)){ ?>

	                  		<tbody>
		                  		<tr>
		                  		  <td><?php echo $no; ?></td>
		                    	  <td><?php echo ucwords($r['nama_barang']); ?></td>
		                    	  <td><form action="mutiple.php" method="POST"><input type="text" name="jumlah[<?php echo $r['nama_barang']; ?>][<?php echo $r['jumlah']; ?>" size="5px" value="<?php echo $r['jumlah']; ?>" data-id="<?php echo $r['nama_barang']; ?>" style="border-radius: 3px"></td>
		              			  <td><a data-toggle="modal" href='#modal-jumlah' data-modal=<?php echo $r['modal']; ?> data-jual=<?php echo $r['harga_jual']; ?> data-backdrop="static" aria-hidden="true" style="color:inherit" ><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;edit</a></td>
		                  		</tr> <?php $no++; } ?>
	                  		</tbody>
	                	</table>
	             	</div><!-- /.table-responsive -->
	            </div><!-- /.box-body --><input type="submit" class="btn btn-success btn-block pull-right" value="Simpan">  </form>
            </div><!-- /.box-body -->    
        </div> <!-- /.box -->      
  	</div> <!-- col-md-6 -->

    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Penjualan Terbaru</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
              </div><!-- /.box-tools -->   
            </div> <!-- /.box-header -->
           
           	<div class="box-body">
	           	<div class="table-responsive">
	               	<table class="table table-condensed no-margin">
	           		  <thead>
		           		<tr>
		           		  <th style="font-size: 12px">Order id</th>
		               	  <th>Item</th>
		               	  <th>Pembeli</th>
                    	  <th>Status</th>
                  		</tr>
                	  </thead>

<?php 
$query="SELECT penjualan.kode AS order_id,nama_barang,nama,status FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode ORDER BY tanggal DESC LIMIT 10";
$result=mysqli_query($link,$query);

while($r=mysqli_fetch_assoc($result)){ ?>

	                  <tbody>
		               	<tr class="pending">
		               	  <td><a data-toggle="modal" href='#modal-barang' data-backdrop="static" aria-hidden="true" class="text-uppercase text-muted"><?php echo $r['order_id']; ?></a></td>

		              	  <td><?php echo ucwords($r['nama_barang']); ?></td>
		               	  <td><a data-toggle="modal" href='#modal-pembeli' data-backdrop="static" aria-hidden="true" class="text-muted"><?php echo ucwords($r['nama']); ?></td>

		           		  <td><?php $a=$r['status']; echo $a=='ok'?"<span class='label label-success'>delivered</span>":"<span class='label label-info'>Sending</span>"; ?></td>
	              		</tr> <?php } ?>
                	  </tbody>
                	</table><!-- /.table-responsive -->
	             </div>
	        </div><!-- /.box-body --> 
        </div><!-- /.box -->       
    </div>
</div><!-- akhir.row -->

<!-- modal edit jumalah stok -->
<div class="modal fade" id="modal-jumlah">
	<div class="modal-dialog" style="width:400px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Edit jumlah Item</h4>
			</div>
			<div class="modal-body">
				<form action="stok_aksi.php" method="POST" class="form">
				<div class="col-md-12">
			 		<div class="row">
			 			<div class="col-md-6">
			 				<label>Item</label>
			 			</div>
			 			<div class="col-md-6">
			 				<input type="text" name="nama" class="form-control input-sm" readonly="readonly">
			 			</div>
			 		</div>
				</div><br><br>

				<div class="col-md-12">
			 		<div class="row">
			 			<div class="col-md-6">
			 				<label>Modal</label>
			 			</div>
			 			<div class="col-md-6">
			 				<input type="text" class="form-control input-sm" disabled="disabled">
			 			</div>
			 		</div>
				</div><br><br>

				<div class="col-md-12">
			 		<div class="row">
			 			<div class="col-md-6">
			 				<label>Harga Jual</label>
			 			</div>
			 			<div class="col-md-6">
			 				<input type="text" class="form-control input-sm" disabled="disabled">
			 			</div>
			 		</div>
				</div><br><br>

				<div class="col-md-12">
			 		<div class="row">
			 			<div class="col-md-6">
			 				<label>jumlah</label>
			 			</div>
			 			<div class="col-md-6">
			 				<input type="number" min="21" name="jumlah" class="form-control input-sm">
			 				<span class="text-danger small"></span>
			 			</div>
			 		</div>
				</div><br><br>
				
			</div>
			<div class="modal-footer">
				<input type="submit" name="jumlah2" class="btn btn-success btn-sm" value="simpan"></form>
			</div>
		</div>
	</div>
</div>
<!-- akhir modal tambah barang -->

<script type="text/javascript">
$(document).ready(function(){

	//fungsi titik untuk ribuan
	function formatAngka(angka) {
		if (typeof(angka) != 'string') angka = angka.toString();
		 	var reg = new RegExp('([0-9]+)([0-9]{3})');
			while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			return angka;
		}

	//tampilkan detail order dan pembeli di modal
	$('tr.pending td a').click(function(){
		$this=$(this);
		$a=$('#modal-barang').find('p');
		$b=$('#modal-pembeli').find('p');

		if($this.parent().is(':first-child')){
			var kode=$this.text();
		} else {
			var kode=$this.parent().siblings().first().text();
		}

		$.ajax({
			url:'ajax.php',
			data: 'kode='+kode,
			dataType:'json',
			success : function(data){		
				if($this.parent().is(':first-child')){
					  
					$a.eq(0).html(data.kode);
					$a.eq(1).html(data.tanggal);
					$a.eq(2).html(data.nama_barang);
					$a.eq(3).html('Rp '+formatAngka(data.harga_jual)+' x '+data.jumlah);
					$a.eq(4).html('Rp '+formatAngka(data.total_harga));
				}
				else{
					$b.eq(0).html(data.nama);
					$b.eq(1).html(data.kontak);
					$b.eq(2).html('Prov. '+data.prov);
					$b.eq(3).html(data.kab);
					$b.eq(4).html(data.alamat2);
					$b.eq(5).html(data.kurir);
					$b.eq(6).html(data.resi);
				}
			}						
		});
	});

	//ubah status pesanan
	$('tr.pending').find('select.form-control').change(function(){
		var status=$(this).val();
		var kode=$(this).parent().siblings().first().text();
		var label=$(this).parent().siblings(':nth-child(5)').html('<span class="label label-success">delivered</span>');;
		$.ajax({
			url:'ajax.php',
			type:'POST',
			data: {"status":status,"kode":kode},
			dataType:'json',
			success : function(data){		
				if(data.result == true){
					alert('Status Pesanan Berhasil Diubah');
				}
			}
		});	
	});

	//tampilkan value di modal edit jumlah stok
	$('a[href="#modal-jumlah"]').click(function(){
		$a=$(this);
		$b=$('#modal-jumlah').find('input[type=text]');

		var nama=$a.parent().siblings(':nth-child(2)').text();
		var modal=$a.data('modal');
		var jual=$a.data('jual');
		var jumlah=$a.parent().siblings(':nth-child(3)').children().val();

		$b.eq(0).val(nama);
		$b.eq(1).val(formatAngka(modal));
		$b.eq(2).val(formatAngka(jual));
		$('#modal-jumlah').find('input[type=number]').val(jumlah);
	});

	/*sembunyikan tombol simpan form jika jumlah yang diinput kurang dari 20
	$('#modal-jumlah').find('input[name=jumlah]').keyup(function(){
		var a=$(this).val();

		if (a <= 20){
			$('#modal-jumlah').find('input[name=jumlah2]').hide(500);
			$(this).siblings().html('Jumlah Terinput Masih < 20');
		}
		else {
			$('#modal-jumlah').find('input[name=jumlah2]').show(500);
			$(this).siblings().html('');
		}
  	});*/


  	// jumlah yang diinput harus angka dan diatas 21
	$('#modal-jumlah').find('input[name=jumlah2]').click(function(e){
			$a=$('#modal-jumlah').find('input[name=jumlah]');

			if ($a.val() <= 20){
				e.preventDefault();
				swal(
  				  'Oops...',
  				  'jumlah barang yang anda masukkan kurang dari 21',
  				  'error'
				);
			}
		});


	/*$('#editJumlah').click(function() {
      var b = [];
      $('input[type=text]').each(function() {
      	b.push($(this).data('id'));
         b.push($(this).val());
         
      });

      var filter = b.filter(function(e){
      	return e !== undefined && e !== ''
      });
      console.log(filter);

      $.ajax({
         url: 'ajax.php',
         type: 'POST',
         data: { data: b }
      });
   });*/

});
</script>
<?php include 'footer.php'; ?>