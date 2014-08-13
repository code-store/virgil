<?php 

	ob_start();
	include('config.php');

	$widgetIdentificator = $_POST["widgetName2"];   
 
if ($widgetIdentificator) {

	//------------------------------------------DELETE A WEBPAGE------------------------------------------
		$sql = "DELETE FROM widgets WHERE identificator = '{$widgetIdentificator}'";
		if (!mysql_query($sql)) {
					die('Sorry. Error at saving data! Please try again later!');
				} 
			else {}
			
	}
						
header( 'Location: ./admin.php#widgets' ) ;

?>