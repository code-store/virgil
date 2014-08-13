<?php 

ob_start();
include('config.php'); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="js/jquery-1.7.1.js"></script>
   	<!--============ JAVASCRIPT SECTION ===========================---> 

		
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
	<!--============ JAVASCRIPT SECTION ===========================---> 
 <!--Css for in page-->
	<!--<style type="text/css">
	
		.log-btn input[type="submit"], .log-btn a {
			background: url("./images/login.png") no-repeat scroll 0 0 transparent;
			border: medium none;
			border-radius: 21px 21px 21px 21px;
			color: #FFFFFF;
			cursor: pointer;
			display: block;
			font: 20px/37px 'Rockwell';
			height: 37px;
			text-align: center;
			text-decoration: none;
			width: 100px;
		}
	
		.log-btn input[type="submit"]:hover, .log-btn a:hover {
			background-position: 0 -37px;
		}
	
		.form-list{
			float:left;
			padding:0px;
		}

		ul.product_list li {
			background: none repeat scroll 0 0 #FAFAFA;
			border-radius: 6px 6px 6px 6px;
			box-shadow: 1px 1px 8px #DADBDC;
			float: left;
			list-style: none outside none;
			margin: 20px 32px 0 0;
			padding: 9px 9px 16px 40px;
			position: relative;
			width: 360px !important;
		}
	
		ul.product_list li:hover {
			background:white;
			box-shadow:1px 1px 8px #B4B4B4;
		}
	
		.fieldset {
			border-radius: 12px 12px 12px 12px !important;
		}
		.fieldset {
			background: none repeat scroll 0 0 #F7F7F7 !important;
			border: 1px solid #BBAFA0 !important;
			margin: 15px 0 !important;
			padding: 22px 25px 12px 33px !important;
		}
		.fieldset .legend {
			background: none repeat scroll 0 0 #F7F7F7 !important;
			border: 1px solid #BBAFA0 !important;
			border-radius: 12px 12px 12px 12px;
			color: #2E2E2E !important;
			float: left !important;
			font-size: 13px !important;
			font-weight: bold !important;
			line-height: 22px;
			margin: -33px 0 0 -10px !important;
			padding: 0 8px !important;
			position: relative !important;
		}
		.form-list li {
			margin:0px 0 8px !important;
			 width:auto !important;
		}
		.form-list li .field {
			height: auto !important;
			width: 275px !important;
			margin-bottom:15px !important;
		}
		.form-list .field {
			float: left !important;
			width: 275px !important;
		}

		.form-list em{color:red;}
		.form-list .field label{color: #2E2E2E; font: 13px/19px Tahoma,Geneva,sans-serif; padding:0 20px 0 0; float:left; min-width:100px;}
		.form-list .field .input-box{color:#494A4B; font: 12px/19px Tahoma,Geneva,sans-serif; padding:0; float:left; width:auto; height:auto;}
		.form-list .field .input-box input[type="text"]{width:275px; height:13px; padding:5px;}
		.form-list .field .input-box select{width:212px; height:26px; padding:5px;}
		.form-list .field .input-box input[type="checkbox"]{ float:left;  margin: 4px 0 0;}
		.form-list .field .input-box input[type="radio"]{ float:left;  margin: 4px 0 0;}
		.form-list .field .input-box span{padding:0 10px 0 5px; float:left;}
		.form-list .field .input-box textarea{height: 70px; padding: 5px; width: 275px; resize:none;}
	</style>-->
<!--Css for in page-->

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
.form-list li.fields .field input[type="text"]{width:68%; height:30px; border:1px solid #e4e4e4; padding:3px; font:12px Arial, Helvetica, sans-serif; color:#585858; background:#fff; box-shadow:none; margin:0 !important; }
.form-list li.fields .field select{width:70%; height:38px; border:1px solid #e4e4e4; padding:9px 6px; font:12px Arial, Helvetica, sans-serif; color:#585858; background:#fff; box-shadow:none; margin:0 !important; }
.form-list li.fields .field .check{ width:71%; }
.log-btn input[type="submit"]{float:left; width:107px; padding:0px; margin:0 0 5px 6px; height:42px; border:0px; color:#fff; font:20px 'MyriadPro-SemiboldCond'; text-align:center; text-transform:uppercase; background:url(images/form-btm.png) 0 0 no-repeat; cursor:pointer;}
.log-btn input[type="submit"]:hover{ background-position:0 -42px; }
.formDescription h2 { color: #585858; font: 30px 'MyriadPro-BoldCond'; margin: 0; padding: 6px 0 5px 0;}
.formDescription p{ margin:0 0 10px 0;}


#theContent .form-list .field label {font:normal 11px/1.5em Arial,Helvetica,sans-serif; color:#949494;}
#theContent .form-list li.fields .field input[type="text"] {border:1px solid #1C314D; color:#707070; height:28px; margin-bottom:10px; padding-left:12px; width:75%; background:#07152B; font:normal 11px Arial, Helvetica, sans-serif;}
#theContent .form-list .field .input-box textarea {border:1px solid #1C314D; color:#707070; background:#07152B; hanging-punctuation:100px; margin-bottom:10px; padding-left:12px; font:normal 11px Arial, Helvetica, sans-serif;}
#theContent .log-btn-con input[type="submit"] {
background: #102a4d; /* Old browsers */
	background: -moz-linear-gradient(top, #213b5d 0%, #102a4d 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#213b5d), color-stop(100%,#102a4d)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #213b5d 0%,#102a4d 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #213b5d 0%,#102a4d 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top, #213b5d 0%,#102a4d 100%); /* IE10+ */
	background: linear-gradient(top, #213b5d 0%,#102a4d 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#213b5d', endColorstr='#102a4d',GradientType=0 ); /* IE6-9 */
	text-shadow: 0 -1px 0 #333 !important;
	-webkit-box-shadow: inset 0 1px 0 #2c4e7a;
	-moz-box-shadow: inset 0 1px 0 #2c4e7a;
	box-shadow: inset 0 1px 0 #2c4e7a;
	color: #eee;
	border: 1px solid #171717;
	padding: 10px 13px;
	margin: 0px;
	cursor: pointer;
	font:bold 11px/1em Arial,sans-serif !important;
	height:auto;
	width:auto;
	}
	
#theContent .log-btn-con input:hover[type="submit"]{
background: #436695;
	background: -webkit-gradient(linear, left top, left bottom, from(#28456a), to(#143259)) !important;
	background: -moz-linear-gradient(top, #28456a, #143259) !important;	
}

#theContent .form-list li.fields .field {width:207px !important;}
#theContent .form-list .field .input-box textarea {width:186px !important;}
#theContent .log-btn-con {margin-top:0;}
</style>
<!--Css for in iframe-->

</head>

<body>

	<ul class="product_list" id="theContent" style="padding:0px;">
	<?php
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
		 $subject = 'Details of Submit Form: '.$formTitle;
		 $message = '';
		 $message .= '<div style="background-color:#f6f6f6; padding:24px 40px;"><div style="background-color:#ffffff; border:1px solid #e0e0e0; padding:10px;">';
		 $message .= '<div align="left"><img src="'.$mail_logo.'" alt="" /></div>';
		 $message .= '<div align="center"><b><u style="font:normal 25px Arial, Helvetica, sans-serif;">'.$formTitle.'</u></b></div><br>';
		 $message .= '<div align="center"><b>'.$thankyou_message.'</b></div><br>';
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
		    ?>
		 <script>window.parent.location = "<?php echo $Site_Url.$thankyou_url;?>"</script>
		 <?php
			  //echo 'Thank you for contacting us. We will get back to you shortly.';
		/**********************************************/				
		//print_r($MailFieldLabel);	   
		}
	 }
	?>
	
	<form method="post" action="" onsubmit="return testform();">
		<div>		
		   <?php /*?><div class="formDescription">
				<h2><?php echo $formTitle; ?></h2>
				<p><?php echo $formDescription; ?></p>
		   </div><?php */?>
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
			<div class="log-btn-con">
				<input type="submit" value="Submit" name="submit">
			</div>
		</div>
	   </form> 
	</ul>
				
      
</body>
</html>


<?php
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
?>
