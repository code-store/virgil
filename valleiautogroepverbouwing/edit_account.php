<?php

	error_reporting(0);
	if (!isset($_SESSION)) {session_start();}
	if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) 
	{

	
	ob_start();
	include('config.php');
	ob_start();
	
	
	$lang = $_GET["lang"];
	
	if ($lang == 'de') {$locale="locale/de_DE.csv";}
	if (($lang == 'nl') || ($lang == '')) {$locale="locale/nl_NL.csv";}  
	if ($lang == 'en') {$locale="locale/en_EN.csv";} 


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
		  <div class="login-outer-edit" style='background: url("./images/login-bg.png") repeat-x scroll 0 0 transparent;'>
		    
	
	
	<?php
	
	
	if ($_POST['action'] == "edit_action")
	{
		
		$old_user = $_POST['myusername'];
		$old_pass = $_POST['mypassword'];
		
		// To protect MySQL injection (more detail about MySQL injection )
		$old_user = stripslashes($old_user);
		$old_pass = stripslashes($old_pass);
		$old_user = mysql_real_escape_string($old_user);
		$old_pass = mysql_real_escape_string($old_pass);
		
		
		$sql="SELECT * FROM admin WHERE username='".$old_user."' and password='".$old_pass."'";
		$result=mysql_query($sql);
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		// If result matched $myusername and $mypassword, table row must be 1 row

		if(($count==1) && ($_SESSION['UserName'] == $old_user) && ($_SESSION['Deals_password'] == $old_pass)){
			
			$new_user = $_POST['myusername_new'];
			$new_pass = $_POST['mypassword_new'];
			$conf_pass = $_POST['mypassword_confirm'];
			$new_email = $_POST['myemail_new'];
			
			// To protect MySQL injection (more detail about MySQL injection )
			$new_user = stripslashes($new_user);
			$new_pass = stripslashes($new_pass);
			$conf_pass = stripslashes($conf_pass);
			$new_email = stripslashes($new_email);
			
			$new_user = mysql_real_escape_string($new_user);
			$new_pass = mysql_real_escape_string($new_pass);
			$conf_pass = mysql_real_escape_string($conf_pass);
			$new_email = mysql_real_escape_string($new_email);
			
			// Encrypt the password. ( md5 it )
			$new_pass = md5($new_pass); // our password is now encrypted. 
			$conf_pass = md5($conf_pass); // our password is now encrypted. 
			
			while ($db_field = mysql_fetch_assoc($result)) 
				{
				$admin_id = $db_field["AdminID"];
				}
			
			if ($new_pass == $conf_pass)
				{
			
					$sql = "UPDATE admin SET admin.username = '".$new_user."', admin.password='".$new_pass."', email='".$new_email."' WHERE admin.AdminID = ".$admin_id;
					if (!mysql_query($sql)) { die('Sorry. Error at saving data! Please try again later!'); }
				
					
					$_SESSION['UserName'] = $new_user;
					$_SESSION['Deals_password'] = $new_pass;
				
				
					?>
					
						<!-- NEW PASSWORD COHERENT ( NEW == CONFIRM ) ---------------------------------------------------------->
						<div class="login-inner-edit" style="width:400px;">
							<div class="login">
								<form class="form" style="width:319px;">
									<p style="color:white;"> <?php echo $lang_array['Your account was updated!'] ?> </p>
									<br/>
									<div class="log-btn"><a style="color:white; float:right;" href="./edit_account.php"> <?php echo $lang_array['BACK'] ?> </a></div>
									
								</form>
							</div>
						</div>
						
						<?php
			
				}
			
			else	
				{
					?>
				
					<!-- NEW PASSWORD INCOHERENT ( NEW != CONFIRM ) ---------------------------------------------------------->
					<div class="login-inner-edit" style="width:400px;">
						<div class="login">
							<form class="form" style="width:319px;">
								<p style="color:white;"> <?php echo $lang_array['The passwords are different!'] ?> </p>
								<br/>
								<div class="log-btn"><a style="color:white; float:right;" href="./edit_account.php"> <?php echo $lang_array['BACK'] ?> </a></div>
								
							</form>
						</div>
					</div>
					
					<?php
				}
			
			
		}
		
		else{
			?>
			
			<!-- BAD USER OR PASSWORD INTRODUCED ---------------------------------------------------------->
			<div class="login-inner-edit" style="width:400px;">
				<div class="login">
					<form class="form" style="width:319px;">
						<p style="color:white;"> <?php echo $lang_array['Bad USER or PASSWORD introduced!'] ?></p>
						<br/>
						<div class="log-btn"><a style="color:white; float:right;" href="./edit_account.php"> <?php echo $lang_array['BACK'] ?> </a></div>
						
					</form>
				</div>
			</div>
			
			<?php
			
		}
	}
	
	else	
		{
			
			$sql="SELECT * FROM admin WHERE username='".$_SESSION['UserName']."' and password='".$_SESSION['Deals_password']."'";
			$result=mysql_query($sql);
			
			while ($db_field = mysql_fetch_assoc($result)) 
				{
				$admin_id = $db_field["AdminID"];
				$email = $db_field["email"];
				}
			?>
			
			<!-- SHOWING THE FORM ---------------------------------------------------------->
			
			<div class="login-inner-edit" style="width:800px;">
			<div class="login">
			<form class="form" method="post" action="edit_account.php" >
			
				<input type="hidden" value="edit_action" id="action" name="action"/>
			
				<table style="border:0px;">
				<tr>
				<td>
				  <div class="forget"><p style="color: white; font-size: 20px; font-weight: bold; margin-bottom: 20px;"><?php echo $lang_array['EDIT ACCOUNT INFORMATION:']; ?></p></div>
				  <div class="user" ><input name="myusername" id="myusername" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='old username')this.value='';" value="<?php echo $_SESSION['UserName']; ?>" title="old username" alt="old username" Readonly /></div>
				  <div class="password" ><input name="mypassword" id="mypassword" type="password" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='old password')this.value='';" value="<?php echo $_SESSION['Deals_password']; ?>" title="old password" alt="old password" Readonly /></div>
				  <div class="backto_admin">
					<a href = "./deals_admin.php">
						<img src="./images/backa.png" alt="BACK to the Admin" title="BACK to the Admin" />
					</a>
				  </div>
				</td>
				<td style="padding-left:40px;">
				   <div class="user" ><input name="myusername_new" id="myusername_new" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='new username')this.value='';" value="new username" title="New username" alt="New username" /></div>
				   <div class="password"><input name="mypassword_new" id="mypassword_new" type="password" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='new password')this.value='';" value="new password" title="New password" alt="New password" /></div>
				   <div class="password"><input name="mypassword_confirm" id="mypassword_confirm" type="password" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='password confirmation')this.value='';" value="password confirmation" title="Confirm new password" alt="Confirm new password" /></div>
				   <div class="user"><input name="myemail_new" id="myemail_new" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='new e-mail address')this.value='';" value="<?php echo $email; ?>" title="Edit e-mail address" alt="New e-mail address" /></div>
				  
				  <div class="log-btn" style="padding-top:30px;"><input name="" value="<?php echo $lang_array['Update']; ?>" type="submit" /></div>
				</td>
				</tr>
				</table>
			
			</form>
			</div>
			</div>

		<?php 
		}

	?>
	  
	  
		   
		  </div>
		  <div class="push"></div>
		</div>
		<div class="footer-outer" style="margin-top:100px;">
		  <div class="footer-inner">
		    <div class="footer"><p>&copy; all right reserved by Facebook Shopper</p></div>
		  </div>
		</div>
		</body>
		</html>
	  
	  
	<?php
	}
	  
	  
	  
else {
		$html = file_get_contents('./login.php');
		print_r($html);
		//header("location:login.php");
		}
?>