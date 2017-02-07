<?php 
if (isset($_GET['id'])){
	$target="backup/".$_GET['id'];

	unlink($target);
	if(!file_exists($target)){
		header('location:backup.php?v');
	}
}
?>