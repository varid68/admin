<?php
require_once 'koneksi.php';
require_once "vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
require_once 'vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

if (isset($_POST['preview'])){

  $tmpfname = $_FILES['excel']['tmp_name'];
  $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
  $excelObj = $excelReader->load($tmpfname);
  $worksheet = $excelObj->getSheet(0);
  $lastRow = $worksheet->getHighestRow();
?>  
  <table>
    <?php for ($row = 1; $row <= $lastRow; $row++) {  ?>
    <tr>
      <td width="50px"><?php echo $worksheet->getCell('A'.$row)->getValue(); ?></td>
      <td width="200px"><?php echo $worksheet->getCell('B'.$row)->getValue(); ?></td>
      <td width="110px"><?php echo $worksheet->getCell('C'.$row)->getValue(); ?></td>
      <td width="110px"><?php echo $worksheet->getCell('D'.$row)->getValue(); ?></td>
      <td width="110px"><?php echo $worksheet->getCell('E'.$row)->getValue(); ?></td>
    </tr><?php } ?>
  </table>
<?php } 

elseif (isset($_POST['import'])) { 

   $tipe = explode('.',$_FILES['excel']['name']);
   if ($tipe[1]=='xlsx'){


      // load excel
      $file = $_FILES['excel']['tmp_name'];
      $load = PHPExcel_IOFactory::load($file);
      $sheets = $load->getActiveSheet()->toArray(null,true,true,true);

      $i = 1;
      foreach ($sheets as $sheet) {
         // karena data yang di excel di mulai dari baris ke 2
         // maka jika $i lebih dari 1 data akan di masukan ke database
         if ($i > 1) {
            // nama ada di kolom A
            // sedangkan alamat ada di kolom B
            $b=$sheet['B'];  $c=$sheet['C'];  $d=$sheet['D'];  $e=$sheet['E'];
            $sql = "INSERT INTO data_barang VALUES(NULL,'$b','$c','$d','$e')";
            $result=mysqli_query($link,$sql);

         }

            if($result) {
               // pesan jika data berhasil di input
               header('location:data_barang.php?v');
            } else echo "gagal";

      $i++;
      }
   }

   else echo "format yang didukung excel 2007 ~ 2016 (.xlsx)";
  
} ?>