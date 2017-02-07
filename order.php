<?php
include 'header.php';
include 'koneksi.php';
?>
<script src="dist/js/angular.min.js"></script>
<script src="dist/js/angular-script.js"></script>
<div ng-app="myModule" ng-controller="myController">


<!-- form sortir data barang -->
<div class="col-md-1">
	<span>Sort By :</span>
</div>

<div class="col-md-3" style="margin-left: -30px">
   <select class="form-control input-sm" ng-model="sortColumn">
      <option value="-tanggal">tanggal terbaru</option>
      <option value="+nama_barang">item asc</option>
      <option value="-nama_barang">item desc</option>
      <option value="+pembeli">pembeli asc</option>
      <option value="-pembeli">pembeli desc</option>
      <option value="-status">BER-status SENDING</option>
   </select>
</div>
<!-- akhir form sortir barang -->


<!-- form pencarian -->
<div class="col-md-3 pull-right">
	<form role="form">
		<div class="input-group">
			<span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
			<input type="text" class="form-control input-sm" placeholder="cari data disini . . ." ng-model="searchDetail">
		</div>
	</form>
</div></br><br>
<!-- akhir form pencarian -->


<div class="box box-solid box-success">
	<div class="box-header">
		<h3 class="box-title"> List order penjualan </h3>
		<button type="button" class="remove btn btn-success btn-xs pull-right"  ng-click="removeSelectedRows()"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;HAPUS</button>
	</div>

	<div class="box-body">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" ng-click="checkAll()"></th>
					<th>No</th>
					<th>Waktu order</th>
					<th>Order ID</th>
					<th>Item</th>
					<th>Harga jual</th>
					<th>Jumlah</th>
					<th>Pembeli</th>
					<th>Status</th>
					<th>Proses</th>
				</tr>
			</thead>

			<tbody>
				<tr ng-repeat="detail in details | filter : searchDetail | orderBy : sortColumn">
					<td><input type="checkbox" value="{{ detail.kode }}" ng-model="tableSelection[$index]" ng-checked="check"></td>
					<td>{{ $index+1 }}</td>
					<td>{{ detail.tanggal | date: "medium" }}</td>
					<td>{{ detail.kode }}</td>
					<td>{{ detail.nama_barang }}</td>
					<td>{{ detail.harga_jual | currency : "Rp " : 0}}</td>
					<td>{{ detail.jumlah }}</td>
					<td>{{ detail.pembeli }}</td>
					<td id="label"><span class="{{ detail.status === 'sending' ? 'label label-info' : 'label label-warning' }}">{{ detail.status }}</span></td>
					<td><center><a data-toggle="modal" class="biasa" href='#modal-id' ng-click="proses(detail)" style="margin-right: 10px"><i class="fa fa-paper-plane"></i></a>
						 <a href="#" class="biasa" ng-click="delete(detail)"><span class="glyphicon glyphicon-trash"></span></a></center></td>
				</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->


<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><p class="text-center"> Order masuk</p></h4>
			</div>
			
			<div class="modal-body">
				<form role="form" class="form-inline" ng-submit="Insert(now)">

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal">Kode</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.kode }}" ng-model="now.kode" readonly>
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">pembeli</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.pembeli }}" ng-model="now.pembeli" readonly>
						</div>
					</div>
				</div></br></br>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">						
							<p for="tanggal">tanggal</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.tanggal }}" ng-model="now.tanggal" readonly>
						</div>
						<div class="col-md-2">
							<p for="nama pembeli">kontak</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.kontak }}" ng-model="now.kontak" readonly>
						</div>
					</div>
				</div></br></br>

					
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-2">
							<p for="nama">Tenun</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.nama_barang }}" ng-model="now.nama_barang" readonly>
						</div>
						<div class="col-md-2">
							<p for="kontak">kurir</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.kurir }}" ng-model="now.kurir" readonly></td>
						</div>
					</div>
				</div><br><br>
					

				<div class="col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p for="harga jual" style="font-size: 11px">Harga X jumlah</p>
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control input-sm" value="{{ now.harga_jual }}" ng-model="now.harga_jual" readonly size="9px">
						</div>
						<div class="col-md-2" style="margin-left: -10px">
							<input type="text" class="form-control input-sm" value="{{ now.jumlah }}" ng-model="now.jumlah" readonly size="4px">
						</div>
						<div class="col-md-2" style="margin-left: 10px">							
							<p for="resi">No. resi</p>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control input-sm" placeholder="Masukkan No. RESI" ng-model="now.resi" required autofocus>
						</div>
					</div>
				</div><br><br>
						
				
				<div class="col-md-12">
					<div class="row">	
						<div class="col-md-2">
							<p for="total harga">total harga</p>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control input-sm" value="{{ now.total_harga }}" ng-model="now.total_harga" readonly>
						</div>
						<div class="col-md-5 col-md-offset-1">
							<p class="label label-success">{{ alert }}</p>
						</div>
					</div>
				</div><br><br>
	
				<div class="col-md-12">
					<div class="row">		
						<div class="col-md-2">
							<p>alamat</p>
						</div>
						<div class="col-md-7">
							<textarea class="form-control" rows="3" cols="65" resize="none" ng-model="now.alamat2 +',  '+now.kec+',  '+now.kab+',  '+now.prov" readonly style="resize: none;">{{ now.alamat2 +',  '+now.kec+',  '+now.kab+',  '+now.prov }}</textarea>
						</div>
					</div>
				</div><br><br><br>					
			</div>

			<div class="modal-footer">
				<input type="reset" class="reset btn btn-danger btn-sm" value="Reset">
				<input type="submit" class="entry btn btn-success btn-sm" value="entry" ng-show="tombolInsert"></form>
			</div>
		</div>
	</div>
</div>

</div>

<?php include 'footer.php'; ?>