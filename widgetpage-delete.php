<?php 

	ob_start();
	include('config.php');

	$widgetPageIdentificator = $_POST["widgetpageName"];   
	 
if ($widgetPageIdentificator) {

	//------------------------------------------DELETE A WEBPAGE------------------------------------------
		$sql = "DELETE FROM widgets_pages WHERE identificator = '{$widgetPageIdentificator}'";
		if (!mysql_query($sql)) {
					die('Sorry. Error at saving data! Please try again later!');
				} 
			else {}
			
	}
						
header( 'Location: ./admin.php#templates' ) ;

?>