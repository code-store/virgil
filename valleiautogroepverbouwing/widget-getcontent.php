<?php 

	ob_start();
	include 'config.php';

	$widget = $_GET["widget"]; 

if ($widget)
	{
	
		$sql = "SELECT * FROM widgets WHERE identificator='".$widget."'";
		$result = mysql_query($sql);
		while ($db_field = mysql_fetch_assoc($result)) {
				$content = $db_field['content'];
				$title = $db_field['name'];
				$identificator = $db_field['identificator'];
			}
		
		print_r(stripslashes($content)."|||".$title."|||".$identificator);
	}
	else{
		echo "Please choose one widget!!";
	}
	

	

?>