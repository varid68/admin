<?php include'header.php';

date_default_timezone_set('Asia/Jakarta');
if (isset($_GET['v'])) {
   echo '<script>swal("selamat!", "Tindakan Berhasil Dilakukan!", "success");</script>';
}

$a=$_COOKIE['waktu'];
?>

<div class="callout callout-danger">
   <p>lakukanlah backup secara rutin minimal 1x/minggu untuk menghindari hilangnya DATABASE</p>
</div>

<div class="row">
   <div class="col-md-6">
      <h4> backup database </h4>
      <p>backup terakhir tanggal : <strong><i><?php echo $a; ?></i></strong></p>
      <p>daftar tabel :</p>
      <ul>
         <li>admin</li>
         <li>data_barang</li>
         <li>Penjualan</li>
         <li>pembeli</li>
         <li>Provinsi</li>
         <li>kabupaten</li>
         <li>kecamatan</li>
      </ul>
      <a href="backup_db.php" class="btn btn-sm bg-navy"><i class="fa fa-cloud-download" aria-hidden="true"></i>&nbsp; backup </a>
   </div>

   <div class="col-md-5">
      <h4> restore database </h4>
      <?php
         $folder = "backup/"; //Sesuaikan Folder nya
         if(!($buka_folder = opendir($folder))) die ("eRorr... Tidak bisa membuka Folder");

         $file_array = array();
         while($baca_folder = readdir($buka_folder)){
            $file_array[] = $baca_folder;
         }

         $jumlah_array = count($file_array);
         for($i=2; $i<$jumlah_array; $i++){
            $nama_file = $file_array;
            $nomor = $i - 1;
            echo "<span>".$nomor.'. '. $nama_file[$i]."</span>";
            echo "<a href='' class='pull-right hapus'><i class='fa fa-trash'></i></a>";
            echo "<a href='#' class='pull-right' title='restore' style='width: 30px'><i class='fa fa-cloud-upload'></i></a><br>";
         }

      closedir($buka_folder);
       ?>
   </div>
</div>

<script type="text/javascript">
//plugin pengganti alert ja
$('a.hapus').click(function(e) {
   e.preventDefault();
   var id = $(this).prev().text();
   var potong = id.substring(3);
   $(this).attr('href', 'hapus_db.php?id=' + potong);
   swal({
      title: 'Apa Anda Yakin?',
      text: "Ingin Menghapus " + potong,
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
   }).then(function() {
      //$(this).attr('href','hapus_db.php?id='+potong);
      location.href = 'hapus_db.php?id=' + potong
   });
});
</script>

<?php include 'footer.php'; ?>