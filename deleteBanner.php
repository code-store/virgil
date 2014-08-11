<?php 

	ob_start();
	include('config.php');

	$bannerName = $_POST["bannerName2"];   
 
if ($bannerName) {

	//------------------------------------------DELETE A WEBPAGE------------------------------------------
		$sql = "DELETE FROM banners WHERE name = '{$bannerName}'";
		if (!mysql_query($sql)) {
					die('Sorry. Error at saving data! Please try again later!');
				} 
			else {}
			
	}
						
header( 'Location: ./admin.php#bannerslider' ) ;

?>