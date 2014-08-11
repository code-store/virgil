<?php

	ob_start();
	include('config.php');
	
	$head_bg_color = $_POST["widget_head_bg"];
	$head_text_color = $_POST["widget_head_text"];
	$content_bg_color = $_POST["widget_content_bg"];
	$content_text_color = $_POST["widget_content_text"];
	$widget_border_radius = $_POST["widget_border_radius"];
	$widget_border_color = $_POST["widget_border_color"];
		
	$sql = "UPDATE widgets_settings SET head_bg_color = '".$head_bg_color."', head_text_color='".$head_text_color."', content_bg_color='".$content_bg_color."', content_text_color='".$content_text_color."', border_radius=".$widget_border_radius.", widget_border_color='".$widget_border_color."' WHERE id = 1";
		if (!mysql_query($sql)) { die('Sorry. Error at saving data! Please try again later!'); }
		
	header( 'Location: ./admin.php#widgets' ) ;
	
?>