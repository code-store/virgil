<?php
        error_reporting(E_ALL);

	$widget = $_GET['widg'];
	
 
	if ($widget == "gallery") { 
            
		$uploaddir = '/widgets/gallery_2/images/'; 
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
