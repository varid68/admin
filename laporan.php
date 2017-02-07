<?php 
include 'koneksi.php';
include 'header.php'; ?>
<script src="bower_components/daterange/moment.min.js"></script>
<script src="bower_components/daterange/daterangepicker.js"></script>

<div class="box box-solid box-primary">
   <div class="box-header">
      <h3 class="box-title"> Data Penjualan </h3>
   </div>

   <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
         <thead>
            <tr class="text-red">
               <th>No</th>
               <th class="col-md-2">Order ID</th>
               <th class="col-sm-2">Tgl terjual</th>
               <th class="col-sm-2">Item</th>
               <th class="col-sm-2">Harga jual</th>
               <th>jumlah</th>
               <th>status</th>
            </tr>
         </thead>
         <tbody>
            <?php 
// Tampilkan data dari Database
$sql = "SELECT *,penjualan.kode AS kode2 FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode ORDER BY tanggal DESC LIMIT 5";
$tampil = mysqli_query($link,$sql);

$no=1;
while ($r=mysqli_fetch_array($tampil)) { 
?>
            <tr>
               <td><?php echo $no; ?></td>
               <td id="kode2"><?php echo $r['kode2']; ?></td>
               <td><?php $a=date('d M Y',strtotime($r['tanggal'])); echo $a; ?></td>
               <td><?php echo $r['nama_barang']; ?></td>
               <td><?php echo 'Rp '.number_format($r['harga_jual']); ?></td>
               <td><?php echo $r['jumlah']; ?></td>
               <td><center>
               <?php $a=$r['status']; echo $a=='ok'?"<span class='text-success glyphicon glyphicon-ok'>":"<span class='text-danger glyphicon glyphicon-remove'>"; ?></center></td>
            </tr><?php $no++; } ?>
         </tbody>
      </table>

      <div style="margin-top:5px">
         <?php $query="SELECT COUNT(*) FROM penjualan";
	       		 $result=mysqli_query($link,$query);
	       		 $row=mysqli_fetch_row($result);
	       ?>
         <div class="row">
            <div class="col-md-5">
               <p>Menampilkan 5 dari
                  <?php echo $row[0]; ?> Item Yang Ada</p>
            </div>

            <div class="col-md-2">
               <select class="form-control input-sm" id="filter-date" style="margin-left: 40px">
                  <option selected="selected" value="filter">- filter -</option>
                  <option value="hari">harian</option>
                  <option value="bulan">bulanan</option>
                  <option value="rentang">Rentang Tanggal</option>
               </select>
            </div>

            <div class="col-md-3">
               <input type="text" name="range" class="form-control input-sm" class="filter-date" placeholder="Rentang tanggal" disabled="disabled" style="margin-left:22px">
            </div>

            <div class="col-md-1">
               <a class="btn btn-sm bg-purple">Unduh PDF &nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
            </div>
         </div>

      </div>
   </div>
</div>
<!-- TABLE: LATEST ORDERS -->


<div class="box box-solid box-primary" style="width: 75%!important">
   <div class="box-header">
      <h3 class="box-title"> Data Barang </h3>
      <a href="lap_barang.php" class="btn btn-sm bg-navy pull-right">Unduh PDF &nbsp;<i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
   </div>
   <div class="box-body">
      <table class="table table-striped">
         <thead>
            <tr>
               <th>No.</th>
               <th>Item</th>
               <th>Modal</th>
               <th>Harga Jual</th>
               <th>Jumlah</th>
            </tr>
         </thead>
         <?php
	$query="SELECT * FROM data_barang ORDER BY nama_barang LIMIT 5";
	$result=mysqli_query($link,$query);

	$no=1;
	while($r=mysqli_fetch_assoc($result)){ 
	?>
            
         <tbody>
            <tr class="pending">
               <td><?php echo $no; ?></td>
               <td><?php echo ucwords($r['nama_barang']); ?></td>
               <td><?php echo 'Rp '.number_format($r['modal']); ?></td>
               <td><?php echo 'Rp '.number_format($r['harga_jual']); ?></td>
               <td><?php echo $r['jumlah']; ?></td>
            </tr><?php $no++; } ?>
         </tbody>
      </table>
      <?php $query="SELECT COUNT(*) FROM data_barang";
	       		 $result=mysqli_query($link,$query);
	       		 $row=mysqli_fetch_row($result);
	    ?>
      <p>menampilkan 5 dari
         <?php echo $row[0]; ?> item yang ada</p>
   </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
   $('#filter-date').change(function() {
      $a = $(this);

      if ($a.val() == 'hari') {
         $a.parent().siblings('.col-md-3').children().prop('disabled', true);
         $a.parent().siblings('.col-md-1').children('a').attr('href', 'lap_jual.php?hari');
      } else if ($a.val() == 'bulan') {
         $a.parent().siblings('.col-md-3').children().prop('disabled', true);
         $a.parent().siblings('.col-md-1').children('a').attr('href', 'lap_jual.php?bulan');
      } else if ($a.val() == 'rentang') {
         $a.parent().siblings('.col-md-3').children().prop('disabled', false);
         $('input[name=range]').focus();
      }
   });

   $('#filter-date').parent().siblings('.col-md-1').children('a').click(function(e) {
      $a = $('#filter-date');
      if ($a.val() == 'null' || $a.val() == 'filter') {
         e.preventDefault();
         swal(
            'Oops...',
            'Anda belum Memilih Filter unduh PDF!',
            'error'
         )
      } else if ($a.val() == 'rentang') {
         var rentang = $('input[name=range]').val();
         $a.parent().siblings('.col-md-1').children('a').attr('href', 'lap_jual.php?rentang=' + rentang);

      }
   });

   $('input[name=range]').daterangepicker({
      locale: {
         format: 'DD/MM/YYYY'
      },
      "startDate": "12/12/2016",
      "endDate": "22/12/2016"
   }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
   });


   $('#filter-date').change(function() {
      if ($(this).val() == 'rentang') {
         $(this).parents('.col-md-2').siblings('.col-md-3').children().prop('disabled', false);
      } else {
         $(this).parents('.col-md-2').siblings('.col-md-3').children().prop('disabled', true);
      }
   });

   $('input[name=range]').daterangepicker({
      locale: {
         format: 'DD/MM/YYYY'
      },
      "startDate": "12/12/2016",
      "endDate": "22/12/2016"
   }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
   });

});
</script>
<?php include 'footer.php'; ?>