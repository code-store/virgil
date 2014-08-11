<?php
	
	ob_start();
	include 'config.php';
	
	$template_type = $_GET['template_type'];
	$page_id = $_GET['page_id'];
	
	$container2 = $_GET['container2'];
	$container3 = $_GET['container3'];
	$container4 = $_GET['container4'];
	
	
	$widget_string = $container2.$container3.$container4;
	$widget_string = substr($widget_string, 0, -1);

	
		$sql = "UPDATE widgets_pages SET widgets='".$widget_string."' WHERE name='".$page_id."'";
			
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
	
?>