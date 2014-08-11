<?php 

	ob_start();
	include('config.php');

	$widgetpageName = $_POST["widgetpageName"]; 
	$pageIdentificator = $_POST["pageIdentificator"]; 

	$content = "text..here..";
	
	
if ($widgetpageName && $pageIdentificator) {
				
		$SQL = "SELECT * FROM widgets_pages WHERE pageIdentificator='".$pageIdentificator."'";

		$result = mysql_query($SQL);

			if (!mysql_fetch_assoc($result)) 
			{
				$sql = "INSERT INTO widgets_pages VALUES ('', '1column', 30, 800, '{$pageIdentificator}', '{$widgetpageName}','')";
				if (!mysql_query($sql)) {
								die('Sorry. Error at saving data! Please try again later!');
							} 
						else 
							{	header( 'Location: ./admin.php#templates' ) ;	}
			}
			else
				{
				echo "Widget with this name already exists!";
				}
	
					
		}
	else {
		echo "Fill the inputs!";
	}

?>