<?php

ob_start();
include('config.php');


// username and password sent from form 
$myusername=$_POST['myusername']; 
$myemail=$_POST['myemail'];



// To protect MySQL injection (more detail about MySQL injection )
$myusername = stripslashes($myusername);
$myemail = stripslashes($myemail);
$myusername = mysql_real_escape_string($myusername);
$myemail = mysql_real_escape_string($myemail);


$sql="SELECT * FROM admin WHERE username='".$myusername."' and email='".$myemail."'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row



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
	

if($count==1){
		
		
	$length = 8;	

	$code = md5(uniqid(rand(), true));
	if ($length != "") $random = substr($code, 0, $length);
	else $random = $code;
	
	// Encrypt the password. ( md5 it )
	$random1 = md5($random); // our password is now encrypted. 
	
	$sql="UPDATE admin SET password='".$random1."' WHERE username='".$myusername."' and email='".$myemail."'";
	if (!mysql_query($sql)) { die('Sorry. Error at saving data! Please try again later!'); }
	
	
	
	$to      = $myemail;
	$subject = 'Forgotten Password - MegaDeals Application';
	$message = 'User: '.$myusername." \n Pass: ".$random;
	$headers = 'From: webmaster@example.com' . "\r\n" .
	    'Reply-To: webmaster@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	
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
					<p style="color:white;"><?php echo $lang_array['Mail Sent! Try again to login when you have received it!']; ?></p>
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

else {
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
					<p style="color:white;"><b> <?php echo $lang_array['Attention!']; ?> </b></p><br/><br/>
					<p style="color:white;"> <?php echo $lang_array['Wrong']; ?> <b><?php echo $lang_array['Username - Email Address']; ?></b> <?php echo $lang_array['combination. Does not exist in our database!']; ?></p>
					<br/>
					<div class="log-btn"><a style="color:white; float:right;" href="./forgot_pass.php"><?php echo $lang_array['BACK']; ?></a></div>
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