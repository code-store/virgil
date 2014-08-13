<?php 

	ob_start();
	include('config.php');

	//$header_color = $_POST["header_color"]; 
	$group1 = $_POST["group1"]; 
	$header_col = $_POST["header_col"]; 
	//$navig_col = $_POST["navig_col"]; 
	$header_height = $_POST["header_height"]; 
	$header_text = $_POST["header_text"]; 
	$img_src = $_POST["img_src"];
	$google_analytics = $_POST["google_analytics"];
	
	
	//  If some of the data did not arrive............................... //
	//--------------------------------------------------------------------//
	$SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
	$result = mysql_query($SQL);

	$res = mysql_fetch_assoc($result); 
	
	
	if ($group1 == "" || $group1 == null) { $group1 = $res['header_bg']; }
	if ($header_height == "" || $header_height == null) { $header_height = $res['header_height']; }
	if ($img_src == "" || $img_src == null) { $img_src = $res['header_img']; }
	if ($header_text == "" || $header_text == null) { $header_text = $res['header_text']; }
	//--------------------------------------------------------------------//
	
	
	$head =	'</head>';
	$head =	$head.'<body style="margin: 0 auto;"><div class="responsive-image"></div>';

	if ($group1 == "colour")
		{
		$head =	$head.'<div class="wrap"><div class="inner-wrap"><div class="header_ext" style="background:#'.$header_col.'; "><div class="customheader" style=" height:'.$header_height.'px; background:#'.$header_col.'; ">';	
			$head =	$head.'<a class="logo" href="./" style="float:left; overflow:hidden;"><img src = "../'.$img_src.'" style="float:left; padding:0; border:0;" alt="" /></a><div id="search-wrap">
            
            <div class="search">
                <form class="searchForm" method="post" action="">
                    <input type="text" value="Start Searching..." title="Search" class="searchInput" />
                    <input type="submit" title="Go" value="Go" name="action_results" class="searchBtn" />
                </form>
            </div>
            
           
            <div class="call">
                Call Information: <br />
                <h2>0800-888-888</h2>
            </div>
        </div>';
				
		$head =	$head.'</div>';
		}
		else
		{
		$head =	$head.'<div class="wrap"><div class="inner-wrap"><div class="header_ext" style="background: url(\' ../images/backgrounds/'.$group1.'\') repeat top left; "><div class="customheader" style=" height:'.$header_height.'px; ">';	
			$head =	$head.'<a class="logo" href="./" style="float:left; overflow:hidden;"><img src = "../'.$img_src.'" style="float:left; border:0;" alt="" /> </a>
			<div id="search-wrap">
            
            <div class="search">
                <form class="searchForm" method="post" action="">
                    <input type="text" value="Start Searching..." title="Search" class="searchInput" />
                    <input type="submit" title="Go" value="Go" name="action_results" class="searchBtn" />
                </form>
            </div>
            
           
            <div class="call">
                Call Information: <br />
                <h2>0800-888-888</h2>
            </div>
        </div>';	
		$head =	$head.'</div>';
		}
	
	
	$stringData = $head;
	
	
	$stringData = str_replace("../", './', $stringData);
	$stringData = str_replace("../images/", "./images/", $stringData);
	
	$sql = "UPDATE webpages_elements SET webpages_elements.header = '".addslashes($stringData)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }

	
	
	
	// Insert data into DB //
	if ($group1 == "colour")
		{
		$sql = "UPDATE webpages_settings SET webpages_settings.header_bg = '".$header_col."' WHERE webpages_settings.id = 1";
			if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
		}
		else{
		$sql = "UPDATE webpages_settings SET webpages_settings.header_bg = '".$group1."' WHERE webpages_settings.id = 1";
			if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
		}
		
	$sql = "UPDATE webpages_settings SET webpages_settings.header_height = ".$header_height." WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('2.Sorry. Error at saving data! Please try again later!'); }

	$sql = "UPDATE webpages_settings SET webpages_settings.header_text = '".$header_text."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.header_img = '".$img_src."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('4.Sorry. Error at saving data! Please try again later!'); }
	
	
	if ($google_analytics != ""){
		$sql = "UPDATE webpages_settings SET webpages_settings.google_analytics = '".$google_analytics."' WHERE webpages_settings.id = 1";
			if (!mysql_query($sql)) { die('5.Sorry. Error at saving data! Please try again later!'); }
	}
	
	
	
	
	header( 'Location: ./admin.php#header' ) ;

?>