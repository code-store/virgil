<?php 

include 'config.php';

$file = $_GET["file"]; 

if ($file)
{
	$ret_array = array();
		
	$sql = "SELECT * FROM banners WHERE name='".$file."'";
	$result = mysql_query($sql);
	
		while ($db_field = mysql_fetch_assoc($result)) 
		{
			$ret_array[0] = stripslashes($db_field['content']);
			$ret_array[1] = $db_field['language'];
		}
		
		
	print_r($ret_array);	
	}

?>