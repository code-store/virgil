<?php 

	include 'config.php';

	$SQL = "SELECT tooltip_status FROM webpages_settings WHERE webpages_settings.id = 1";
	$result = mysql_query($SQL);

	$res = mysql_fetch_assoc($result); 
	$tooltip_status = $res['tooltip_status'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<title>New Form</title>
	<script src="js/jquery-1.7.1.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	<script src="js/ajaxScripts.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
	<link rel="stylesheet" href="css/jquery.ui.theme.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<?php
		if ($tooltip_status == 1){	
			?>
			<link rel="stylesheet" type="text/css" href="css/css-tooltips.css"/>
			<?php
		}
		?>	
	<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
	<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
	<script type="text/javascript" src="js/nicEdit.js"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>
	<script>
	
	/*-------------------------------------------------------------------------------------------------------------*/
	/*-------------------------- Script for making the tabs on admin panel ----------------------------------------*/
		
		$(function() {
			$( "#tabs" ).tabs({
				ajaxOptions: {
					error: function( xhr, status, index, anchor ) {
						$( anchor.hash ).html(
							"Couldn't load this tab. We'll try to fix this as soon as possible. " +
							"If this wouldn't be a demo." );
					}
				}
			});
			
			$('#field_type').change(function(){
				var inputType = $(this).val();
				if(inputType == 'select' || inputType == 'checkbox' || inputType == 'radio') {
					$('#divOptionMain').show();
				}
				else {
					$('#divOptionMain').hide();
				}
				
				if(inputType == 'uploadRadio') {
					$('#divUploadedOptions').show();
				}
				else{
					$('#divUploadedOptions').hide();
				}
			});
			
			$('#btnAddOption').click(function(){
				var divOptionId="divOption"+ ( parseInt($('#divOptionMain').children('div').length) + 1 );
				$("#divOption1").clone().attr('id', divOptionId).appendTo("#divOptionMain");
				//if( parseInt($('#divOptionMain').children('div').length) > 0 )
					//$('#btnDeleteOption').attr('disabled','');
			});
			
			$('#btnDeleteOption').click(function(){
				if(parseInt($('#divOptionMain').children('div').length) > 2)
					$('#divOptionMain').children('div:last').remove();

			});
			
			
			/*-------------------------------------------------------------------------------------------------------------*/
			/*-------------------------- Image upload as options for a mailform field -------------------------------------*/
			
			$(function(){
				
				var btnUpload=$('#me');
				var mestatus=$('#mestatus');
				var files=$('#files');
				var user = $('#extFileName.value');
				new AjaxUpload(btnUpload, {
							action: 'upload_option.php',
							name: 'uploadfile',
							onSubmit: function(file, ext){
								 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
								// extension is not allowed 
									mestatus2.text('Only JPG, PNG or GIF files are allowed');
									return false;
								}
							},
							onComplete: function(file, response)
								{
								//On completion clear the status
								mestatus.text(file);
								//On completion clear the status
								files.html('');
								//Add uploaded file to list
								if(response==="error"){
									$('<li></li>').appendTo('#files').text(file).addClass('error');
									} else{
										$('<li></li>').appendTo('#files').html('<img id="uploadedImage" src="option_images/___'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="option_images/___'+file+'" id="img_src" name="img_src"/><br />').addClass('success');
									}
								}
							});
				});
				
			/*-------------------------------------------------------------------------------------------------------------*/
			/*-------------------------- Image upload as options for a mailform field -------------------------------------*/
			
			
		});
		
	
	 $.noConflict();	
		
	</script>
    <script>
	function email_form(v){
	 if(v=='1')
	  document.getElementById('tr_mail_to').style.display = 'block';
	 else
	  document.getElementById('tr_mail_to').style.display = 'none'; 	
	}
	function show_sidebar(v){
	 if(v=='1')
	  document.getElementById('tr_sidebar_size').style.display = 'block';
	 else
	  document.getElementById('tr_sidebar_size').style.display = 'none'; 	
	}
	</script>
	</head>

	<body>
<?php
	error_reporting(0);
	session_start();
	
	if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) {

	include 'config.php';
	
    //echo $Site_Url;
	$lang = $_GET["lang"];
	//$lang = 'en';
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

 if($_GET['form_id']!='')
   $form_id = $_GET['form_id'];
 else
   $form_id = 0;
/*--------------------Add Form----------------------------------------------------------*/
 if(isset($_POST['new_form']) && $_POST['hid_new_form'] == 'hid_new_form')	
 { 
	 $form_name = $_POST['form_name'];
	 $form_url = $_POST['form_url'];
	 $form_description = $_POST['form_description'];
	 $show_in_sidebar = $_POST['show_in_sidebar'];
	 $sidebar_size = $_POST['sidebar_size'];
	 $email_this  = $_POST['email_this'];
	 $mail_to  = $_POST['mail_to'];
	 $thankyou_url  = $_POST['thankyou_url'];
	 $thankyou_message  = $_POST['thankyou_message'];
	 $form_status = $_POST['form_status'];
	 
	 if($mail_to != 'Enter email where need to send' && $email_this == '1'){$mail_to = $_POST['mail_to'];}else{$mail_to = '';}
	 if($sidebar_size != 'Enter sidebar size' && $show_in_sidebar == '1'){$sidebar_size = $_POST['sidebar_size'];}else{$sidebar_size = '';}
	 if($thankyou_url  == 'Thank you url'){$thankyou_url  = '';}
	 if($thankyou_message  == 'Thank You Message for Email'){$thankyou_message  = '';}
	 
	 if(($form_name!='' && $form_name!='Enter form name') && ($form_url!='' && $form_url!='Url is used to show this form in frontend'))
	 {
		$sql = "INSERT INTO `forms` 
		(`name`,`url`,`description`,`show_in_sidebar`,`sidebar_size`,`email_this`,`mail_to`,`thankyou_url`,`thankyou_message`,`status`) 
		VALUES('".$form_name."','".$form_url."','".$form_description."','".$show_in_sidebar."','".$sidebar_size."','".$email_this."','".$mail_to."','".$thankyou_url."','".$thankyou_message."','".$form_status."')";
		 $result = mysql_query($sql);
		 if($result)
		 {
			$new_id = mysql_insert_id();
			//header('Location: http://www.facebook-shopper.nl/e-shop/new_form.php?form_id='.$new_id);
			?> 
			<script>window.location = "<?php echo $Site_Url;?>new_form.php?form_id="+<?php echo $new_id;?></script>
			<?php
		 }
	 }
 }	
 /*--------------------Add Fieldset----------------------------------------------------------*/
 if(isset($_POST['new_fieldset']) && $_POST['hid_fieldset'] == 'hid_fieldset')	
 { 
	 $fieldset_name = $_POST['fieldset_name'];
	 $fieldset_position = $_POST['fieldset_position'];
	 $fieldset_status = $_POST['fieldset_status'];
	 
	 if(($fieldset_name!='' && $fieldset_name!='Enter fieldset name'))
	 {
		$sql = "insert into `form_fieldsets` (`form_id`,`name`,`position`,`status`) values('".$form_id."','".$fieldset_name."','".$fieldset_position."','".$fieldset_status."')";
		 $result = mysql_query($sql);
		 if($result)
		 {
			//header('Location: http://www.facebook-shopper.nl/e-shop/new_form.php?form_id='.$form_id); 
			?> 
			<script>window.location = "<?php echo $Site_Url;?>new_form.php?form_id="+<?php echo $form_id;?></script>
			<?php
		 }
	 }
 } 
 /*--------------------Add Field----------------------------------------------------------*/
 if(isset($_POST['new_field']) && $_POST['hid_field'] == 'hid_field')	
 { 
	 $field_fieldset = $_POST['field_fieldset'];
	 $field_position = $_POST['field_position'];
	 $field_type = $_POST['field_type'];
	 $field_label = $_POST['field_label'];
	 $field_name = str_replace(' ','-',strtolower($_POST['field_name']));
	 $field_status = $_POST['field_status'];
	 $is_required = $_POST['is_required'];
     $email_validation = $_POST['email_validation'];
 
	 if($field_fieldset!='0')
	 {
		$sql = "insert into `form_fields` (`form_id`,`fieldset_id`,`position`,`type`,`label`,`name`,`required`,`email_validation`,`status`) values('".$form_id."','".$field_fieldset."','".$field_position."','".$field_type."','".$field_label."','".$field_name."','".$is_required."','".$email_validation."','".$field_status."')";
		$result = mysql_query($sql);
		$field_id=mysql_insert_id();
			 
		if($field_type == 'select' || $field_type == 'radio' || $field_type == 'checkbox')
		{
			$indx=0;
			foreach($_REQUEST['optionlabel'] as $label)
			{
				$sql = "INSERT INTO `e-shop`.`form_field_option` (`form_id` ,`fieldset_id` ,`field_id` ,`label` ,`value`) VALUES ('".$form_id."', '".$field_fieldset."', '".$field_id."', '".$label."', '".$_REQUEST['optionvalue'][$indx++]."')";
				$result = mysql_query($sql);
			}
		}
		

		if($result)
		{
			//header('Location: http://www.facebook-shopper.nl/e-shop/new_form.php?form_id='.$form_id);
			?> 
			<script>window.location = "<?php echo $Site_Url;?>new_form.php?form_id="+<?php echo $form_id;?></script>
			<?php
		}
	 }
 }    

 if($form_id)
 {
	$sql = "select * from `forms` where `form_id` = '".$form_id."'"; 
	$result = mysql_query($sql);
	if(mysql_num_rows($result))
	{
	 $row = mysql_fetch_assoc($result);
	 $form_name = $row['name'];
	 $form_url = $row['url'];
	 $form_description = $row['description'];
	 $show_in_sidebar = $row['show_in_sidebar'];
	 $sidebar_size = $row['sidebar_size'];
	 $email_this  = $row['email_this'];
	 $mail_to  = $row['mail_to'];
	 $thankyou_url  = $row['thankyou_url'];
	 $thankyou_message = $row['thankyou_message'];
	 $form_status = $row['status'];
	}
 }
	
?>
<div class="main" >
    <div class="header">
		<div class="logo">
			<?php 
				$SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
				$result = mysql_query($SQL);

				$res = mysql_fetch_assoc($result);
				$logoUrl = $res['header_img'];
			?>
			<img src="<?php echo $logoUrl; ?>" />
		</div>
	</div>
      
	  <div class="topabsoulte">
			<a class="logout" href="./edit_account.php"><?php echo $lang_array['Edit Account'] ?></a>
			<a class="logout" href="./newuser.php">Add New User</a> 
			<a class="logout" href="./login.php">Log Out!</a>
		</div>
		
		<div class="top"></div>
		
		<?php
			include('./include/menu.php');
		?>
	  
	  
    <div class="content">
        <div class="myform steps">
			<div>
				
				<h2 style="clear:both; padding:23px 0 1px;"><?php echo $lang_array['Add New Form'] ?></h2>
              
				<form name="new_form" id="new_form" action="" method="post" onsubmit="return validateForm()" >
					
					<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
						
						<tr><!------------------------------ NEW FORM's NAME ----------------------------------------->
							<td width="20%">
								<div data-tip="<?php echo $lang_array['NEW - FORM NAME - Tooltip']; ?>" >
									<?php echo $lang_array['Name:'] ?>
								</div>
							</td>
							<td width="80%">
								<div data-tip="<?php echo $lang_array['NEW - FORM NAME - Tooltip']; ?>" >
									<input type="text" name="form_name" id="form_name" onblur="if(this.value=='')this.value='Enter form name';" onfocus="if(this.value=='Enter form name')this.value='';" value="<?php if($form_name!=''){ echo $form_name;}else{ echo 'Enter form name';}?>" size="50">
								</div>
							</td>
						</tr>                  
						
						<tr><!------------------------------ NEW FORM's URL ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM URL - Tooltip']; ?>" >
									<?php echo $lang_array['Url / Identifier:'] ?>
								</div>
							</td>
							<td>
								<input type="text" name="form_url" id="form_url" onblur="if(this.value=='')this.value='Url is used to show this form in frontend';" onfocus="if(this.value=='Url is used to show this form in frontend')this.value='';" value="<?php if($form_url!=''){ echo $form_url;}else{ echo 'Url is used to show this form in frontend';}?>" size="50">
							</td>
						</tr>                  
                
						<tr><!------------------------------ NEW FORM's DESCRIPTION ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM DESCRIPTION - Tooltip']; ?>" >
									<?php echo $lang_array['Description:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM DESCRIPTION - Tooltip']; ?>" >
									<textarea name="form_description" id="form_description" rows="5" cols="100"><?php echo $form_description;?></textarea>
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ NEW FORM's SIDE ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM SIDEBAR - Tooltip']; ?>" >
									<?php echo $lang_array['Show in sidebar?:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM SIDEBAR - Tooltip']; ?>" >
									<select name="show_in_sidebar" onchange="show_sidebar(this.value);" style="float:left;">
										<option value="0" <?php if($show_in_sidebar=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No'] ?></option>
										<option value="1" <?php if($show_in_sidebar=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes'] ?></option>
									</select>
									<div style="display:<?php if($sidebar_size!=''){?>block<?php }else{?>none<?php } ?>; float:left;" id="tr_sidebar_size">
										<span style="float:left; padding:0 20px 0 50px;"><?php echo $lang_array['Sidebar size(px):']; ?></span>
										<input type="text" name="sidebar_size" id="sidebar_size" onblur="if(this.value=='')this.value='Enter sidebar size';" onfocus="if(this.value=='Enter sidebar size')this.value='';" value="<?php if($sidebar_size!=''){ echo $sidebar_size;}else{ echo 'Enter sidebar size';}?>" size="50">
									</div>
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ FORM - SEND MAIL ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM SEND MAIL - Tooltip']; ?>" >
									<?php echo $lang_array['Need to email this form?:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM SEND MAIL - Tooltip']; ?>" >
									<select name="email_this" onchange="email_form(this.value);" style="float:left;">
										<option value="0" <?php if($email_this=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No'] ?></option>
										<option value="1" <?php if($email_this=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes'] ?></option>
									</select>
									<div style="display:<?php if($mail_to!=''){?>block<?php }else{?>none<?php } ?>; float:left;" id="tr_mail_to">
										<span style="float:left; padding:0 20px 0 50px;">Mail To:</span>
										<input type="text" name="mail_to" id="mail_to" onblur="if(this.value=='')this.value='Enter email where need to send';" onfocus="if(this.value=='Enter email where need to send')this.value='';" value="<?php if($mail_to!=''){ echo $mail_to;}else{ echo 'Enter email where need to send';}?>" size="50">
									</div>
								</div>
							</td>
						</tr>			    
			  
						<tr><!------------------------------ FORM THANK YOU URL ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM THANK URL - Tooltip']; ?>" >
									<?php echo $lang_array['Thank You Url:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM THANK URL - Tooltip']; ?>" >
									<input type="text" name="thankyou_url" id="thankyou_url" onblur="if(this.value=='')this.value='Thank you url';" onfocus="if(this.value=='Thank you url')this.value='';" value="<?php if($thankyou_url!=''){ echo $thankyou_url;}else{ echo 'Thank you url';}?>" size="50">
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ FORM OPTIONS ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM MAIL THANK - Tooltip']; ?>" >
									<?php echo $lang_array['Thank You Message for Email:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM MAIL THANK - Tooltip']; ?>" >
									<input type="text" name="thankyou_message" id="thankyou_message" onblur="if(this.value=='')this.value='Thank You Message for Email';" onfocus="if(this.value=='Thank You Message for Email')this.value='';" value="<?php if($thankyou_message!=''){ echo $thankyou_message;}else{ echo 'Thank You Message for Email';}?>" size="117">
								</div>
							</td>
						</tr>                       
                  
						<tr><!------------------------------ FIELD OPTIONS ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM STATUS - Tooltip']; ?>" >
									<?php echo $lang_array['Status:'] ?></td>
								</div>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FORM STATUS - Tooltip']; ?>" >
									<select name="form_status">
										<option value="1" <?php if($form_status=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Enable'] ?></option>
										<option value="0" <?php if($form_status=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['Disable'] ?></option>
									</select>
								</div>
							</td>
						</tr>                  
						
						<tr><!------------------------------ SUBMIT BUTTON - SAVE FORM ----------------------------------------->
							<td>&nbsp;</td>
							<td>
								<input type="hidden" name="hid_new_form" value="hid_new_form">
								<input type="submit" class="custom-button" name="new_form" value="<?php echo $lang_array['Add Form'] ?>">
							</td>
						</tr>                  
                </table>
          </form>
        </div>
        <?php if($form_id){?>
			
			<div>
				
				<h2><?php echo $lang_array['Add Fieldset'] ?></h2>
				
				<form name="new_fieldset" id="new_fieldset" action="" method="post" onsubmit="return validateFieldset();">
					<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable" >
						
						<tr><!------------------------------ NEW FIELDSET NAME ----------------------------------------->
							<td width="20%">
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET STATUS - Tooltip']; ?>" >
									<?php echo $lang_array['Name:'] ?>
								</div>
							</td>
							<td width="80%">
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET STATUS - Tooltip']; ?>" >
									<input type="text" name="fieldset_name" id="fieldset_name" onblur="if(this.value=='')this.value='Enter fieldset name';" onfocus="if(this.value=='Enter fieldset name')this.value='';" value="Enter fieldset name" size="50">
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ NEW FIELDSET POSITION ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET POSITION - Tooltip']; ?>" >
									<?php echo $lang_array['Position:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET POSITION - Tooltip']; ?>" >
									<input type="text" name="fieldset_position" onblur="if(this.value=='')this.value='Enter fieldset position';" onfocus="if(this.value=='Enter fieldset position')this.value='';" value="Enter fieldset position" size="50">
								</div>
							</td>
						</tr>
					  
						<tr><!------------------------------ SUBMIT BUTTON - SAVE FORM ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET STATUS - Tooltip']; ?>" >
									<?php echo $lang_array['Status:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELDSET STATUS - Tooltip']; ?>" >
									<select name="fieldset_status">
										<option value="1"><?php echo $lang_array['Enable'] ?></option>
										<option value="0"><?php echo $lang_array['Disable'] ?></option>
									</select>
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ SUBMIT BUTTON - SAVE FORM ----------------------------------------->
							<td>&nbsp;</td>
							<td>
								<input type="hidden" name="hid_fieldset" value="hid_fieldset">
								<input type="submit" name="new_fieldset" value="<?php echo $lang_array['Add Fieldset'] ?>" class="custom-button" >
							</td>
						</tr>
						
					</table>
					
				</form>
			</div>
			
        <?php
		   $sql = "select * from `form_fieldsets` where `form_id`='".$form_id."'";
		   $result = mysql_query($sql);
		   if(mysql_num_rows($result)){?>
        
			<div>
				<h2><?php echo $lang_array['Add Field'] ?></h2>
				
				<form name="new_field" id="new_field" action="" method="post" onsubmit="return validateNewfield();">
					<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
						
						<tr><!------------------------------ NEW FIELD - AASSIGN TO A FIELDSET ----------------------------------------->
							<td width="20%">
								<div data-tip="<?php echo $lang_array['NEW - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
									<?php echo $lang_array['Fieldset:'] ?>
								</div>
							</td>
							<td width="80%">
								<div data-tip="<?php echo $lang_array['NEW - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
									<select name="field_fieldset">
										<?php
										 while($row=mysql_fetch_assoc($result)){?>
										 <?php if($row['status']=='1'){?>
										  <option value="<?php echo $row['fieldset_id'];?>"><?php echo $row['name'];?></option>
										 <?php } ?> 
										<?php } ?>
									</select>
								</div>
							</td>
						</tr>              
              
						<tr><!------------------------------ NEW FIELD - POSITION ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD POSITION - Tooltip']; ?>" >
									<?php echo $lang_array['Position:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD POSITION - Tooltip']; ?>" >
									<input type="text" name="field_position" onblur="if(this.value=='')this.value='Enter field position';" onfocus="if(this.value=='Enter field position')this.value='';" value="Enter field position" size="50">
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ NEW FIELD - TYPE ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD TYPE - Tooltip']; ?>" >
									<?php echo $lang_array['Type:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD TYPE - Tooltip']; ?>" >
									<select name="field_type" id="field_type">
										<option value="text"><?php echo $lang_array['Text'] ?></option>
										<option value="radio"><?php echo $lang_array['Radio'] ?></option>
										<option value="checkbox"><?php echo $lang_array['Checkbox'] ?></option>
										<option value="select"><?php echo $lang_array['Select'] ?></option>
										<option value="textarea"><?php echo $lang_array['Textarea'] ?></option>
										
										<option value="uploadRadio"><?php echo $lang_array['Image Upload Radio'] ?></option>
									</select>
								</div>
							</td>
						</tr> 
              
						<tr><!------------------------------ NEW FIELD - REQUIRED? ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD REQUIRED - Tooltip']; ?>" >
									<?php echo $lang_array['Is Required?:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD REQUIRED - Tooltip']; ?>" >
									<select name="is_required">
										<option value="0"><?php echo $lang_array['No'] ?></option>
										<option value="1"><?php echo $lang_array['Yes'] ?></option>
									</select>
								</div>
							</td>
						</tr>
              
						<tr><!------------------------------ NEW FIELD - EMAIL VALIDATION REQUIRED? ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
									<?php echo $lang_array['Email Validation Required?:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
									<select name="email_validation">
										<option value="0"><?php echo $lang_array['No'] ?></option>
										<option value="1"><?php echo $lang_array['Yes'] ?></option>
									</select>
								</div>
							</td>
						</tr>
              
						<tr><!------------------------------ NEW FIELD - LABEL ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD LABEL - Tooltip']; ?>" >
									<?php echo $lang_array['Label:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD LABEL - Tooltip']; ?>" >
									<input type="text" name="field_label" id="field_label" onblur="if(this.value=='')this.value='Enter field label';" onfocus="if(this.value=='Enter field label')this.value='';" value="Enter field label" size="50">
								</div>
							</td>
						</tr>               
              
						<tr><!------------------------------ NEW FIELD - NAME ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD NAME - Tooltip']; ?>" >
									<?php echo $lang_array['Name:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD NAME - Tooltip']; ?>" >
									<input type="text" name="field_name" id="field_name" onblur="if(this.value=='')this.value='Enter field name';" onfocus="if(this.value=='Enter field name')this.value='';" value="Enter field name" size="50">
								</div>
							</td>
						</tr> 
                  
						<tr><!------------------------------ NEW FIELD - STATUS ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD STATUS - Tooltip']; ?>" >
									<?php echo $lang_array['Status:'] ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['NEW - FIELD STATUS - Tooltip']; ?>" >
									<select name="field_status">
										<option value="1"><?php echo $lang_array['Enable'] ?></option>
										<option value="0"><?php echo $lang_array['Disable'] ?></option>
									</select>
								</div>
							</td>
						</tr>
              
						<tr><!------------------------------ NEW FIELD - OPTIONS ----------------------------------------->
							<td colspan="2">
								<div style="border:1px solid #2F5F71;display:none;padding:4px;" id="divOptionMain">
									<span>
										<input type="button" class="custom-button" id="btnAddOption" value="<?php echo $lang_array['Add Option'] ?>" />&nbsp;&nbsp;
										<input type="button" class="custom-button" id="btnDeleteOption" value="<?php echo $lang_array['Delete Option'] ?>" />
									</span>
									<div id="divOption1">
										<div style="display:block; margin:10px;">
											
											<div data-tip="<?php echo $lang_array['NEW - CHANGE OPTION LABEL - Tooltip']; ?>" style="display:inline;" >
												<span>
													<?php echo $lang_array['Label:'] ?> 
													<input type="text" name="optionlabel[]" id="label1" style="min-width:350px;" />
												</span>
											</div>
											
											<div data-tip="<?php echo $lang_array['NEW - CHANGE OPTION VALUE - Tooltip']; ?>" style="display:inline;" >
												<span>
													<?php echo $lang_array['Value:'] ?> 
													<input type="text" name="optionvalue[]" id="value1" style="min-width:350px;" />
												</span>
											</div>
											
										</div>
									</div>
								</div>
							</td>
						</tr>
						
						<tr><!------------------------------ NEW FIELD - UPLOAD IMAGES FOR THE MAILFORM FIELD ----------------------------------------->
							<td colspan="2">
								<div style="display:none;padding:4px;" id="divUploadedOptions">
							
									<div id="divUploadOptions">
										<div style="display:block; margin:10px;">
											
											<!--
											<table>
												<thead>
													<td> <?php echo $lang_array['Image']; ?> </td>
													<td> <?php echo $lang_array['Description']; ?> </td>
													<td> <?php echo $lang_array['Option Title']; ?> </td>
													<td> <?php echo $lang_array['New Image Name']; ?> </td>
													<td> <?php echo $lang_array['Status']; ?> </td>
												</thead>
												<tbody>
													<?php 
														/*
														if ($handle = opendir('./option-images/')) {
															while (false !== ($entry = readdir($handle))) {
																if ($entry != "." && $entry != "..") {
																	
																	$pos = strpos($entry, "___");
																	if ($pos !== false) {
																		?>
																			<td> <img src='./option-images/<?php echo $entry; ?>' height='70'> </td>
																			<td> <> </td>
																		
																		
																		<?php
																	}
																	
																}
															}
														}
														*/
													?>
												</tbody>
											</table>
											-->
											
											<div data-tip="<?php echo $lang_array['NEW FIELD - UPLOAD IMAGES - Tooltip']; ?>" style="border-bottom:1px solid #2F5F71; margin-bottom: 5px;" >
												<?php echo $lang_array['Upload your images for the mailform:'] ?>
											</div>
											
											<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
												<div id="me" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
													<span style=" cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
														<span style=" cursor:pointer;"><?php echo $lang_array['Upload Image']; ?></span>
													</span>
												</div>
												
												<span id="mestatus" ></span>
													
												<div id="files" style="margin-left:250px;">
													<li id="fileName" class="success"></li>
												</div>
											<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
											
										</div>
									</div>
									
								</div>
							</td>
						</tr>
                                
						<tr><!------------------------------ NEW FIELD - SUBMIT & SAVE FIELD ----------------------------------------->
							<td>&nbsp;</td>
							<td>
								<input type="hidden" name="hid_field" value="hid_field">
								<input type="submit" name="new_field" value="<?php echo $lang_array['Add Field'] ?>" class="custom-button" >
							</td>
						</tr>                  
					</table>
				</form>
            
			</div>
        <?php } ?>
        <?php } ?>
      </div>
        </div>
  </div>
      <div class="bot"></div>
    </div>
<div class="footer-outer">
      <div class="footer-inner">
    <div class="footer">
          <p>&copy; All rights reserved.</p>
        </div>
  </div>
    </div>
</body>
</html>
<?php
	}else {
		$html = file_get_contents('./login.php');
		print_r($html);
		header("location:login.php");
		}
?>