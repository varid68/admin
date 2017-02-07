<?php 
include "header.php";
?>

<div class="row">
   <div class="container col-md-12 col-xs-6">
      <div class="row">

      <!-- small box -->
         <div class="col-md-4 col-xs-6">
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
               </div>
               <div class="icon">
                  <i class="ion ion-bag"></i>
               </div>
            </div>
         </div>

         <div class="col-md-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
               <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
               </div>
               <div class="icon">
                  <i class="ion ion-bag"></i>
               </div>
            </div>
         </div>

         <div class="col-md-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
               <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
               </div>
               <div class="icon">
                  <i class="ion ion-bag"></i>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
<!--end row -->



<div class="pad margin no-print">
   <div class="callout callout-info" style="margin: -20px!important;">
      <h4><i class="fa fa-info"></i> Note:</h4> Silahkan Klik di <strong>Order ID</strong> dan <strong>Nama Pembeli</strong> Untuk Melihat Detail
   </div>
</div>


<!-- TABLE: LATEST ORDERS -->
<div class="row" style="margin-top:20px">
   <div class="col-md-12">
      <div class="box box-warning">

         <div class="box-header with-border">
            <h3 class="box-title">Penjualan Terbaru</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
         </div>
         
         <div class="box-body">
            <div class="table-responsive">
               <table class="table table-condensed no-margin">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th style="font-size: 12px">Order id</th>
                        <th>Tanggal</th>
                        <th>Item</th>
                        <th>Pembeli</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <?php 
$query="SELECT penjualan.kode AS order_id,tanggal,nama_barang,nama,status FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode ORDER BY tanggal DESC LIMIT 10";
$result=mysqli_query($link,$query);
$no=1;
while($r=mysqli_fetch_assoc($result)){ ?>

                  <tbody>
                     <tr class="pending">
                        <td><?php echo $no; ?></td>
                        <td><a data-toggle="modal" href='#modal-barang' data-backdrop="static" aria-hidden="true" class="text-success">
                            <?php echo $r['order_id']; ?></a></td>
                        <td><?php echo date("d M Y",strtotime($r['tanggal'])); ?></td>
                        <td><?php echo ucwords($r['nama_barang']); ?></td>
                        <td><a data-toggle="modal" href='#modal-pembeli' data-backdrop="static" aria-hidden="true">
                        	 <?php echo ucwords($r['nama']); ?></td>
                        <td><?php $a=$r['status']; echo $a=='ok'?"<span class='label label-success'>delivered</span>":"<span class='label label-info'>Sending</span>"; ?></td>
                     </tr><?php $no++; } ?>
                  </tbody>
               </table>
            </div>
         </div>
     
      </div>
   </div>
</div>
<!-- end .row-->



<!-- modal detail order -->
<div class="modal fade" id="modal-barang">
   <div class="modal-dialog" style="width:400px">
      <div class="modal-content">

         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-center">Detail Pembeli</h4>
         </div>

         <div class="modal-body">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                     <label>Nama Pembeli</label>
                  </div>
                  <div class="col-md-8">
                     <p></p>
                  </div>
               </div>
            </div>

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                     <label>Kontak</label>
                  </div>
                  <div class="col-md-8">
                     <p></p>
                  </div>
               </div>
            </div>

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                     <label>Alamat</label>
                  </div>
                  <div class="col-md-8">
                     <p></p>
                     <p></p>
                     <p></p>
                  </div>
               </div>
            </div>

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                     <label>Kurir</label>
                  </div>
                  <div class="col-md-8">
                     <p></p>
                  </div>
               </div>
            </div>

            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-4">
                     <label>No. resi</label>
                  </div>
                  <div class="col-md-8">
                     <p></p>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal-footer"></div>

      </div>
   </div>
</div>
<!-- akhir modal detail pembeli -->


<script type="text/javascript">
//fungsi titik untuk ribuan
function formatAngka(angka) {
   if (typeof(angka) != 'string') angka = angka.toString();
   var reg = new RegExp('([0-9]+)([0-9]{3})');
   while (reg.test(angka)) angka = angka.replace(reg, '$1.$2');
   return angka;
}

//tampilkan detail order dan pembeli di modal
$('tr.pending td a').click(function() {
   $this = $(this);
   $a = $('#modal-barang');
   $b = $('#modal-pembeli');

   if ($this.parent().is(':nth-child(2)')) {
      var kode = $this.text();
   } else {
      var kode = $this.parent().siblings(':nth-child(2)').text();
   }

   $.ajax({
      url: 'ajax.php',
      data: 'kode=' + kode,
      dataType: 'json',
      success: function(data) {
         if ($this.parent().is(':nth-child(2)')) {

            $a.find('p').eq(0).html(': ' + data.kode);
            $a.find('p').eq(1).html(': ' + data.tanggal);
            $a.find('p').eq(2).html(': ' + data.nama_barang);
            $a.find('p').eq(3).html(': ' + formatAngka(data.harga_jual) + ' x ' + data.jumlah);
            $a.find('p').eq(4).html(': ' + formatAngka(data.total_harga));
         } else {
            $b.find('p').eq(0).html(': ' + data.nama);
            $b.find('p').eq(1).html(': ' + data.kontak);
            $b.find('p').eq(2).html(': ' + data.alamat2);
            $b.find('p').eq(3).html('&nbsp&nbsp' + data.kab);
            $b.find('p').eq(4).html('&nbsp&nbspProv. ' + data.prov);
            $b.find('p').eq(5).html(': ' + data.kurir);
            $b.find('p').eq(6).html(': ' + data.resi);
         }
      }
   });

});
</script>


<?php 
$bulan=date('n');
if($bulan==1){	$bulanKemarin=12;			} 
else 		 {	$bulanKemarin=date('n')-1;	}

$RataKem="SELECT COUNT(*) FROM penjualan WHERE MONTH(tanggal)='$bulanKemarin'";
$resultRataKem=mysqli_query($link,$RataKem);
$RataKem=mysqli_fetch_row($resultRataKem);

$RataSek="SELECT COUNT(*) FROM penjualan WHERE MONTH(tanggal)='$bulan'";  
$result=mysqli_query($link,$RataSek);
$RataSek=mysqli_fetch_row($result); 
$persenRata=round(abs($RataKem[0]-$RataSek[0])*100/$RataKem[0],1);

$labaKemarin="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$bulanKemarin'";
$resultKemarin=mysqli_query($link,$labaKemarin);
$rLabaKem=mysqli_fetch_row($resultKemarin);

$labaSekarang="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$bulan'";
$resultSekarangn=mysqli_query($link,$labaSekarang);
$rLabaSek=mysqli_fetch_row($resultSekarangn);
$persenLaba=round(abs($rLabaKem[0]-$rLabaSek[0])*100/$rLabaKem[0],1);
?>
<script src="bower_components/chart.js/dist/chart.min.js"></script>

<div class="row" style="background: white; margin:0px">
   <div class="col-md-8">
      <canvas id="laba" height="150px"></canvas>
   </div>

   <div class="col-md-4">
      <p class="text-center"><strong>Goal Completion This Month</strong></p>
      <div class="progress-group">
         <span class="progress-text">Target Penjualan/Bulan</span>
         <span class="progress-number"><b><?php echo $RataSek[0]; ?></b>/20</span>
         <div class="progress sm">
            <div class="progress-bar progress-bar-aqua" style='width:<?php echo $RataSek[0]/20*100, "%"; ?>'></div>
         </div>
      </div>

      <div class="description-block border-right">
         <span class="description-percentage text-blue">
            <?php if($RataKem[0]>$RataSek[0]){
            		echo '<i class="fa fa-caret-down"></i>';
            	  }
            	  else {
            		echo '<i class="fa fa-caret-up"></i>';
            	  } echo $persenRata,'%'; ?>
            </span>
         <h5 class="description-header"><?php echo '['.date('F').']  '.$RataSek[0].' : '.$RataKem[0].' [Kemarin]'; ?></h5>
         <span class="description-text">Rata2 Jumlah Jual</span>
      </div>
      <!-- /.description-block -->

      <div class="description-block border-right">
         <span class="description-percentage text-yellow"><?php if($rLabaKem[0]>$rLabaSek[0]){
            		echo '<i class="fa fa-caret-down"></i>';
            	  }
            	  else {
            		echo '<i class="fa fa-caret-up"></i>';
            	  } echo $persenLaba,'%'; ?>	  
            </span>
         <h5 class="description-header"><?php echo 'selisih Rp '.number_format($rLabaKem[0] - $rLabaSek[0]); ?></h5>
         <span class="description-text">Laba Penjualan <?php echo date('M'); ?></span>
      </div>
      <!-- /.description-block -->

   </div>
</div>


<div class="row" style="background: white; margin:0px">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-6">
            <canvas id="laris" height="150px"></canvas>
         </div>
         <div class="col-md-6">
            <canvas id="buyers3" height="150px"></canvas>
         </div>
      </div>
   </div>
   <?php
$b=date('n');
	$query="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$b' AND (DAY(tanggal) BETWEEN 01 AND 08)";
	$result=mysqli_query($link,$query);
	$r=mysqli_fetch_row($result);
	$minggu1=$r[0]/1000;

	$query="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$b' AND (DAY(tanggal) BETWEEN 09 AND 16)";
	$result=mysqli_query($link,$query);
	$r=mysqli_fetch_row($result);
	$minggu2=$r[0]/1000;

	$query="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$b' AND (DAY(tanggal) BETWEEN 17 AND 24)";
	$result=mysqli_query($link,$query);
	$r=mysqli_fetch_row($result);
	$minggu3=$r[0]/1000;

	$query="SELECT SUM(laba) FROM penjualan WHERE MONTH(tanggal)='$b' AND (DAY(tanggal) BETWEEN 25 AND 31)";
	$result=mysqli_query($link,$query);
	$r=mysqli_fetch_row($result);
	$minggu4=$r[0]/1000;

	$laba=array($minggu1,$minggu1,$minggu2,$minggu3,$minggu4);

  $query="SELECT nama_barang, SUM(jumlah) AS total FROM penjualan WHERE MONTH(tanggal)='$b' GROUP BY nama_barang ORDER BY total DESC limit 6";
	$result=mysqli_query($link,$query);

	while($r=mysqli_fetch_assoc($result)){
		$total[]=$r['total'];
		$nama[]=$r['nama_barang'];
		
	}$a=array(); 
	foreach ($total as $value) {
		array_push($a, $value);
	}

	$b=array();
	foreach ($nama as $value) {
		array_push($b,$value);
	}
?>

<script>

var NamaBulan=new Array("Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
var a = new Date;
var bulan = NamaBulan[a.getMonth()];

var ctx = document.getElementById("laba");
var myChart = new Chart(ctx, {
   type: 'line',
   data: {
      labels: ['1', '8', '16', '24', 'Akhir'],
      datasets: [{
      label: 'Laba Penjualan PerMinggu Bulan ' + bulan + ' (x Rp 1000)',
      data: <?php echo json_encode($laba); ?>,
      backgroundColor: ['#4B94BF'],
      borderColor: ['rgb(102, 153, 255)'],
      borderWidth: 1
      }]
   },
   
      options: {
         scales: {
            xAxes: [{
               gridLines: {
                  color: "rgba(0, 0, 0, 0)"
               }
            }],
            yAxes: [{
               gridLines: {
                  color: "rgba(0, 0, 0, 0)"
               }
            }]
         }
      }
   });


   var ctx = document.getElementById("laris");
   var myChart = new Chart(ctx, {
   	type: 'pie',
      data: {
      labels: <?php echo json_encode($b); ?>,
      datasets: [{
         data: <?php echo json_encode($a); ?>,
         backgroundColor: [
                  "#f56954",
                  "#00a65a",
                  "#f39c12",
                  "#00c0ef",
                  "#3c8dbc"
         ],
         hoverBackgroundColor: [
                  "#f56954",
                  "#00a65a",
                  "#f39c12",
                  "#00c0ef",
                  "#3c8dbc"
         ]
      }]
   },
      options: {
      title: {
         display: true,
         position: 'top',
         text: 'Item Paling Banyak Terjual Bulan ' + bulan
      },
         legend: {
      	   display: true,
            position: 'right'
         }
      }
   });


   var ctx = document.getElementById("buyers3");
   var myChart = new Chart(ctx, {
   type: 'doughnut',
   data: {
      labels: <?php echo json_encode($b); ?>,
      datasets: [{
   	   data: <?php echo json_encode($a); ?>,
         backgroundColor: [
                  "#f56954",
                  "#00a65a",
                  "#f39c12",
                  "#00c0ef",
                  "#3c8dbc"
         ],
   	hoverBackgroundColor: [
                  "#f56954",
                  "#00a65a",
                  "#f39c12",
                  "#00c0ef",
                  "#3c8dbc"
         ]
      }]
   },
      options: {
      title: {
         display: true,
         position: 'top',
         text: 'Item Paling Banyak Terjual Bulan ' + bulan
      },
         legend: {
   	      display: true,
      	   position: 'right'
         }
      }
   });
   
</script>

<?php include "footer.php";?>