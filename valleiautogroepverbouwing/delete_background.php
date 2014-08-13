<?php 

	ob_start();
	include('config.php');

	$filename = $_GET["file"];   
 
if ($filename) {
		$filename = str_replace("isbg_", "", $filename);

		//Delete file...
		unlink('./images/backgrounds/'.$filename);
	}

	
header( 'Location: ./admin.php' ) ;

?>