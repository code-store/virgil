<?php 

	ob_start();
	include('config.php');

	$filename = $_POST["fileName2"];   
 

if ($filename) {

	//------------------------------------------DELETE A WEBPAGE------------------------------------------
		$sql = "DELETE FROM webpages WHERE file = '{$filename}'";
		if (!mysql_query($sql)) {
					die('Sorry. Error at saving data! Please try again later!');
				} 
			else {}
	}
						
header( 'Location: ./admin.php#pages' ) ;

?>