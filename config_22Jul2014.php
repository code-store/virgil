<?php
$dbhost = 'localhost';
$dbuser = '123website_sit10';
$dbpass = 'gd1Aamiv';

$con = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');

$dbname = '123website_sit10';
mysql_select_db($dbname);

$Site_Url = 'http://123website-online.nl/templates/design-11/';
?>