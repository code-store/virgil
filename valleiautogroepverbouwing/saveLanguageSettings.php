<?php

	if ($_POST){
		
		ob_start();
		include('config.php');

		$defaultLang = $_POST["defaultLang"]; 
		$availableLangs = $_POST["availableLangs"]; 
		
			$str = "";
		
			foreach ($availableLangs as $lang){
				$str .= $lang."|";
			}
		
			$str = substr($str, 0, -1);
		
	//==================================================================================================================================//
	
		$sql = "UPDATE webpages_settings SET frontend_languages = '".$str."' WHERE id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
		
		$sql = "UPDATE webpages_settings SET default_language = '".$defaultLang."' WHERE id = 1";
		if (!mysql_query($sql)) { die('2.Sorry. Error at saving data! Please try again later!'); }
		
	
		header( 'Location: ./admin.php#languages' ) ;
	}
	
?>	