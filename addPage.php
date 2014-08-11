<?php 

include('config.php');

$filename = $_POST["fileName"]; 

$text = "text..here..";

if ($filename) {
				
		$SQL = "SELECT * FROM webpages WHERE webpages.file='".$filename."'";

		$result = mysql_query($SQL);

			if (!mysql_fetch_assoc($result)) 
			{
				//================================== id === name ===== content = metas (3) = ishome = urlinput = template = language //
				$sql = "INSERT INTO webpages VALUES ('', '{$filename}', '{$text}', '', '', '', 0, '', '', '')";
				if (!mysql_query($sql)) {
								die('Sorry. Error at saving data! Please try again later!');
							} 
						else 
							{ header( 'Location: ./admin.php#pages' );	}
			}
			else
				{
				echo "Page with this name already exists!";
				}
	
					
		}

?>