<?php 

	ob_start();
	include('config.php');
						
	$text = $_POST["elm2"]; 
	$file = $_POST["fileSelector2"]; 
	
	$new_title = $_POST["new_title"];
	$meta_t = $_POST["meta_t"]; 
	$meta_d = $_POST["meta_d"]; 
	$meta_k = $_POST["meta_k"]; 
	
	$pageLang = $_POST["pageLang"]; 
	
	$ishome = $_POST["ishome"]; 
	$urlinput = $_POST["urlinput"];
	$templateSelector = $_POST['templateSelector'];
	$templateSelector_input = $_POST['templateSelector_input'];
	
	if ($templateSelector == "") { $templateSelector = $templateSelector_input; }
	
	if ($ishome == 'on') { $ishome = 1; }
					else { $ishome = 0; }
	
	
	$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
	$result2 = mysql_query($SQL2);

	$res2 = mysql_fetch_assoc($result2); 
	$slider_on_page = $res2['banner_slider_location'];
	
	
	$text = addslashes($text);
	
			
	if (($file) && ($text)){
	
			$sql = "UPDATE webpages SET text='".$text."', meta_t='".$meta_t."', meta_d = '".$meta_d."', meta_k = '".$meta_k."', is_home=".$ishome.", urlinput='".$urlinput."', template='".$templateSelector."', file='".$new_title."', language='".$pageLang."' WHERE file='".$file."'";
			
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
		}
		
		
	if (($file) && (!$text)){
		
		$sql = "UPDATE webpages SET meta_t='".$meta_t."', meta_d = '".$meta_d."', meta_k = '".$meta_k."', is_home=".$ishome.", urlinput='".$urlinput."', template='".$templateSelector."', file='".$new_title."', language='".$pageLang."' WHERE file='".$file."'";
			
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
			
	}
		
	header( 'Location: ./admin.php#pages' ) ;

?>