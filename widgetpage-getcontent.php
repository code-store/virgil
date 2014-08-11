<?php 

ob_start();
include 'config.php';

$page = $_GET["page"]; 

if ($page)

	{
		$ret_array = array();
		
		$sql = "SELECT * FROM widgets_pages WHERE name='".$page."'";
		$result = mysql_query($sql);
		
			while ($db_field = mysql_fetch_assoc($result)) 
					{
						$ret_array[0] = $db_field['template_type'];
						$ret_array[1] = $db_field['column_width'];
						$ret_array[2] = $db_field['page_width'];
						$ret_array[3] = $db_field['identificator'];
					}
	}

	print_r($ret_array);

?>