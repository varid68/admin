<?php
include "header.php";
include "koneksi.php";
?>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="bower_components/autoNumeric/autoNumeric-min.js"></script>
<script src="bower_components/iCheck/icheck.min.js" type="text/javascript"></script>

<form  class="form-inline form-excel" action="import_excel.php" method="POST" role="form" enctype="multipart/form-data" style="display: none;">
	<div class="form-group">
		<input type="file" class="form-control input-sm" name="excel">
	</div>
	<button type="submit" name="import" class="btn btn-sm btn-success">Import</button>
	<button type="submit" name="preview" class="btn btn-sm btn-warning">preview</button>
	<span>format  .xlsx</span>
</form>

<div class="box box-solid box-primary">
	<div class="box-header">
		<h3 class="box-title">Data Barang </h3>
		<a href="#" id='excel' class="btn pull-right no-padding" title='Import Excel'><span class='glyphicon glyphicon-open'></span></a>
		<a href="excel.php" class="btn pull-right no-padding" title='Unduh Excel'><i class='fa fa-file-excel-o'></i></a>
		<a href="laporan.php" target="_blank" class="btn pull-right no-padding" title='laporan PDF' style='margin-right:5px'><i class='fa fa-file-pdf-o'></i></a>
		<a class="btn pull-right no-padding" data-toggle="modal" href='#modal-tambah' aria-hidden="true" title="tambah data barang" style='margin-right:5px'>
		<i class="fa fa-plus"></i></a>		
	</div>	

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr class="text-red">
				  <th class="col-sm-1">No</th>
				  <th class="col-sm-2">Nama barang</th>
				  <th class="col-sm-2">Modal</th>
				  <th class="col-sm-2">Jual</th> 
				  <th class="col-sm-1">Stok</th> 
				  <th class="col-sm-2">Opsi</th>  
				</tr>
			</thead>

			<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM data_barang ORDER BY nama_barang";
$tampil =mysqli_query($link,$sql);

$no=1;
while ($r=mysqli_fetch_array($tampil)) { 
?>
			
				<tr>
				  <td><span><input type="checkbox" value="<?php echo $r['nama_barang']; ?>" class="satu">  </span><?php echo $no; ?></td>
			     <td><?php echo $r['nama_barang']; ?></td>
				  <td><?php echo number_format($r['modal']); ?></td>
				  <td><?php echo number_format($r['harga_jual']); ?></td>
				  <td><?php echo $r['jumlah']; ?></td>
				  <td><a data-toggle="modal" href="#modal-edit" class="biasa" id="edit"><span class="glyphicon glyphicon-edit"></span>&nbsp; edit</a>
							
						<a href="#" class="biasa hapus" style="margin-left: 10px;"><span class="glyphicon glyphicon-trash"></span>&nbsp; hapus</a></td>
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

<!-- modal tambah barang -->
<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog" style="width:400px!important">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center><h4 class="modal-title">Tambah Barang</h4></center>
			</div>
			<div class="modal-body">
				<form action="stok_aksi.php" method="POST" role="form" class="form-inline">
				<table class="table" id="table-borderless">

					<tr class="col-md-12">
						<div class="form-group">
							<td class="col-md-7"><p for="nama">Nama Tenun</p></td>
							<td><input type="text" class="form-control input-sm" name="nama_tenun" placeholder="Nama Tenun" pattern="[a-z\s]{4,}" required title="harus berupa huruf minimal 4 karakter"></td>
						</div>
					</tr>

					<tr class="col-md-12">
						<div class="form-group">
							<td class="col-md-7"><p for="nama">Harga beli</p></td>
							<td><input type="text" class="auto form-control input-sm" name="modal" placeholder="Harga Beli" pattern="[0-9\.]{6,}" required title="minimal 5 digit"></td>
						</div>
					</tr>

					<tr class="col-md-12">
						<div class="form-group">
							<td class="col-md-7"><p for="nama">Harga jual</p></td>
							<td><input type="text" class="auto form-control input-sm" name="harga_jual" placeholder="Harga Jual" pattern="[0-9\.]{6,}" required title="minimal 5 digit"></td>
						</div>
					</tr>

					<tr class="col-md-12">
						<div class="form-group">
							<td class="col-md-7"><p for="nama">Jumlah</p></td>
							<td><input type="number" class="form-control input-sm" name="jumlah" placeholder="jumlah" min="10" required="required"></td>
						</div>
					</tr>
			</div>
			</table>

			<div class="modal-footer">
				<input type="submit" name="tambah" value="simpan" class="btn btn-success btn-sm">
			</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- akhir modal tambah barang -->


<!-- modal edit data barang -->
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog" style="width:400px!important">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<center><h4 class="modal-title">Edit data barang</h4></center>
			</div>
			<div class="modal-body">
												
				<form action="stok_aksi.php" method="POST" role="form" class="form-inline">
				<table class="table" id="table-borderless">
					<div class="form-group">
						<tr class="col-md-12">
							<td class="col-md-7"><p for="nama">Nama Tenun</p></td>
							<td><input type="text" class="form-control input-sm" name="nama_tenun" pattern="[a-z\s]{4,}" required title="harus berupa huruf minimal 4 karakter"></td>
						</tr>
					</div>

					<div class="form-group">	
						<tr class="col-md-12">
							<td class="col-md-7"><p for="modal">Harga Beli</p></td>
							<td><input type="text" class="auto form-control input-sm" name="modal" pattern="[0-9\.]{6,}" required title="minimal 5 digit"></td>
						</tr>
					</div>

					<div class="form-group">	
						<tr class="col-md-12">
							<td class="col-md-7"><p for="harga">Harga Jual</p></td>
							<td><input type="text" class="auto form-control input-sm" name="harga_jual" pattern="[0-9\.]{6,}" required title="minimal 5 digit"></td>
						</tr>
					</div>

					<div class="form-group">	
						<tr class="col-md-12">
							<td class="col-md-7"><p for="Jumlah">Jumlah</p></td>
							<td><input type="number" class="form-control input-sm" min="1" name="jumlah"></td>
							<input type="hidden" name="id">
						</tr>
					</div>

				</table>
			</div>
			
			<div class="modal-footer">
				<input type="reset" class="btn btn-danger btn-sm" value="Reset">
				<input type="submit" name="edit" value="simpan" class="btn btn-success btn-sm"></form>		
			</div>
		</div>
	</div>
</div>
<!-- akhir modal edit data barang -->


<script type="text/javascript">
$(document).ready(function(){

	//fungsi titik untuk ribuan
	function formatAngka(angka) {
		if (typeof(angka) != 'string') angka = angka.toString();
		 	var reg = new RegExp('([0-9]+)([0-9]{3})');
			while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			return angka;
		}


	//plugin pengganti alert ja
	$('.hapus').click(function(){
		var a= $(this).parent().siblings(':nth-child(2)').text();
		swal({
		  title: 'Apa Anda Yakin?',
		  text: "Ingin Menghapus Item "+a,
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then(function () {
		    location.href='stok_aksi.php?ref='+a
		});
	});

	//tampilkan detail order dan pembeli di modal
	$('#example1').find('td a:nth-child(1)').click(function(){
		$this=$(this);
		$a=$('#modal-edit').find('input[type=text]');

		var nama=$this.parent().siblings(':nth-child(2)').text();
		$.ajax({
			url:'ajax.php',
			data: 'nama_db='+nama,
			dataType:'json',
			success : function(data){						  
					$a.eq(0).val(data.nama_barang);
					$a.eq(1).val(formatAngka(data.modal));
					$a.eq(2).val(formatAngka(data.harga_jual));
					$('#modal-edit').find('input[type=number]').val(data.jumlah);
					$('#modal-edit').find('input[type=hidden]').val(data.id);
			}						
		});
	});

	//script plugin datatable
	$('#example1').dataTable({
        columnDefs: [ { orderable: false, targets: [0]},{orderable: false, targets:[5]}]
    });

	//script plugin auto numeric
    $('.auto').autoNumeric('init',{
	    aSep: '.',
	    aDec: ',', 
	    vMin: '0',
	   	vMax: '9999999999'
	});

  	$('a#excel').click(function(){
		$('.form-excel').toggle(500);
	});

	$('input[name=harga_jual]').change(function(){
		if ($(this).val() < $('input[name=modal]').val()){
			$('input[type=submit]').hide(500);
			$('input[type=submit]').click(function(e){
				e.preventDefault();
			});
		}
		else $('input[type=submit]').show(500);
	});

	$('#modal-tambah,#modal-edit').on('hidden.bs.modal', function () {
    	$(':input').val('');
	});

	$('input[type=checkbox]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
   });

});
</script>

	
<?php include "footer.php"; ?>