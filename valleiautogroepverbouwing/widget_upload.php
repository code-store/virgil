<?php


	$widget = $_GET['widg'];
	$location = $_GET['name'];
 
	if ($widget == "gallery") { 
		$uploaddir = './widgets/'.$location.'/images/'; 
		$file = $uploaddir.basename($_FILES['uploadfile']['name']); 
		} 
		
	if ($widget == "flexbanner") { 
		$uploaddir = './widgets/flexbanner/images/'; 
		$file = $uploaddir."image.jpg"; 
		}
		
	if ($widget == "flexbanner2") { 
		$uploaddir = './widgets/flexbanner2/images/'; 
		$file = $uploaddir."image.jpg"; 
		} 	
	
	
	//$file_name= $_FILES['uploadfile']['name']; 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}
?>
