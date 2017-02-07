<?php
include "cek_sesi.php";
?>
   <!DOCTYPE html>
   <html>

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Rumah Tenun, Inc</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="dist/css/skins/skin-purple.min.css">
      <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
      <link href="bower_components/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
      <link href="bower_components/daterange/daterangepicker.css" rel="stylesheet" type="text/css" />
      <link href="bower_components/iCheck/skins/flat/blue.css" rel="stylesheet">
      <link href="bower_components/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
      #ui-datepicker-div {
         z-index: 9999 !important;
      }
      
      div.ui-datepicker {
         font-size: 12px;
      }
      
      div.ui-daterangepicker {
         font-size: 12px;
      }
      
      .ui-autocomplete {
         z-index: 9999;
      }
      
      .ui-widget {
         font-size: 12px;
      }
      
      .table {
         border-collapse: initial;
      }
      
      .tebal {
         font-weight: bold;
      }
      
      .biasa {
         color: inherit;
      }
      
      .daterangepicker {
         left: 400px!important;
         font-size: 12px;
      }
      
      .no-padding {
         padding: 0 7px!important;
      }
      </style>
      <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
      <script src="bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
   </head>
   <!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

   <body class="hold-transition skin-purple sidebar-mini">
      <div class="wrapper">

         <!-- Main Header -->
         <header class="main-header">

            <!-- Logo -->
            <a href="beranda.php" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>A</b>LT</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>APeV</b>LTE</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <span class="sr-only">Toggle navigation</span>
               </a>


            <?php include "koneksi.php";
            //tampilkan jumlah stok barang tersedia yang <= 20
            $query="SELECT COUNT(jumlah) as jumlah FROM data_barang WHERE jumlah<=20";
            $result=mysqli_query($link,$query);

            $r=mysqli_fetch_assoc($result);
            $a=$r['jumlah'];

            //tampilkan status pengiriman penjualan
            $query="SELECT COUNT(status) as status FROM penjualan WHERE status='sending'";
            $result=mysqli_query($link,$query);

            $r=mysqli_fetch_assoc($result);
            $b=$r['status']; 

            // tampilkan ordered
            date_default_timezone_set('Asia/Jakarta');
            $hari=date('d');
            $query="SELECT COUNT(*) AS jum FROM penjualan_temp WHERE day(tanggal)='$hari'";
            $result=mysqli_query($link,$query);
            $e = mysqli_fetch_assoc($result);

            //tampilkan nama lengkap dan foto dari user
            $sesi=$_SESSION['login'];
            $query="SELECT nama_lengkap,foto FROM admin WHERE user='$sesi'";
            $result=mysqli_query($link,$query);

            $r=mysqli_fetch_assoc($result);
            $c=$r['nama_lengkap']; 
            $d=$r['foto']; 
      
            ?>


               <!-- Navbar Right Menu -->
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">

                     <!-- Notifications: style can be found in dropdown.less -->
                     <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-bell-o"></i>
                           <span class="label label-warning">10</span>
                        </a>

                        <ul class="dropdown-menu">
                           <li class="header">You have 10 notifications</li>
                           <li><!-- inner menu: contains the actual data -->
                              <ul class="menu">
                                 <li>
                                    <a href="pesan.php">
                                       <i class="fa fa-warning text-danger"></i>
                                       <?php echo $a; ?> jenis tenun kurang dari 20
                                    </a>
                                 </li>

                                 <li>
                                    <a href="pesan.php">
                                       <i class="fa fa-warning text-yellow"></i>
                                       <?php echo $b; ?> pesanan masih berstatus SENDING
                                    </a>
                                 </li>

                                 <li>
                                    <a href="order.php">
                                       <i class="fa fa-shopping-cart text-green"></i>
                                       <?php echo $e['jum']; ?> sales made today
                                    </a>
                                 </li>

                              </ul>
                           </li>
                        </ul>
                     </li>


                     <!-- User Account Menu -->
                     <li class="dropdown user user-menu">

                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <!-- The user image in the navbar-->
                           <img src="image/<?php echo $d; ?>" class="user-image" alt="User Image">
                           <!-- hidden-xs hides the username on small devices so only the image appears. -->
                           <span class="hidden-xs"><?php echo ucfirst($c); ?></span>
                        </a>

                        <ul class="dropdown-menu">
                           <!-- The user image in the menu -->
                           <li class="user-header">
                              <img src="image/<?php echo $d; ?>" class="img-circle" alt="User Image">
                              <p>
                                 <?php echo ucfirst($c); ?> - ngakunya sch bisa ngoding
                                 <small>Member since Nov. 2016</small>
                              </p>
                           </li>
                           <!-- Menu Body -->


                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
                              </div>

                              <div class="pull-right">
                                 <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>


         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="image/<?php echo $d; ?>" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p>
                        <?php echo ucfirst($c); ?>
                     </p>
                     <!-- Status -->
                     <small><span><i class="fa fa-circle text-success"></i>&nbsp&nbspOnline</span></small>
                  </div>
               </div>


               <!-- Sidebar Menu -->
               <ul class="sidebar-menu">
                  <li class="header">NAVIGASI UTAMA</li><!-- Optionally, you can add icons to the links -->
                  <li><a href="beranda.php"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
                  <li><a href="order.php"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span>Order request</span></a></li>
                  <li><a href="data_barang.php"><i class="fa fa-book"></i> <span>Data barang</span></a></li>
                  <li><a href="penjualan.php"><i class="fa fa-money"></i> <span>Penjualan</span></a></li>
                  <li><a href="laporan.php"><i class="fa fa-file-pdf-o"></i> <span>Laporan</span></a></li>
                  <li><a href="backup.php"><i class="fa fa-download"></i> <span>Backup database</span></a></li>
                  <li class="treeview">
                     <a href="#"><i class="fa fa-balance-scale"></i> <span>Retur barang</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="#">retur barang</a></li>
                        <li><a href="#">retur barang</a></li>
                     </ul>
                  </li>

                  <li><a href="mobile.php" target="_blank"><i class="fa fa-google-wallet"></i> <span>Simulasi</span></a></li>
               </ul>
               <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
         </aside>


         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1 id="page">
                  <span>Page Header</span>
                  <small><?php echo date('d F Y');?><span>&nbsp</span><span id="output"></span></small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="beranda.php"><i class="fa fa-dashboard"></i>Home</a></li>
                  <li class="active">Here</li>
               </ol>
            </section>


            <!-- Main content -->
            <section class="content">


                                                      <!-- Your Page Content Here -->

               
<script type="text/javascript">
$(function() {

   //tambah class active di menu yg aktip
   var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
   $('ul.sidebar-menu').find('li a').each(function() {
   if ($(this).attr("href") == pgurl)
      $(this).parent().addClass("active");
   });

   //tambah angka di pemberitahuan
   var a = <?php echo json_encode($a+$b); ?>;
   $('.navbar-custom-menu').find('span').filter('.label').html(a);
   $('.navbar-custom-menu').find('li').filter('.header').html('Anda Mempunyai ' + a + ' Pesan');

   //tampilkan jam secara realtime
   setInterval(function() {

      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();

      // Add leading zeros
      minutes = (minutes < 10 ? "0" : "") + minutes;
      seconds = (seconds < 10 ? "0" : "") + seconds;
      hours = (hours < 10 ? "0" : "") + hours;

      // Compose the string for display
      var currentTimeString = hours + ":" + minutes + ":" + seconds;
      $("#output").html(currentTimeString);

   }, 1000);

});

</script>