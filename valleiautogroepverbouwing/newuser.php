<?php

	error_reporting(0);
	if (!isset($_SESSION)) {session_start();}
	if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) 
	{

	
	ob_start();
	include('config.php');
	
	
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
	
	
	if ($_POST['action'] == "newuser_actionke")
	{		
		if (!isset($_SESSION)) {session_start();}
			
		if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) 
		{
			$newusername = $_POST['newusername'];
			$newpassword = $_POST['newpassword'];
			$newpassword2 = $_POST['newpassword2'];
			$newemail = $_POST['newemail'];
			
			// To protect MySQL injection (more detail about MySQL injection )
			$newusername = stripslashes($newusername);
			$newpassword = stripslashes($newpassword);
			$newpassword2 = stripslashes($newpassword2);
			$newemail = stripslashes($newemail);
			
			$newusername = mysql_real_escape_string($newusername);
			$newpassword = mysql_real_escape_string($newpassword);
			$newpassword2 = mysql_real_escape_string($newpassword2);
			$newemail = mysql_real_escape_string($newemail);
			
			if ($newusername == "" || $newpassword == "" || $newpassword2 == "" || $newemail == "")
			{
				?>
					<!-- SOMETHING REMAINED BLANK ---------------------------------------------------------->
					<div class="login-inner-edit" style="width:400px;">
						<div class="login">
							<form class="form" style="width:319px;">
								<p style="color:white;"><?php echo $lang_array['Something remained blank!']; ?> </p>
								<br/>
								<div class="log-btn"><a style="color:white; float:right;" href="./newuser.php"> <?php echo $lang_array['BACK'] ?> </a></div>
								
							</form>
						</div>
					</div>
				<?php
			}
			else{
					// Encrypt the password. ( md5 it )
					$newpassword = md5($newpassword); // our password is now encrypted. 
					$newpassword2 = md5($newpassword2); // our password is now encrypted. 
			
					if ($newpassword != $newpassword2)
					{
						?>
						<!-- NEW PASSWORD INCOHERENT ( NEW != CONFIRM ) ---------------------------------------------------------->
						<div class="login-inner-edit" style="width:400px;">
							<div class="login">
								<form class="form" style="width:319px;">
									<p style="color:white;"> <?php echo $lang_array['The passwords are different!'] ?> </p>
									<br/>
									<div class="log-btn"><a style="color:white; float:right;" href="./newuser.php"> <?php echo $lang_array['BACK'] ?> </a></div>
									
								</form>
							</div>
						</div>
						<?php
					}
					else
					{
						$sql = "SELECT * FROM admin WHERE admin.username = '".$newusername."' OR email='".$newemail."'";
						$result = mysql_query($sql);

						$k=0;
						while($row = mysql_fetch_array($result)){
							$k++;
						  }
						
						if ($k > 0) 
							{		
								?>
								<!-- USER or PASSWORD or E-MAIL ALREADY EXISTS ---------------------------------------------------------->
								<div class="login-inner-edit" style="width:400px;">
									<div class="login">
										<form class="form" style="width:319px;">
											<p style="color:white;"><?php echo $lang_array['User or E-mail already exists!']; ?> </p>
											<br/>
											<div class="log-btn"><a style="color:white; float:right;" href="./newuser.php"> <?php echo $lang_array['BACK'] ?> </a></div>
										</form>
									</div>
								</div>
								<?php
							}
							else 
								{
								$sql = "INSERT INTO admin (username, password, email) VALUES('".$newusername."', '".$newpassword."', '".$newemail."' )";
								$flag = mysql_query($sql) or die(mysql_error());  
								
								if ($flag){
									?>
									<!-- INSERT NEW USER INTO THE DATABASE ---------------------------------------------------------->
										<div class="login-inner-edit" style="width:400px;">
											<div class="login">
												<form class="form" style="width:319px;">
													<p style="color:white;"> <?php echo $lang_array['New user added with success!']; ?> </p>
													<br/>
													<div class="log-btn"><a style="color:white; float:right;" href="./admin.php"> <?php echo $lang_array['BACK TO THE ADMIN']; ?> </a></div>
												</form>
											</div>
										</div>
									<?php
									}
								}
					}
				
				}
		}
		else { header("location:login.php"); }
	}
	
	else	
		{
			?>
			
			<!-- SHOWING THE FORM (new user) ---------------------------------------------------------->
			
					<div class="login-inner">
					  <div class="login">
						<div class="log-title"></div>
						<form class="form" method="post" action="newuser.php" >
							<input type="hidden" value="newuser_actionke" id="action" name="action"/>
							
							<div class="user" style="margin: 0 0 14px;" ><input name="newusername" alt="User Name" title="User Name" id="newusername" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='user')this.value='';" value="user" /></div>
							<div class="password" style="margin: 0 0 14px;" ><input name="newpassword" alt="Password" title="Password" id="newpassword" type="password" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='pass1')this.value='';" value="pass1"  /></div>
							<div class="password" style="margin: 0 0 14px;" ><input name="newpassword2" alt="Password Cofirmation" title="Password Cofirmation" id="newpassword2" type="password" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='pass2')this.value='';" value="pass2"  /></div>
							<div class="user" style="margin: 0 0 14px;" ><input name="newemail" alt="E-mail" title="E-mail" id="newemail" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='email')this.value='';" value="email"  /></div>
							<div class="log-btn" style="margin-top:30px;"><input name="" value="Submit" type="submit" /></div>
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
		    <div class="footer"><p>&copy; <?php echo $lang_array['all right reserved by Facebook Shopper']; ?></p></div>
		  </div>
		</div>
		</body>
		</html>
	  
	  
	<?php
	}
	  
	  
	  
else {
		//$html = file_get_contents('./login.php');
		//print_r($html);
		header("location:login.php");
		}
?>