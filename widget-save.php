<?php 

	ob_start();
	include('config.php');
						
	$text = $_POST["elm4"]; 
	$id = $_POST["widget_selected"]; 
	$title = $_POST["widget_new_title"]; 
		
	$text = addslashes($text);	

		
	if (($id) && ($text)){
	
		$sql = "UPDATE widgets SET content='".$text."', name='".$title."' WHERE identificator='".$id."'";
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
		}
	
	header( 'Location: ./admin.php#widgets' ) ;

?>