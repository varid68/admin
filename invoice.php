<?php
// Tampilkan data dari Database
include 'koneksi.php';
$kode=$_GET['id'];
$sql = "SELECT penjualan.kode AS kode2,nama_barang,harga_jual,jumlah,total_harga,nama,alamat2,kec,kab,prov,kontak FROM penjualan INNER JOIN pembeli ON penjualan.kode=pembeli.kode WHERE penjualan.kode='$kode'";
$tampil =mysqli_query($link,$sql);

$r=mysqli_fetch_assoc($tampil);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INVOICE</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <span class="glyphicon glyphicon-home"></span> Rumah Tenun, Inc
            <small class="pull-right">Tanggal: <?php echo date('d/m/Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong>Admin, Rumah Tenun</strong><br>
            Desa Teluk Wetan RT 24 RW 03<br>
            Kec. Welahan, kab. Jepara<br>
            Phone: 0858 7630 3788
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Kepada
          <address>
            <strong><?php echo $r['nama']; ?></strong><br>
            <?php echo $r['alamat2']; ?><br>
            <?php echo 'kec. '.$r['kec'].' '.$r['kab'].' '.$r['prov']; ?><br>
            Email: <?php echo $r['kontak']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice : </b>INV/XII/<?php echo date('ynj').'/0'.substr(time(),-4,3); ?><br>
          <br>
          <b>Order ID:</b> <?php echo $r['kode2']; ?><br>
          <b>Payment Due:</b> -<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Order ID</th>
              <th>Item</th>
              <th>Harga/M</th>
              <th>Qty</th>
              <th>total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><?php echo 1; ?></td>
              <td><?php echo $r['kode2']; ?></td> 
              <td><?php echo 'Tenun '.$r['nama_barang']; ?></td>
              <td><?php echo 'Rp '.number_format($r['harga_jual']); ?></td>
              <td><?php echo $r['jumlah']; ?></td>
              <td><?php echo 'Rp '.number_format($r['total_harga']); ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-md-offset-6 col-xs-6">          
          <div class="table-responsive">
            <table class="table table-borderless">
              <tr>
                <th>Diskon [Qty >=10 ] : </th>
                <td>Rp 0</td>
              </tr>
              <tr>
                <th>Ongkir : </th>
                <td>Rp 9,000</td>
              </tr>
              <tr>
                <th>Total : </th>
                <td><?php echo 'Rp '.number_format($r['total_harga']+9000); ?></td>
              </tr>
            </table>
          </div>
        </div>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <i><p class="small"><span class="glyphicon glyphicon-asterisk"></span> harap melunasi pembayaran sebelum jatuh tempo</p></i>
          <button type="button" class="btn bg-navy btn-sm btn-flat pull-right" onclick="window.print()">
            <span class="glyphicon glyphicon-download-alt"></span> print invoice
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div><?php $a=$_GET['id']; ?>
<script type="text/javascript">
  $('.no-print').filter('a').has('.btn').click(function(){
    var id=$('.table').find('tr:eq(1)').children(':nth-child(2)').text();
    $(this).attr('href','invoice-print.php?id='+id);
  });
</script>
</body>
</html>