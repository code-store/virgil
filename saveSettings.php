<?php 
	
	ob_start();
	include('config.php');

	$backg_col = $_POST["backg_col"];
	
	$twitterUrl = $_POST["twitterUrl"];
	$youtubeUrl = $_POST["youtubeUrl"];
	$facebookUrl = $_POST["facebookUrl"];
	$blogUrl = $_POST["blogUrl"];
	
	$bs_height = $_POST["bs_height"];
	$group_b = $_POST["group_b"];
	$banner_col = $_POST["banner_col"]; 
	
	
	$show_on_this = $_POST["show_on_this"];  
	
	foreach($show_on_this as $pgs){
		$str .= $pgs."|";
	}

	$str = substr($str, 0, -1);
			

			
			
	
	
	//  If some of the data did not arrive............................... //
	//--------------------------------------------------------------------//
	$SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
	$result = mysql_query($SQL);

	$res = mysql_fetch_assoc($result); 
	
	
	if ($backg_col == "" || $backg_col == null) { $backg_col = $res['colour']; }
	
	
	
	//--------------------------------------------------------------------//	
	//Save background color for page.....

	$text =  '<style type="text/css"> body {background-color: #'.$backg_col.'; } </style>';	
	
	$sql = "UPDATE webpages_elements SET webpages_elements.gen_settings = '".addslashes($text)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
	
	
	
	//--------------------------------------------------------------------//
	//Save background color for banner slider .....
	
	if ($group_b != 'colour')
		{
		$text =  '<div id="slides" style="background: url(\'../images/backgrounds/'.$group_b.' \'); height:'.$bs_height.'px; ">';
		}
		else
		{
		$text =  '<div id="slides" style="background: #'.$banner_col.';" height:'.$bs_height.'px; ">';
		}
	
	$stringData = $text;
	
	$stringData = str_replace("../", './', $stringData);
	$stringData = str_replace("../images/", "./images/", $stringData);
	
	$sql = "UPDATE webpages_elements SET webpages_elements.slider = '".addslashes($stringData)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
	
	
	
	
	//--------------------------------------------------------------------//
	//Save social block.....

		$social = '<div class="social_ext"><div class="socials">';
		
		if ($twitterUrl != "") { $social .= '<a href="http://'.$twitterUrl.'" target="_blank"><img src="./images/twitter1.png"/></a>'; }
		if ($youtubeUrl != "") { $social .= '<a href="http://'.$youtubeUrl.'" target="_blank"><img src="./images/youtube1.png"/></a>'; }
		if ($facebookUrl != "") { $social .= '<a href="http://'.$facebookUrl.'" target="_blank"><img src="./images/facebook1.png"/></a>'; }
		if ($blogUrl != "") { $social .= '<a href="http://'.$blogUrl.'" target="_blank"><img src="./images/blog1.png"/></a>'; }
		
		$social .= '</div></div>';
		$stringData = $social;
	
		$sql = "UPDATE webpages_elements SET webpages_elements.social = '".addslashes($stringData)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
	
	
	
	
	
	$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_location = '".$str."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('Sorry. Error at saving data! Please try again later!'); }
	
	
	
	$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_bg = '#".$banner_col."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }
		

	if ($group_b != 'colour')
		{
		$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_bg = '".$group_b."' WHERE webpages_settings.id = 1";
			if (!mysql_query($sql)) { die('31.Sorry. Error at saving data! Please try again later!'); }
		}
		else
		{
		$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_bg = '".$banner_col."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('31.Sorry. Error at saving data! Please try again later!'); }
		}
	
	if ($bs_height == "auto"){	
		$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_height = '".$bs_height."' WHERE webpages_settings.id = 1";
	}
	else {
		$sql = "UPDATE webpages_settings SET webpages_settings.banner_slider_height = ".$bs_height." WHERE webpages_settings.id = 1";
	}
		if (!mysql_query($sql)) { echo $sql;  die('32.Sorry. Error at saving data! Please try again later!'); }
	

	$sql = "UPDATE webpages_settings SET webpages_settings.colour = '".$backg_col."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }
		

	$sql = "UPDATE webpages_settings SET webpages_settings.twitterUrl = '".$twitterUrl."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('31.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.youtubeUrl = '".$youtubeUrl."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { echo $sql;  die('32.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.facebookUrl = '".$facebookUrl."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('33.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.blogUrl = '".$blogUrl."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('34.Sorry. Error at saving data! Please try again later!'); }
		
	
	
	header( 'Location: ./admin.php#setts' ) ;

?>