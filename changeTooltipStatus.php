<?php 

	include('config.php');
	$tooltip_status = $_POST['the_tooltip_status'];
	
	
	if ($tooltip_status != ''){
	
		if ($tooltip_status == "is_on"){
			//-----------------------------------------------------------------------------------//
			//-------------------------------TURN OFF--------------------------------------------//
			$sql = "UPDATE webpages_settings SET tooltip_status=0 WHERE id=1";

			if (!mysql_query($sql)) 
				{
				die('Sorry. Error at saving data! Please try again later!');
					}	 
			else {}
		}
		else
			{
			//--------------------------------------------------------------------------------------//
			//---------------------------------TURN ON----------------------------------------------//
				$sql = "UPDATE webpages_settings SET tooltip_status=1 WHERE id=1";

				if (!mysql_query($sql)) 
					{
					die('Sorry. Error at saving data! Please try again later!');
						}	 
				else {}
			}
		
		header( 'Location: ./admin.php#tooltips' ) ;
	}
	else{
		header( 'Location: ./login.php' ) ;
	}
	
?>