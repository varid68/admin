<?php
$return_var = NULL;
$output = NULL;
$nama='backup_'.date('d-m-y');

$command = "mysqldump -u root -h localhost tenun2 > backup/$nama.sql";
exec($command, $output, $return_var);

if($return_var == 0) {
  date_default_timezone_set('Asia/Jakarta');
  setcookie('waktu',date('d-m-Y'),time() + 60*60*24*7*4);
  header('location:backup.php?v');
}
?>