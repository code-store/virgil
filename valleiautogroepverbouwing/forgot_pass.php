<?php 
session_start();
if(isset($_SESSION['UserName'])) unset($_SESSION['UserName']);
if(isset($_SESSION['Deals_password'])) unset($_SESSION['Deals_password']);
session_destroy();
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

	<?php
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
        <form class="form" method="post" action="forgot_action.php" >
          <div class="user"><input name="myusername" id="myusername" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='username')this.value='';" value="username" /></div>
          <div class="password"><input name="myemail" id="myemail" type="text" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value=='e-mail address')this.value='';" value="e-mail address"  /></div>
          <div class="log-btn"><input name="" value="<?php echo $lang_array['Send me an other password']; ?>" type="submit" /></div>
          <div class="forget"><p style="color:white;"><?php echo $lang_array['You will receive a user and a generated pass in mail...']; ?></p></div>
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