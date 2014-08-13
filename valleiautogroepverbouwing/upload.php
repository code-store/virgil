<?php

	
	$dir = $_GET['dir'];
	$bg_location = $_GET['bg_location'];
	$location = $_GET['location'];
	
 
	if ($dir == "projectimages") { $uploaddir = './images/projectimages/'; } 
	if ($dir == "productimages") { $uploaddir = './product_images/'; } 
	if ($dir == "backgrounds") { $uploaddir = './images/backgrounds/'; } 
	

//$uploaddir = './product_images/'; 


if ($location != "")
	{
	$file = $uploaddir.$location."_".basename($_FILES['uploadfile']['name']); 
	}
	else
	{
	$file = $uploaddir.basename($_FILES['uploadfile']['name']); 
	}
	
$file_name= $_FILES['uploadfile']['name']; 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}
?>
