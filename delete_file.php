<?php 

	ob_start();
	include('config.php');

	$filename = $_GET["file"];   
 
if ($filename) {

	//------------------------------------------DELETE A FILE/------------------------------------------
		$sql = "DELETE FROM links WHERE image = '{$filename}'";
		if (!mysql_query($sql)) {
					die('Sorry. Error at saving data! Please try again later!');
				} 
			else { echo "DELETED";}

	//Delete file...
	unlink('./images/projectimages/'.$filename);
	}

	
header( 'Location: ./admin.php' ) ;

?>