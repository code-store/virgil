<?php 

	ob_start();
	include 'config.php';

	$file = $_GET["file"]; 

if ($file)

	{
		$ret_array = array();
		
		$sql = "SELECT * FROM webpages WHERE file='".$file."'";
		$result = mysql_query($sql);
		
			while ($db_field = mysql_fetch_assoc($result)) 
					{
						$ret_array[0] = stripslashes($db_field['text']);
						$ret_array[1] = $db_field['meta_t'];
						$ret_array[2] = $db_field['meta_d'];
						$ret_array[3] = $db_field['meta_k'];
						$ret_array[4] = $db_field['is_home'];
						$ret_array[5] = $db_field['urlinput'];
						$ret_array[6] = $db_field['template'];
						$ret_array[7] = $db_field['language'];
					}
		

		$sql = "SELECT * FROM webpages WHERE PageID=".$ret_array[5];
		$result = mysql_query($sql);
		while ($db_field = mysql_fetch_assoc($result)) {
				$ret_array[5] = $db_field['file'];
			}
		
	}

	print_r($ret_array);

?>