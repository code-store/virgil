<?php

	include_once('config.php');
echo 'i am index';
	$sql = "SELECT * FROM webpages WHERE is_home=1";

	$result = mysql_query($sql);

	

	while ($db_field = mysql_fetch_assoc($result)) {

		$page = $db_field['urlinput'];

	}

		

	if (isset($page) && $page != ''){

		$page = str_replace(".php", ".html", $page);

		header( 'Location: ./'.$page ) ;

	}

        else{
            
            echo "<h2>Error in database";
            exit();
            
        } 
            

	

?>