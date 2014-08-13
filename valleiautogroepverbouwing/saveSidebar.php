<?php 

	ob_start();
	include('config.php');

if(isset($_POST['save_form']) && $_POST['hid_form'] == 'hid_form')	
{ 
 $iframe_form = $_POST['iframe_form'];
 $iframe_width = $_POST['iframe_width'];
 $iframe_height = $_POST['iframe_height'];
 
$sidebar = '<div class="sidebar_ext">';	
	$sidebar .='<div class="body-left">';
      $sidebar .='<div class="form-container">';
		$sidebar .='<iframe src="form.php?url='.$iframe_form.'" width="'.$iframe_width.'" height="'.$iframe_height.'"></iframe>';
	    $sidebar .='</div>';
	$sidebar .='</div>';
$sidebar .= '</div>';
	
	
	
	$stringData = $sidebar;
	
	
	$stringData = str_replace("../", './', $stringData);
	$stringData = str_replace("../images/", "./images/", $stringData);
	
	$sql = "UPDATE webpages_elements SET webpages_elements.sidebar = '".addslashes($stringData)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE `webpages_settings` SET `iframe_form`='".$iframe_form."', `iframe_width`='".$iframe_width."', `iframe_height`='".$iframe_height."' WHERE webpages_settings.id = 1";	
	    if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
}
	header( 'Location: ./admin.php#sidebar' ) ;
	
	
	?>