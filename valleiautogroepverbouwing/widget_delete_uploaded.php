<?php 
	ob_start();
	$filename = $_GET["img"];   
	$source = $_GET["src"];   
	
	
	if ($filename) {
	
		if ($source == "gallery"){
			unlink('./widgets/gallery/images/'.$filename);
		}
                
                if(isset($_GET['action']) && $_GET['action']=='delete_gallery_img'){
                    unlink('./widgets/'.$source.'/images/'.$filename);
                }
	
	}
 


	
header( 'Location: ./admin.php#widgets' ) ;

?>