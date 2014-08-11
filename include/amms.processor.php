<?php

if (isset($_POST['task'])){
    $task = $_POST['task'];  
}else{
    $task = "";
}


if ($task == "add_menu") {
	include("amms.class.php");
	$amms 		= new amms;
	$name 		= $_POST['n'];
	$safe_name 	= $_POST['s'];
	$res 		= $amms->add_menu($name, $safe_name);
	echo $res;
	
	
	
} else if ($task == "save_menu") {
	include("amms.class.php");
	$amms 		= new amms;
	$menu 		= $_POST['menu'];
	$serialized = $_POST['s'];
	$newname 	= $_POST['nn'];
	$newsname 	= $_POST['nsn'];
	$res 		= $amms->save_menu($menu, $serialized, $newname, $newsname);
	echo $res;
	
	
	
} else if ($task == "rem_menu") {
	include("amms.class.php");
	$amms 		= new amms;
	$menu 		= $_POST['menu'];
	
	$res 		= $amms->rem_menu($menu);
	echo $res;
	
	
	
}




?>