<?php 

ob_start();
//Make sure you put your keys here
$publickey = '6LdZmOcSAAAAAJFSB1RDDKvH_9AmV1I067Sw7DgI';
$privatekey = '6LdZmOcSAAAAAKYgO6AFU_ks325wtnv4TxodSvEL';
//$toEmail = '';
include 'recaptchalib.php';
include('config.php'); 



//----------------- GETTING THE LANGUAGE SETTINGS -------------------------------//
		$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
		$result2 = mysql_query($SQL2);
		
		$res2 = mysql_fetch_assoc($result2); 
		$frontend_languages = $res2['frontend_languages'];
		$default_language = $res2['default_language'];
		
		$frontend_languages = explode("|", $frontend_languages);
	
			
	
		$lang = $_GET['lang'];
		
		if ($_GET['lang']) { $_SESSION['siteLanguage123'] = $_GET['lang']; }
		
		if ($lang == ""){
			if(isset($_SESSION['siteLanguage123'])){
					$lang = $_SESSION['siteLanguage123'];
				}
			else {
					$lang = $default_language;
				}
		}

		$locale = "./locale/".strtolower($lang)."_".strtoupper($lang).".csv";

		$res = file_get_contents($locale);
		$res = explode("\n", $res);

		$lang_array = array();

			foreach ($res as $word)
			{
				$words = explode("| ", $word);
					
				$lang_array[$words[0]] = $words[1];
			}
	
//----------------- GETTING THE LANGUAGE SETTINGS -------------------------------//




	$theFormID = $_REQUEST['url'];

	$findme   = '_fullpage';
	$pos = strpos($theFormID, $findme);
		
		
				?>

				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<link rel="stylesheet" type="text/css" href="css/style.css"/>
					<script src="js/jquery-1.7.1.js"></script>
					<script src="js/css_browser_selector.js"></script>
					<!-- ============ JAVASCRIPT SECTION =========================== --> 

						
					<script type="text/javascript">
					function testform(){
										flag=0;
										$('.required').each(function(){
											var value=$.trim($(this).val());
											var name=$.trim($(this).attr('name'));
											var type=$.trim($(this).attr('type'));
											if(value == '')
											{
												alert('Insert '+$(this).parent().prev('label').attr('title'));
												$(this).focus();
												$(this).css('border','1px solid red');
												flag=1;
												return false;
											}
											else if(type=='checkbox')
											{
											   var checkbox = document.getElementsByName(name);
											   var formValid = false;
											   var i = 0;
												while (!formValid && i < checkbox.length) {
													if (checkbox[i].checked) formValid = true;
													i++;        
												}
												 if (!formValid) { 
												 alert("Must check Checkbox option!"); 
												 flag=1; 
												 return false; }
											}
											else if(type=='radio')
											{
											   var radios = document.getElementsByName(name);
											   var formValid = false;
											   var i = 0;
												while (!formValid && i < radios.length) {
													if (radios[i].checked) formValid = true;
													i++;        
												}
												 if (!formValid) { 
												 alert("Must check Radio option!"); 
												 flag=1; 
												 return false; }
											}
											else
											{
												$(this).css('border','1px solid #BBAFA0');
											}
										});

										if(flag==0)
										{
											$('.requiredemail').each(function(){
											var value=$.trim($(this).val());
											if(value=='')
											{
												alert('Insert email address');
												$(this).focus();
												$(this).css('border','1px solid red');
												flag=1;
												return false;
											}
											else if(!validateEmail(value))
											{
												alert('Invalid email address');
												$(this).focus();
												$(this).css('border','1px solid red');
												flag=1;
												return false;
											}
											else
											{
												$(this).css('border','1px solid #BBAFA0');
											}
										});
										}
								if(flag == 0)
									return true;
								else
									return false;
								}
					function validateEmail($email) {
							  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							  if( !emailReg.test( $email ) ) {
								return false;
							  } else {
								return true;
							  }
							}
					</script>
					<!-- ============ JAVASCRIPT SECTION =========================== --> 

				<!--Css for in iframe-->
				<style type="text/css">
				body{ background-image:none !important; }
				.fieldset .legend{ display:none; }
				#theContent{ margin:0; }
				#theContent{ color: #585858; font: 12px/18px Arial,Helvetica,sans-serif !important; margin: 0; padding: 0 0 10px; }
				.fieldset{ background:none !important; border:none !important; padding:0 !important; margin:0 !important; }
				.form-list{ float:left; padding:0; }
				.form-list li.fields .field{ width:100% !important; margin:4px 0 !important; }
				.form-list li.fields .field label{  }
				.form-list li.fields .field .input-box{ width:100%; }
				.form-list li.fields .field input[type="text"]{width:53%; height:30px; border:1px solid #e4e4e4; padding:3px; font:12px Arial, Helvetica, sans-serif; color:#585858; background:#fff; box-shadow:none; margin:0 !important; }
				.form-list li.fields .field textarea{width:63%; height:70px; border:1px solid #e4e4e4; padding:3px; font:12px Arial, Helvetica, sans-serif; color:#585858; background:#fff; box-shadow:none; margin:0 !important; }
				.form-list li.fields .field select{width:70%; height:38px; border:1px solid #e4e4e4; padding:9px 6px; font:12px Arial, Helvetica, sans-serif; color:#585858; background:#fff; box-shadow:none; margin:0 !important; }
				.form-list li.fields .field .check{ width:71%; }
				.log-btn input[type="submit"]{float:left; width:107px; padding:0px; margin:0 0 5px 6px; height:42px; border:0px; color:#fff; font:20px 'MyriadProBoldCondensed'; text-align:center; text-transform:uppercase; background:url(images/form-btm.png) 0 0 no-repeat; cursor:pointer;}
				.log-btn input[type="submit"]:hover{ background-position:0 -42px; }
				.formDescription h2 { color: #005DB9; font: 30px 'MyriadProBoldCondensed'; margin: 0; padding: 0 0 5px;}
				.formDescription p{ margin:0 0 10px 0;}

				.ie7 .form-list {width:244px !important;}
				.ie8 .form-list {width:244px !important;}
				.ie9 .form-list {width:244px !important;}
				.ie7 .form-list li.fields .field input[type="text"] {width:94%;}
				.ie8 .form-list li.fields .field input[type="text"] {width:94%;}
				.ie9 .form-list li.fields .field input[type="text"] {width:94%;}
				.ie7 .form-list li.fields .field select {width:99%;}
				.ie8 .form-list li.fields .field select {width:99%;}
				.ie9 .form-list li.fields .field select {width:99%;}


				</style>
				<!--Css for in iframe-->
				
				

<?php			
if ($pos === false) {				
		
			// ============================ Is a sidebar form !!! ========================================//
				
				?>
				</head>

				<body>

					<ul class="product_list" id="theContent" style="padding:0px;">
					<?php
							$errors='';
							$sqlForm = "SELECT * FROM forms WHERE url='".$_REQUEST['url']."'";
							$resultForm = mysql_query($sqlForm) or die(mysql_error());
							$rowForm = mysql_fetch_array($resultForm);
							$formTitle =  $rowForm['name'];
							$formDescription = $rowForm['description'];
							$emailThis  = $rowForm['email_this'];
							$adminEmail  = $rowForm['mail_to'];
							$thankyou_url  = $rowForm['thankyou_url'];
							$thankyou_message  = $rowForm['thankyou_message'];
							$formId = $rowForm['form_id'];
							
							$MailField = array();
							$ArrFieldLabel = $ArrFieldName = $ArrFieldValue = array();
					?>
					<?php 
					 if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
					 {
						
						//Captcha Validation
						$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
						if (!$resp->is_valid) {
						 if ( $resp->error=='incorrect-captcha-sol' ) { $errors = 'The captcha you filled out did not match the image. Please try again.';}					
						} 
						
						if ( $errors=='' ){
							//print_r($_POST);
							$time = time(); 
							$index = 0;
							$sqlFieldsets = "SELECT * FROM form_fieldsets WHERE form_id='".$formId."' and status='1' order by position";
							$resultFieldsets = mysql_query($sqlFieldsets) or die(mysql_error());
							while($rowFieldsets = mysql_fetch_array($resultFieldsets))
							{
								$fieldsetName = $rowFieldsets['name'];						
								$sqlFields = "SELECT * FROM form_fields WHERE form_id='".$formId."' AND fieldset_id='".$rowFieldsets['fieldset_id']."' and status='1' order by position";
								$resultFields = mysql_query($sqlFields) or die(mysql_error());
								 while($rowFields = mysql_fetch_array($resultFields))
								 {
									 $value = '';
									 $fieldName = $rowFields['name'];
									 $fieldLabel = $rowFields['label'];
									 if($rowFields['type'] == 'checkbox')
									 {
										foreach($_POST[$fieldName] as $single)
										   $value .= $single.',';	
										
										$value  = substr($value,0,-1);  
									 }
									 else
										$value  = $_POST[$fieldName];
										
									$MailField[$fieldsetName][$fieldLabel] = $value;						
									
									$ArrFieldLabel[] = $fieldLabel;
									$ArrFieldName[] = $fieldName;
									$ArrFieldValue[] = $value;
									
									$sql = "INSERT INTO `form_data` (`form_id`,`fieldset_id`,`field_id`,`value`,`time`) VALUES('".$formId."','".$rowFieldsets['fieldset_id']."','".$rowFields['field_id']."','".addslashes($value)."','".$time."')";
									$result = mysql_query($sql) or die(mysql_error());							
								 }
								$index++; 
							}
							for($i=0;$i<count($ArrFieldName);$i++)
							{ 
							   if(strstr($ArrFieldName[$i], 'email'))
							   {
								  $UserEmailId = $ArrFieldValue[$i];
								  break;  
							   }
							}
							if($emailThis)
							{
							 $SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
							 $RESULT = mysql_query($SQL);
	
							 $res = mysql_fetch_assoc($RESULT);	
							 $mail_logo = $Site_Url.$res['header_img'];	
							 /***************Admin email********************/
							 $charset = 'MIME-Version: 1.0' . "\r\n";
							 $charset .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							 $charset .= 'From: <'.$UserEmailId.'>' . "\r\n";				
							
							 $to      = $adminEmail;
							 $subject = 'New entry on Form: '.$formTitle;
							 $message = '';
							 $message .= '<div style="background-color:#f6f6f6; padding:24px 40px;"><div style="background-color:#ffffff; border:1px solid #e0e0e0; padding:10px;">';
							 $message .= '<div align="left"><img src="'.$mail_logo.'" alt="" /></div>';
							 $message .= '<div align="center"><b><u style="font:normal 25px Arial, Helvetica, sans-serif;">'.$formTitle.'</u></b></div><br>';
							 $message .= 'Date: '.date('d-m-Y h:i:s',time()).'<br><br>';
							 foreach($MailField as $key=>$value)
							 {
								 $message .='<b><u style="font:bold 20px Arial, Helvetica, sans-serif;">'.$key.'</u></b><br><br>';
								 foreach($value as $key2=>$value2)
								 {
								   $message .='<b>'.$key2.'</b>:<br>'.$value2.'<br><br>';				  
								 }
							 }
							 $message .= '</div><div>';
							 //echo $message; echo '<br><br>';
							  mail( $to, $subject, $message,$charset ); 
							/**********************************************/
							
							/***************User email*********************/
							 $charset = 'MIME-Version: 1.0' . "\r\n";
							 $charset .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							 $charset .= 'From: <'.$adminEmail.'>' . "\r\n";
							 
							 $to      = $UserEmailId;
							 $subject = $lang_array['Details of Submit Form:']." ".$formTitle;
							 $message = '';
							 $message .= '<div style="background-color:#f6f6f6; padding:24px 40px;"><div style="background-color:#ffffff; border:1px solid #e0e0e0; padding:10px;">';
							 $message .= '<div align="left"><img src="'.$mail_logo.'" alt="" /></div>';
							 $message .= '<div align="center"><b><u style="font:normal 25px Arial, Helvetica, sans-serif;">'.$formTitle.'</u></b></div><br>';
							 $message .= '<div align="center"><b>'.$thankyou_message.'</b></div><br>';
							 $message .= $lang_array['Date'].': '.date('d-m-Y h:i:s',time()).'<br><br>';
							 foreach($MailField as $key=>$value)
							 {
								 $message .='<b><u style="font:bold 20px Arial, Helvetica, sans-serif;">'.$key.'</u></b><br><br>';
								 foreach($value as $key2=>$value2)
								 {
								   $message .='<b>'.$key2.'</b>:<br>'.$value2.'<br><br>';				  
								 }
							 }
							 $message .= '</div><div>';
							 //echo $message; echo '<br><br>';
							   mail( $to, $subject, $message,$charset );
								?>
							 <script>window.parent.location = "<?php echo $Site_Url.$thankyou_url;?>"</script>
							 <?php
									echo '<span style="background:#A50203; padding:10px; color:white; width:100%; float:left;">'.$lang_array['Thank you for contacting us. We will get back to you shortly.'].'</span>';
							/**********************************************/				
							//print_r($MailFieldLabel);	   
							}
						}
					 }
					?>
					
					<form method="post" action="" onsubmit="return testform();">
                    <?php 
						   if ( $errors!='' ) {?>
							   <?php echo '<span style="background:#A50203; padding:10px; color:white; width:100%; float:left;">'.$errors.'</span>';?>
						   <?php }?>
						<div>
						   <?php
							$sqlFieldsets = "SELECT * FROM form_fieldsets WHERE form_id='".$formId."' AND status='1' order by position";
							$resultFieldsets = mysql_query($sqlFieldsets) or die(mysql_error());
							 while($rowFieldsets = mysql_fetch_array($resultFieldsets))
							 {
						   ?>
								<fieldset class="fieldset">
									<legend class="legend"><?php echo $rowFieldsets['name']; ?></legend>
									<ul class="form-list">
										<li class="fields">
						   <?php
							$sqlFields = "SELECT * FROM form_fields WHERE form_id='".$formId."' AND fieldset_id='".$rowFieldsets['fieldset_id']."' AND status='1' order by position";
							$resultFields = mysql_query($sqlFields) or die(mysql_error());
							 while($rowFields = mysql_fetch_array($resultFields))
							 {
						   ?>
											<div class="field">
												<label for="<?php echo $rowFields['type']."-".$rowFields['field_id']; ?>" title="<?php echo $rowFields['label'] ?>"><?php echo $rowFields['label'] ?>:<?php if($rowFields['required']=='1'){?><em>*</em><?php } ?></label>
												<div class="input-box <?php if($rowFields['type']=='checkbox' || $rowFields['type']=='radio'){?>check<?php } ?>">
													<?php echo drawField($rowFields); ?>
												</div>
											</div>
					   <?php } ?>    
										</li>
									</ul>
								</fieldset>
						   <?php		 
							 }
						  ?>
                          <div class="field">
                                <label>Captcha:<em style="color:red;">*</em></label>
                                <div class="input-box">
                                    <?php if(isset($publickey)){ echo recaptcha_get_html($publickey,$error); } ?>
                                </div>
                            </div>
							<div class="log-btn" style="float:right;">
								<input type="submit" value="Submit" name="submit">
							</div>
						</div>
					   </form> 
					</ul>
								
					  
				</body>
				</html>


				<?php
					

					
	
} 

else {
		
		// ============================ Is a fullpage form !!! ========================================//

			?>
					<link type="text/css" href="./css/contact-custom.css"  rel="stylesheet"  />
					<link type="text/css" href="./css/jquery.bxslider.css" rel="stylesheet" />

					<script type="text/javascript" src="./js/jquery.bxslider.js"></script>
				
					<style type="text/css">
						.form-list {
							float: left;
							padding: 0;
							width: 100% !important;
						}
					</style>				
				
				
				</head>

				<body>

					<ul class="product_list" id="theContent" style="padding:0px;">
					<?php
							$errors='';
							$sqlForm = "SELECT * FROM forms WHERE url='".$_REQUEST['url']."'";
							$resultForm = mysql_query($sqlForm) or die(mysql_error());
							$rowForm = mysql_fetch_array($resultForm);
							$formTitle =  $rowForm['name'];
							$formDescription = $rowForm['description'];
							$emailThis  = $rowForm['email_this'];
							$adminEmail  = $rowForm['mail_to'];
							$thankyou_url  = $rowForm['thankyou_url'];
							$thankyou_message  = $rowForm['thankyou_message'];
							$formId = $rowForm['form_id'];
							
							$MailField = array();
							$ArrFieldLabel = $ArrFieldName = $ArrFieldValue = array();
					

						
					if(isset($_POST['submit']) && $_POST['submit'] == 'Aanvraag verzenden')
					{
						/*
						print_r($rowForm);
						echo "<br/>";
						print_r($_POST);
						echo "<br/>";
						echo "MAIL: ".$adminEmail;
						die();
						*/
						
						//Captcha Validation
						$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
						if (!$resp->is_valid) {
						 if ( $resp->error=='incorrect-captcha-sol' ) { $errors = 'The captcha you filled out did not match the image. Please try again.';}					
						}	
						
						if ( $errors=='' ) {
							$time = time(); 
							$index = 0;
							$sqlFieldsets = "SELECT * FROM form_fieldsets WHERE form_id='".$formId."' and status='1' order by position";
							$resultFieldsets = mysql_query($sqlFieldsets) or die(mysql_error());
							while($rowFieldsets = mysql_fetch_array($resultFieldsets))
							{
								$fieldsetName = $rowFieldsets['name'];						
								$sqlFields = "SELECT * FROM form_fields WHERE form_id='".$formId."' AND fieldset_id='".$rowFieldsets['fieldset_id']."' and status='1' order by position";
								$resultFields = mysql_query($sqlFields) or die(mysql_error());
								while($rowFields = mysql_fetch_array($resultFields))
								{
									$value = '';
									$fieldName = $rowFields['name'];
									$fieldLabel = $rowFields['label'];
									
									$fieldID = $rowFields['field_id'];
									
									if($rowFields['type'] == 'checkbox')
										{
											foreach($_POST[$fieldName] as $single)
											$value .= $single.',';	
										
											$value  = substr($value,0,-1);  
										}
									else {
										if ($rowFields['type'] == 'uploadRadio'){
											$optionID = $_POST['uploadRadio'.$fieldID];
											$value = "OptionID:".$optionID;
										}
										else{
											$value = $_POST[$fieldName];
										}
									}
										
									$MailField[$fieldsetName][$fieldLabel] = $value;						
									
									$ArrFieldLabel[] = $fieldLabel;
									$ArrFieldName[] = $fieldName;
									$ArrFieldValue[] = $value;
									
									$sql = "INSERT INTO `form_data` (`form_id`,`fieldset_id`,`field_id`,`value`,`time`) VALUES('".$formId."','".$rowFieldsets['fieldset_id']."','".$rowFields['field_id']."','".addslashes($value)."','".$time."')";
									$result = mysql_query($sql) or die(mysql_error());							
								 }
								$index++; 
							}
							for($i=0;$i<count($ArrFieldName);$i++)
							{ 
							   if ( (strstr($ArrFieldName[$i], 'email')) || (strstr($ArrFieldName[$i], 'e-mail')) )
								{
								  $UserEmailId = $ArrFieldValue[$i];
								  break;  
							   }
							}
							
								/// ================= GETTING THE LOGO =================================== ///
									$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
									$result2 = mysql_query($SQL2);
									
									$res2 = mysql_fetch_assoc($result2); 
									$comp_logo = $res2['header_img'];
									$mail_logo = $Site_Url.$comp_logo;	
								/// ================= GETTING THE LOGO =================================== ///
								
									$siteName = substr($Site_Url, 7, -1);
						
							if($emailThis)
							{
								 /***************Admin email********************/
								 $charset = 'MIME-Version: 1.0' . "\r\n";
								 $charset .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								 $charset .= 'From: <'.$UserEmailId.'>' . "\r\n";				
								
								 $to      = $adminEmail;
								 $subject = $formTitle." - ".$siteName;
								 $message = '';
								 $message .= '<div style="background-color:#f6f6f6; padding:24px 40px;"><div style="background-color:#ffffff; border:1px solid #e0e0e0; padding:10px;">';
								 $message .= '<div align="left"><img src="'.$mail_logo.'" alt="" style="max-width:100%;" /></div>';
								 $message .= '<div align="center"><b><u style="font:normal 25px Arial, Helvetica, sans-serif;">'.$formTitle.'</u></b></div><br>';
								 $message .= $lang_array['Date'].': '.date('d-m-Y h:i:s',time()).'<br><br>';
								 foreach($MailField as $key=>$value)
								 {
									$message .='<div style="width:90%; border-bottom:1px solid #aaa; padding:20px;">';
									$message .='<b><u style="font:bold 20px Arial, Helvetica, sans-serif;">'.$key.'</u></b><br><br>';
									foreach($value as $key2=>$value2)
									{							
										$pos = strpos($value2, 'ProductID:');
										$pos2 = strpos($value2, 'OptionID:');
										
										if (($pos === false) && ($pos2 === false)) {
											$message .='<b>'.$key2.'</b>:<br>'.$value2.'<br><br>';	
										} else {
											if ($pos !== false){
												$str = getProductDetails($value2, $Site_Url);
												$message .= $str;
											}
											if ($pos2 !== false){
												$str = getOptionDetails($value2, $Site_Url);
												$message .= $str;
											}
										}
									}
									$message .= '</div>';
								 }
								 $message .= '</div><div>';
								 //echo $message; echo '<br><br>';
								 mail( $to, $subject, $message,$charset ); 
								/**********************************************/
												
								
								/***************User email*********************/
								 $charset = 'MIME-Version: 1.0' . "\r\n";
								 $charset .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								 $charset .= 'From: <'.$adminEmail.'>' . "\r\n";
								 
								 $to      = $UserEmailId;
								 $subject = $formTitle." - ".$siteName;
								 $message = '';
								 $message .= '<div style="background-color:#f6f6f6; padding:24px 40px;"><div style="background-color:#ffffff; border:1px solid #e0e0e0; padding:10px;">';
								 $message .= '<div align="left"><img src="'.$mail_logo.'" alt="" style="max-width:100%;" /></div>';
								 $message .= '<div align="center"><b><u style="font:normal 25px Arial, Helvetica, sans-serif;">'.$formTitle.'</u></b></div><br>';
								 $message .= '<div align="center"><b>'.$lang_array['Thank you for contacting us. We will get back to you shortly.'].'</b></div><br>';
								 $message .= $lang_array['Date'].': '.date('d-m-Y h:i:s',time()).'<br><br>';
								 foreach($MailField as $key=>$value)
								 {
									$message .='<div style="width:90%; border-bottom:1px solid #aaa; padding:20px;">';
									$message .='<b><u style="font:bold 20px Arial, Helvetica, sans-serif;">'.$key.'</u></b><br><br>';
									foreach($value as $key2=>$value2)
									{							
										$pos = strpos($value2, 'ProductID:');
										$pos2 = strpos($value2, 'OptionID:');
										
										if (($pos === false) && ($pos2 === false)) {
											$message .='<b>'.$key2.'</b>:<br>'.$value2.'<br><br>';	
										} else {
											if ($pos !== false){
												$str = getProductDetails($value2, $Site_Url);
												$message .= $str;
											}
											if ($pos2 !== false){
												$str = getOptionDetails($value2, $Site_Url);
												$message .= $str;
											}
										}
									}
									$message .= '</div>';
									
								 }
								 $message .= '</div><div>';
								 //echo $message; echo '<br><br>';
								 if(mail( $to, $subject, $message,$charset ))
									echo '<span style="background:#A50203; padding:10px; color:white; width:100%; float:left;">'.$lang_array['Thank you for contacting us. We will get back to you shortly.'].'</span>';
								/**********************************************/				
								//print_r($MailFieldLabel);	   
							}
						}
					}
					?>
					
					<script type="text/javascript">
						function changeStep(step, allFieldsets)
						{
							for (var i=1;i<=allFieldsets;i++){ 
								var str = 'tabs-'.concat(i);
								document.getElementById(String(str)).style.display = "none";
							}
							
							var str = 'tabs-'.concat(step);
							document.getElementById(String(str)).style.display = "block";
						}
					</script> 
					
					<form method="post" action="" onsubmit="return testform();">
                    <?php 
						   if ( $errors!='' ) {?>
							   <?php echo '<span style="background:#A50203; padding:10px; color:white; width:100%; float:left;">'.$errors.'</span>';?>
						   <?php }?>
						<div>
						   
							<div>
								<h1><?php echo $formTitle; ?></h1>
								<p><?php echo $formDescription; ?></p>
						   </div>
						   
							<?php
						   
							$nrSteps = 0;
						   
							$sqlFieldsets = "SELECT * FROM form_fieldsets WHERE form_id='".$formId."' AND status='1' order by position";
							$resultFieldsets = mysql_query($sqlFieldsets) or die(mysql_error());
							$allFieldsets = mysql_num_rows($resultFieldsets);
							while($rowFieldsets = mysql_fetch_array($resultFieldsets))
							{
							$nrSteps++;
							if ($nrSteps == 1) { echo "<div id='tabs-".$nrSteps."' style='display:block;'>"; }
								else { echo "<div id='tabs-".$nrSteps."' style='display:none;'>"; }
							
								?>
								<!--<fieldset class="fieldset">-->
								<div class="fieldset">
									<legend class="legend"><?php echo $rowFieldsets['name']; ?></legend>
									<ul class="form-list">
										<li class="fields">
										   <?php
											$sqlFields = "SELECT * FROM form_fields WHERE form_id='".$formId."' AND fieldset_id='".$rowFieldsets['fieldset_id']."' AND status='1' order by position";
											$resultFields = mysql_query($sqlFields) or die(mysql_error());
											 while($rowFields = mysql_fetch_array($resultFields))
											 {
										   ?>
											<div class="field">
												<label for="<?php echo $rowFields['type']."-".$rowFields['field_id']; ?>" title="<?php echo $rowFields['label'] ?>"><?php echo $rowFields['label'] ?>:<?php if($rowFields['required']=='1'){?><em>*</em><?php } ?></label>
												<div class="input-box <?php if($rowFields['type']=='checkbox' || $rowFields['type']=='radio'){?>check<?php } ?>">
													<?php echo drawField2($rowFields); ?>
												</div>
											</div>
										<?php } ?> 
                                        <?php if (($allFieldsets > 1) && ($nrSteps == $allFieldsets)) { ?>
                                        <div class="field">
                                            <label>Captcha:<em>*</em></label>
                                            <div class="input-box">
                                                <?php if(isset($publickey)){ echo recaptcha_get_html($publickey,$error); } ?>
                                            </div>
                                        </div>
                                        <?php } ?>     
										</li>
									</ul>
									
									<div class="buttons">
										<p style="width:98%; margin:4px 0px; border-bottom:1px solid #aaa; float:left;"></p>
										
										<!-- ----------------------- Only 1 fieldset -------------------------------------- -->
											<?php if ($allFieldsets == 1) { ?> 
												<input type="submit" id="butt_send" name="submit" value="Aanvraag verzenden" style="float:right;"/>
											<?php } ?>
										
										<!-- ----------------------- First fieldset --------------------------------------- -->
											<?php if (($allFieldsets > 1) && ($nrSteps == 1)) { ?> 
												<input type="button" id="butt_next" name="butt" onclick="javascript:changeStep(<?php echo $nrSteps+1; ?>, <?php echo $allFieldsets; ?>);" value="Verder"/>
											<?php } ?>
											
										<!-- ----------------------- Last fieldset --------------------------------------- -->
											<?php if (($allFieldsets > 1) && ($nrSteps == $allFieldsets)) { ?>
												<input type="submit" id="butt_send" name="submit" value="Aanvraag verzenden" style="float:right;"/>
												<input type="button" id="butt_prev" name="butt" onclick="javascript:changeStep(<?php echo $nrSteps-1; ?>, <?php echo $allFieldsets; ?>);" value="Terug"/>
											<?php } ?>
										
										<!-- ----------------------- Intermediar fieldset --------------------------------------- -->
											<?php if (($allFieldsets > 1) && ($nrSteps > 1) && ($nrSteps < $allFieldsets)) { ?>
												<input type="button" id="butt_next" name="butt" onclick="javascript:changeStep(<?php echo $nrSteps+1; ?>, <?php echo $allFieldsets; ?>);" value="Verder"/>
												<input type="button" id="butt_prev" name="butt" onclick="javascript:changeStep(<?php echo $nrSteps-1; ?>, <?php echo $allFieldsets; ?>);" value="Terug"/>
											<?php } ?>
									</div>
									
								<!--</fieldset>-->
								</div>
								
								</div>
						   <?php		 
							 }
						  ?>
							<!--
							<div class="log-btn" style="float:right;">
								<input type="submit" value="Submit" name="submit">
							</div>
							-->
						</div>
					</form> 
					</ul>
								
					  
				</body>
				</html>
				<?php	

}





















/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////  FUNCTIONS  /////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	function drawField($rowFields)
		{
			//print_r($rowFields);
			//die('');
			$validationClass="";
			if($rowFields['required'] == '1')
				$validationClass="required";

			if($rowFields['email_validation'] == '1')
				$validationClass="requiredemail";

			$inputString='';
			switch($rowFields['type'])
			{
				case 'text':
						$inputString='<input type="text" name="'.$rowFields['name'].'" class="'.$validationClass.'" id="text-'.$rowFields['field_id'].'" />';
						break;
				case 'textarea':
						$inputString='<textarea name="'.$rowFields['name'].'" class="'.$validationClass.'" id="textarea-'.$rowFields['field_id'].'" rows="5" cols="80"></textarea>';
						break;		
				case 'select':
						$inputString='<select name="'.$rowFields['name'].'" class="'.$validationClass.'" id="select-'.$rowFields['field_id'].'">';
						$sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
						$resultOption = mysql_query($sqlOption) or die(mysql_error());
						$inputString .= '<option value="">--Please Select--</option>';
						while($rowOption=mysql_fetch_array($resultOption))
						{
							$inputString .='<option value="'.$rowOption['value'].'">'.$rowOption['label'].'</option>';
						}
						$inputString .='</select>';
						break;
				case 'checkbox':
						$sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
						$resultOption = mysql_query($sqlOption) or die(mysql_error());
						while($rowOption=mysql_fetch_array($resultOption))
						{
					$inputString .='<input type="checkbox" name="'.$rowFields['name'].'[]" class="'.$validationClass.'" value="'.$rowOption['value'].'"><span>'.$rowOption['label'].'</span>';
						}
						break; 
				case 'radio':
						$sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
						$resultOption = mysql_query($sqlOption) or die(mysql_error());
						while($rowOption=mysql_fetch_array($resultOption))
						{
						$inputString .='<input type="radio" name="'.$rowFields['name'].'" class="'.$validationClass.'" value="'.$rowOption['value'].'"><span>'.$rowOption['label'].'</span>';
						}
						break; 		  		
			}
			return $inputString;
		}


		
	function drawField2($rowFields)
	{
		//print_r($rowFields);
		//die('');
		$validationClass="";
		if($rowFields['required'] == '1')
			$validationClass="required";

		if($rowFields['email_validation'] == '1')
			$validationClass="requiredemail";

		$inputString='';
		switch($rowFields['type'])
		{
			case 'text':
					$inputString='<input type="text" name="'.$rowFields['name'].'" class="'.$validationClass.'" id="text-'.$rowFields['field_id'].'" />';
					break;
			case 'textarea':
					$inputString='<textarea name="'.$rowFields['name'].'" class="'.$validationClass.'" id="textarea-'.$rowFields['field_id'].'" rows="5" cols="80"></textarea>';
					break;		
			case 'select':
					$inputString='<select name="'.$rowFields['name'].'" class="'.$validationClass.'" id="select-'.$rowFields['field_id'].'">';
					$sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
					$resultOption = mysql_query($sqlOption) or die(mysql_error());
					$inputString .= '<option value="">--Please Select--</option>';
					while($rowOption=mysql_fetch_array($resultOption))
					{
						$inputString .='<option value="'.$rowOption['value'].'">'.$rowOption['label'].'</option>';
					}
					$inputString .='</select>';
					break;
			case 'checkbox':
			        $sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
					$resultOption = mysql_query($sqlOption) or die(mysql_error());
					while($rowOption=mysql_fetch_array($resultOption))
					{
				$inputString .='<input type="checkbox" name="'.$rowFields['name'].'[]" class="'.$validationClass.'" value="'.$rowOption['value'].'"><span>'.$rowOption['label'].'</span>';
					}
			        break; 
			case 'radio':
			        $sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
					$resultOption = mysql_query($sqlOption) or die(mysql_error());
					while($rowOption=mysql_fetch_array($resultOption))
					{
					$inputString .='<input type="radio" name="'.$rowFields['name'].'" class="'.$validationClass.'" value="'.$rowOption['value'].'"><span>'.$rowOption['label'].'</span>';
					}
			        break;
					
/// ================================================================================================================================================ ///		
				
			case 'uploadRadio':
			        $sqlOption = "SELECT * FROM form_field_option WHERE form_id='".$rowFields['form_id']."' and fieldset_id='".$rowFields['fieldset_id']."' and field_id='".$rowFields['field_id']."'";
					$resultOption = mysql_query($sqlOption) or die(mysql_error());
					
					$fieldID = $rowFields['field_id'];
					
					
					$inputString .= "<script type='text/javascript'>
					  $(document).ready(function(){
						
					$('.bxslider').bxSlider({
					  mode: 'fade',
					  slideMargin: 5
					});
					  });
					</script>";
					
					$inputString .= '
					<div class="slider">
					<ul class="bxslider">';

					while($rowOption=mysql_fetch_array($resultOption)){
						
						$optionID 		 = $rowOption['option_id'];
						$uploadedImage 	 = $rowOption['label'];
						$uploadedDetails = $rowOption['value'];
	
						$uploadedDetails = explode("|", $uploadedDetails);
						
						if ($uploadedDetails[2] == "Enabled"){
						
								$inputString .= '<div class="contactForm-custom">';
								$inputString .= '<input id="radio'.$optionID.'_'.$fieldID.'" type="radio" name="uploadRadio'.$fieldID.'" value="'.$optionID.'" class="regular-radio big-radio" /><label for="radio'.$optionID.'_'.$fieldID.'">'.$uploadedDetails[1].'</label>';
								$inputString .= '<img src='.$uploadedImage.' onclick="document.getElementById(\'radio'.$optionID.'_'.$fieldID.'\').checked=true;" />';
								$inputString .= '<textarea name="Image Description" class="" readonly="">';
								$inputString .= stripslashes(strip_tags($uploadedDetails[0]));
								$inputString .= '</textarea>';
							
							if ($nrSteps < $allFieldsets) {
								$nrSteps1 = $nrSteps + 1;
								$inputString .= '<div style="float:right; width:90%; margin-right: 35px;">';
								$inputString .= '<input type="button" id="butt_next" name="butt" onclick="document.getElementById(\'radio'.$optionID.'_'.$fieldID.'\').checked=true; changeStep('.$nrSteps1.', '.$allFieldsets.');" value="Verder"/>';
								$inputString .= '</div>';
							}
							
								$inputString .= '</div>';
						}
						
					}
					
					$inputString .= '</ul></div>';
					
					$inputString .= '<input type="hidden" id="uploadedFieldIDs[]" name="fieldIDs[]" value="'.$fieldID.'" />';
					
			    break;
		}
		return $inputString;
	}
	
	
	
	
	function getOptionDetails($fieldValue, $Site_Url){
		
		$fieldValue = explode(":", $fieldValue);
		$sqlP = "SELECT * FROM `form_field_option` where `option_id`=".$fieldValue[1];
		$resultP = mysql_query($sqlP);
		
		while($db_row = mysql_fetch_array($resultP)){
			$image = $db_row['label'];
			$details = $db_row['value'];
			
			$details = explode("|", $details);
		}
		
		
		$description = $lang_array['Description'];
		if ($description == "") { $description = "Template omschrijving";}
		
		$str = "";
		
		$str .= '<table style="">';
		$str .= '<tbody>';
		$str .= '<td>';
		$str .= '<img src="'.$Site_Url.$image.'" height="70" style="padding:4px; border:1px solid #ccc; float:left; background:#eee;" />';
		$str .= '<p style="padding:5px 10px; float:left; width:50%;"><b>'.stripslashes($details[1]).'</b></p>';
		$str .= '<p style="padding:5px 10px; float:left; width:50%;"><b><u>'.$description.': </u></b>'.stripslashes($details[0]).'</p>';
		$str .= '</td>';
		$str .= '</tbody>';
		$str .= '</table>';
					
	return $str;
	
	}
		
		
?>

