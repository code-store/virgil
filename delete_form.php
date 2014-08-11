<?php 

	ob_start();
    error_reporting(0);
	session_start();
	if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) {
    include 'config.php';
    

			if($_GET['form_id']!='')
			{
				//echo $_GET['form_id'];
				$delete_form_id = $_GET['form_id'];
				$sql = "delete from `form_field_option` where `form_id`='".$delete_form_id."'";
				$result = mysql_query($sql);
				$sql = "delete from `form_fieldsets` where `form_id`='".$delete_form_id."'";
				$result = mysql_query($sql);
				$sql = "delete from `form_fields` where `form_id`='".$delete_form_id."'";
				$result = mysql_query($sql);
				$sql = "delete from `form_data` where `form_id`='".$delete_form_id."'";
				$result = mysql_query($sql);
				$sql = "delete from `forms` where `form_id`='".$delete_form_id."'";
				$result = mysql_query($sql);
				
				header('Location: admin.php#mail-forms');
			}


       }else {
		$html = file_get_contents('./login.php');
		print_r($html);
		header("location:login.php");
	   }

?>