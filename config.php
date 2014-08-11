<?php
 
if($_SERVER["HTTP_HOST"]=='localhost'){
    
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'vallei_auto';
	echo "<br>".$Site_Url = 'http://localhost/valleiautogroepverbouwing/';
}
else{
    $dbhost = 'localhost';
    $dbuser = 'vallei_auto';
    $dbpass = 'j3rMJkJ5';
    $dbname = 'vallei_auto';
	
	$Site_Url = 'http://www.valleiautogroepverbouwing.nl/';
}


$con = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');


mysql_select_db($dbname);


?>