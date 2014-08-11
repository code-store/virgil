<?php 

	ob_start();
	include('config.php');
						
	$template_type = $_POST["contact"]; 
	//$the_pagewidth = $_POST["the_pagewidth"]; 
	//$the_columnwidth = $_POST["the_columnwidth"]; 
	$current_widgetpage = trim($_POST["current_widgetpage"]); 
	
	if ($the_columnwidth == "") { $the_columnwidth = 0; }
		
	if (($template_type) && ($current_widgetpage)){
	
		//$sql = "UPDATE widgets_pages SET template_type='".$template_type."', page_width=".$the_pagewidth.", column_width=".$the_columnwidth." WHERE identificator='".$current_widgetpage."'";
		$sql = "UPDATE widgets_pages SET template_type='".$template_type."' WHERE identificator='".$current_widgetpage."'";
		
		echo $sql;
			
			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
		}
	
	header( 'Location: ./admin.php#templates' ) ;

?>