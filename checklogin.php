<?php

	ob_start();
	include('config.php');


// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];



// To protect MySQL injection (more detail about MySQL injection )
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

// Encrypt the password. ( md5 it )
$mypassword = md5($mypassword); // our password is now encrypted. 

$sql="SELECT * FROM admin WHERE username='".$myusername."' and password='".$mypassword."'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

session_start();  
if(isset($_SESSION['UserName']))
    $_SESSION['UserName'] = $myusername;
else
    $_SESSION['UserName'] = $myusername;

	if(isset($_SESSION['Deals_password']))
    $_SESSION['Deals_password'] = $mypassword;
else
    $_SESSION['Deals_password'] = $mypassword;


header("location:admin.php");
}

else {

		$lang = 'nl';

		if ($lang == 'en') {$locale="locale/en_EN.csv";}  
		if (($lang == 'nl') || ($lang == '')) {$locale="locale/nl_NL.csv";} 


		$res = file_get_contents($locale);
		$res = explode("\n", $res);

		$lang_array = array();

		foreach ($res as $word)
		{
			$words = explode("| ", $word);
				
			$lang_array[$words[0]] = $words[1];
		}

		?>
		
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
				
				<title>Facebook Shopper</title>
				
				<link href="css/style.css" rel="stylesheet" type="text/css" />
				<link href="css/login.css" rel="stylesheet" type="text/css" />
				<link rel="stylesheet" href="css/widgets.css"/>
				<link rel="stylesheet" href="./css/style.css"/>
				
				<script src="js/ajaxScripts.js"></script>
			<head>	


			<body>
			<div class="wrapper">
			  <div class="header-main">
			    <div class="header">
			      <div class="logo"><a href="#url" title="Facebook Shopper">Facebook Shopper</a></div>
			    </div>
			  </div>
			  <div class="login-outer">
			    <div class="login-inner">
			      <div class="login">
				<div class="log-title"><img src="images/login-form.png" alt="" /></div>
				<form class="form">
					<p style="color:white;"> <?php echo $lang_array['Login unsuccessfull! Please retry!']; ?></p>
					<br/>
					<div class="log-btn"><a style="color:white; float:right;" href="./login.php"> <?php echo $lang_array['BACK']; ?> </a></div>
				</form>
			      </div>
			    </div>
			  </div>
			  <div class="push"></div>
			</div>
			<div class="footer-outer">
			  <div class="footer-inner">
			    <div class="footer"><p>&copy; <?php echo $lang_array['all right reserved by Facebook Shopper']; ?></p></div>
			  </div>
			</div>
			</body>
			</html>
			
		<?php
		}
?>