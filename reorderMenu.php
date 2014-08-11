<?php

	ob_start();
	include('config.php');

	$menu_col = $_POST["menu_col"]; 
	$menu_col_hover = $_POST["menu_col_hover"]; 
	$group_m = $_POST["group_m"]; 
	
	$menu_textc = $_POST["menu_textc"]; 
	$menu_textc_hover = $_POST["menu_textc_hover"]; 
	
	
	$sql = "SELECT * FROM webpages";
	$result = mysql_query($sql);
	$k = 1;
		
	
		
		// Insert data into DB //
		if ($group_m != 'colour')
		{$sql = "UPDATE webpages_settings SET webpages_settings.menu_bg = '".$group_m."' WHERE webpages_settings.id = 1";}
			else{
				$sql = "UPDATE webpages_settings SET webpages_settings.menu_bg = '".$menu_col."' WHERE webpages_settings.id = 1";
		}
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }	
		
			
		$sql = "UPDATE webpages_settings SET webpages_settings.menu_bg_hover = '".$menu_col_hover."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }	

		$sql = "UPDATE webpages_settings SET webpages_settings.menu_textc = '".$menu_textc."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }	
		
		$sql = "UPDATE webpages_settings SET webpages_settings.menu_textc_hover = '".$menu_textc_hover."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }	
			
			
		header( 'Location: ./admin.php#mymenu' ) ;	
	
?>