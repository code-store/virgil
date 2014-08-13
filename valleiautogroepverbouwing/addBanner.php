<?php 

	ob_start();
	include('config.php');

	$bannerName = $_POST["bannerName"]; 
	$bannerName = 'banner_'.$bannerName.".php";

	$text = "text..here..";

if ($bannerName) {
				
		$SQL = "SELECT * FROM banners WHERE banners.name='".$bannerName."'";

		$result = mysql_query($SQL);

			if (!mysql_fetch_assoc($result)) 
			{
				$sql = "INSERT INTO banners VALUES ('', '{$bannerName}', '{$text}', '')";
				if (!mysql_query($sql)) {
								die('Sorry. Error at saving data! Please try again later!');
							} 
						else 
							{	header( 'Location: ./admin.php#bannerslider' ) ;	}
			}
			else
				{
				echo "Banner with this name already exists!";
				}
	
					
		}

?>