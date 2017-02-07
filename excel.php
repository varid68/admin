<?php 
 
/**
 * digunakan untuk generate file excel.
 * sebagai contoh di goblooge.com
 * 
 * @author 		: Nurul Huda
 * @copyright 	: goblooge@gmail.com
 * @license 	: LGPLv2
 * @database 	: - goblooge.keluarga
 * @since		: 16 Sept 2016
 * @version		: 1.0.0
 * 
 * */
 
//ini adalah require yang dibutuhkan cukup merequire file pertama di PHP Excel. 
//sesuaikan dengan Path Milik anda
	require_once "vendor/phpoffice/phpexcel/Classes/PHPExcel.php";
	include 'koneksi.php';

/*start - BLOCK PROPERTIES FILE EXCEL*/
	$file = new PHPExcel ();
	$file->getProperties ()->setCreator ( "Goblooge" );
	$file->getProperties ()->setLastModifiedBy ( "Nurul Huda" );
	$file->getProperties ()->setTitle ( "Data Keluarga" );
	$file->getProperties ()->setSubject ( "Inheritance Keluarga" );
	$file->getProperties ()->setDescription ( "Data Inheritance Keluarga" );
	$file->getProperties ()->setKeywords ( "Keluarga Nurul Huda" );
	$file->getProperties ()->setCategory ( "Keluarga" );
/*end - BLOCK PROPERTIES FILE EXCEL*/
 
/*start - BLOCK SETUP SHEET*/
	$file->createSheet ( NULL,0);
	$file->setActiveSheetIndex ( 0 );
	$sheet = $file->getActiveSheet ( 0 );
	//memberikan title pada sheet
	$sheet->setTitle ( "Database Keluarga" );
/*end - BLOCK SETUP SHEET*/
 
/*start - BLOCK HEADER*/
	$sheet	->setCellValue ( "A1", "No" )
			->setCellValue ( "B1", "Nama barang" )
			->setCellValue ( "C1", "modal" )
			->setCellValue ( "D1", "Harga jual" )
			->setCellValue ( "E1", "Jumlah" );
/*end - BLOCK HEADER*/
 
/* start - BLOCK MEMASUKAN DATABASE*/
	$query="SELECT * FROM data_barang";
	$result=mysqli_query($link,$query);
	$nomor=1;
	while($row=mysqli_fetch_array($result)){
		$nomor++;
		$sheet	->setCellValue ( "A".$nomor, $nomor )
			->setCellValue ( "B".$nomor, $row["nama_barang"] )
			->setCellValue ( "C".$nomor, $row["modal"] )
			->setCellValue ( "D".$nomor, $row["harga_jual"] )
			->setCellValue ( "E".$nomor, $row["jumlah"] );
	}
/* end - BLOCK MEMASUKAN DATABASE*/
 
/* start - BLOCK MEMBUAT LINK DOWNLOAD*/
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data barang.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($file, 'Excel2007');
$objWriter->save('php://output');
 
?>