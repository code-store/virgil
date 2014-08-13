<?php

	ob_start();
	include('config.php');

	$image = $_GET["image"]; 
	$url = $_GET["url"]; 
	$order = $_GET["order"]; 
	
	if (($image) && ($url) && ($order)){
	
		$SQL = "SELECT * FROM links WHERE links.image = '".$image."'";
		$result = mysql_query($SQL);
		$res = mysql_fetch_assoc($result); 
		
		if ($res['image'])
			{
				//UPDATE
				$sql = "UPDATE links SET url='".$url."', sorder={$order} WHERE image='".$image."'";
				if (!mysql_query($sql)) {
					echo $sql;//"<span style='color:red;'>NOT SAVED!</span>";
					}	 
				else {
					echo "<span style='color:green;'>SAVED!</span>";
					}
			}
			else
			{
				//INSERT
				$sql = "INSERT INTO links VALUES ('{$image}', '{$url}', '', {$order})";
				if (!mysql_query($sql)) {
					echo "<span style='color:red;'>NOT SAVED!</span>";							} 
				else{
					echo "<span style='color:green;'>SAVED!</span>";
					}			
			}
	
		
		}
		else {
			echo "<span style='color:black;'>Fill all!</span>";
		}
	
?>