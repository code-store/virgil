<?php 

	ob_start();
	include('config.php');
						
	$text = $_POST["elm3"]; 
	$file = $_POST["fileSelector3"]; 
	$bannerLang = $_POST["bannerLang"]; 
	
	
	$text = addslashes($text);
			
	if (($file) && ($text)){
	
		$sql = "UPDATE banners SET content='".$text."', language='".$bannerLang."' WHERE name='".$file."'";
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
		}
	
	header( 'Location: ./admin.php#bannerslider' ) ;

?>