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
	<title>Edit Form</title>
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
		bkLib.onDomLoaded(function() { 
			new nicEditor({fullPanel : true}).panelInstance('form_description');
		});
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
		$('#field_type_new').change(function(){
			var inputType = $(this).val();
			if(inputType == 'select' || inputType == 'checkbox' || inputType == 'radio') {
				$('#divOptionMain').show();
			}
			else {
				$('#divOptionMain').hide();
			}
			
			if(inputType == 'uploadRadio') {
				$('#divUploadOptions').show();
			}
			else{
				$('#divUploadOptions').hide();
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
			/*$('#btnAddOption').click(function(){
				var divOptionId="divOption"+ ( parseInt($('#divOptionMain').children('div').length) + 1 );
				$("#divOption1").clone().attr('id', divOptionId).appendTo("#divOptionMain");
			});
			
			$('#btnDeleteOption').click(function(){
				//$("#divOptionMain").clone().attr('id', divOptionId).appendTo("#divOptionMain");
				alert($("#divOptionMain").child('last').html());
				//if( parseInt($('#divOptionMain').children('div').length) > 0 )
					//$('#btnDeleteOption').attr('disabled','');
			});*/
			
			
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
			
			
			
			$(function(){
				
				var btnUpload2=$('#me2');
				var mestatus2=$('#mestatus2');
				var files2=$('#files');
				var user = $('#extFileName.value');
				new AjaxUpload(btnUpload2, {
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
								mestatus2.text(file);
								//On completion clear the status
								files2.html('');
								//Add uploaded file to list
								if(response==="error"){
									$('<li></li>').appendTo('#files2').text(file).addClass('error');
									} else{
										$('<li></li>').appendTo('#files2').html('<img id="uploadedImage" src="option_images/___'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="option_images/___'+file+'" id="img_src" name="img_src"/><br />').addClass('success');
									}
								}
							});
				});
			
		/*-------------------------------------------------------------------------------------------------------------*/
		/*-------------------------- Image upload as options for a mailform field -------------------------------------*/
			
			
			
		});
	 $.noConflict();
	 
	 function addMore(obj)
	 {
	 	var divOptionMain=$(obj).parent().parent().parent().parent();
		alert(divOptionMain.attr('id'));
	 }
	 		
	</script>
    <script type="text/javascript">
	function add_fieldset(){
		$('#new_fieldset_div').toggle(400);
	}
	function add_field(){
		$('#new_field_div').toggle(400);
	}
	function delete_fieldset(formid,fieldsetid,site_url){
		if(confirm("If you delete this fieldset the all fields and informations of this fieldset will be delete. Are you sure to delete this fieldset?")){
		   window.location = site_url+'edit_form.php?form_id='+formid+'&del_fieldset='+fieldsetid;	
		}
	}
	function delete_field(formid,fieldid,site_url){
		if(confirm("Are you sure to delete this field?")){
		   window.location = site_url+'edit_form.php?form_id='+formid+'&del_field='+fieldid;	
		}
	}
	function delete_field_option(formid,fieldoptionid,site_url){
		if(confirm("Are you sure to delete this option?")){
		   window.location = site_url+'edit_form.php?form_id='+formid+'&del_field_option='+fieldoptionid;	
		}
	}
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
 
 /*--------------------Edit Form----------------------------------------------------------*/
 if(isset($_POST['save_form']) && $_POST['hid_form'] == 'hid_form')	
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
	 if($thankyou_message == 'Thank You Message for Email'){$thankyou_message  = '';}
	 
	 if(($form_name!='' && $form_name!='Enter form name') && ($form_url!='' && $form_url!='Url is used to show this form in frontend'))
	 {
		 $sql = "update `forms` set `name`='".$form_name."',`url`='".$form_url."',`description`='".$form_description."',`show_in_sidebar`='".$show_in_sidebar."',`sidebar_size`='".$sidebar_size."',`email_this`='".$email_this."',`mail_to`='".$mail_to."',`thankyou_url`='".$thankyou_url."',`thankyou_message`='".$thankyou_message."',`status`='".$form_status."' where `form_id`='".$form_id."'";
		 $result = mysql_query($sql);
		 if($result)
		 {?>
		 <script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
		 <?php }
	 }
 }	
 
 /*--------------------Edit Fieldsets----------------------------------------------------------*/
 if(isset($_POST['save_fieldset']) && $_POST['save_fieldset'] == 'Save')	
 { 
	 $fieldset_name = $_POST['fieldset_name'];
	 $fieldset_position = $_POST['fieldset_position'];
	 $fieldset_status = $_POST['fieldset_status'];
	 $hid_fieldset = $_POST['hid_fieldset'];
	 
	 if(($fieldset_name!='' && $fieldset_name!='Enter fieldset name'))
	 {
      $sql = "update `form_fieldsets` set `name`='".$fieldset_name."',`position`='".$fieldset_position."',`status`='".$fieldset_status."' where `fieldset_id`='".$hid_fieldset."'";
		 $result = mysql_query($sql);
		 if($result)
		 {?>
		 <script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
		 <?php }
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
		 {?>
		 <script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
		 <?php }
	 }
 }
 
  /*------------------ Delete Fieldset----------------------------------------------------------*/ 	 
 if($_GET['del_fieldset']!='')
 {	
	$del_fieldset_id = $_GET['del_fieldset'];
	$sql = "delete from `form_data` where `fieldset_id`='".$del_fieldset_id."'";	
	$result = mysql_query($sql);
	$sql = "delete from `form_field_option` where `fieldset_id`='".$del_fieldset_id."'";	
	$result = mysql_query($sql);
	$sql = "delete from `form_fields` where `fieldset_id`='".$del_fieldset_id."'";	
	$result = mysql_query($sql); 
	$sql = "delete from `form_fieldsets` where `fieldset_id`='".$del_fieldset_id."'";	
	$result = mysql_query($sql);
	?>
	<script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
	<?php
 }
 /*--------------------Edit Field----------------------------------------------------------*/
 if(isset($_POST['save_field']) && $_POST['save_field'] == 'Save')	
 { 
	 $field_fieldset = $_POST['field_fieldset'];
	 $field_position = $_POST['field_position'];
	 /*$field_type = $_POST['field_type'];*/
	 $hid_field_type = $_POST['hid_field_type'];
	 $field_label = $_POST['field_label'];
	 $field_name = str_replace(' ','-',strtolower($_POST['field_name']));
	 $field_status = $_POST['field_status'];
	 $hid_field = $_POST['hid_field'];
	 $is_required = $_REQUEST['is_required'];
	 $email_validation = $_POST['email_validation'];
	 
	 if($hid_field_type == 'select' || $hid_field_type == 'radio' || $hid_field_type == 'checkbox')
		{
			$indx=0;
			$label_variable = 'optionlabel'.$hid_field;
			$value_variable = 'optionvalue'.$hid_field;
			
			$label_Post = $_POST[$label_variable];
			$value_Post = $_POST[$value_variable];
			
			for($k=0;$k<count($_POST[$label_variable]);$k++)
			{
				if($label_Post[$k]!='' && $value_Post[$k]!='')
				{
				$sql = "INSERT INTO `form_field_option` (`form_id` ,`fieldset_id` ,`field_id` ,`label` ,`value`) VALUES ('".$form_id."', '".$field_fieldset."', '".$hid_field."', '".$label_Post[$k]."', '".$value_Post[$k]."')";
				$result = mysql_query($sql);
				}
			}
			
			$edit_label_variable = 'edit_optionlabel'.$hid_field;
			$edit_value_variable = 'edit_optionvalue'.$hid_field;
			$edit_id_variable = 'edit_optionid'.$hid_field;
			
			$edit_label_Post = $_POST[$edit_label_variable];
			$edit_value_Post = $_POST[$edit_value_variable];
			$edit_id_Post = $_POST[$edit_id_variable];
			
			for($k=0;$k<count($_POST[$edit_label_variable]);$k++)
			{
				if($edit_label_Post[$k]!='' && $edit_value_Post[$k]!='')
				{
				$sql = "UPDATE `form_field_option` SET `label`='".$edit_label_Post[$k]."', `value`='".$edit_value_Post[$k]."' WHERE `option_id`='".$edit_id_Post[$k]."'";
				$result = mysql_query($sql);
				}
			}
		}
		
		
	if($hid_field_type == 'uploadRadio')
	{
		// ========  1).  ============================================================================ //
		// ========  Adding the images to the options table: ========================================= //
		
			if ($_POST['new_img']) {
			
				$newImages = $_POST['new_img'];
				$newDescriptions = $_POST['new_desc'];
				$newTitles = $_POST['new_tit'];
				
				for ($i=0; $i<count($newImages); $i++){	
					// Rename the image //
					$newName = strtolower($newTitles[$i]);
					$newName = trim($newName);
					$newName = str_replace(" ", "_", $newName);
					$newName = str_replace("'", "", $newName);
					$newName = str_replace('"', "", $newName);
					$newName = "./option_images/".$hid_field."_".$newName.'.png';
					
					rename($newImages[$i], $newName);
					$str = $newDescriptions[$i]."|".$newTitles[$i]."|Enabled";
					
					$sql = "INSERT INTO `form_field_option` (`form_id` ,`fieldset_id` ,`field_id` ,`label` ,`value`) VALUES ('".$form_id."', '".$field_fieldset."', '".$hid_field."', '".$newName."', '".$str."')";
					$result = mysql_query($sql);
				}
			}
		
		// ========  2).  ============================================================================ //
		// ========  Update the options table: ======================================================= //

			if ($_POST['options_img']) {
			
				$options_imgs = $_POST['options_img'];
				$options_ids = $_POST['options_ids'];
				$options_descriptions = $_POST['options_desc'];
				$options_titles = $_POST['options_tit'];
				$options_statuses = $_POST['options_stat'];
				$options_delete = $_POST['options_delete'];
			
			
			// ============= Delete the marked ================ //
				foreach ($options_delete as $ids){
					/// Delete the image ///
					$sql = "select * from `form_field_option` where `option_id`='".$ids."'";
					$result = mysql_query($sql);
					while($row = mysql_fetch_assoc($result)){
						$image = $row['label'];
					}
					
					if (file_exists($image)) {
						unlink($image);
					} 
	
					$sql = "delete from `form_field_option` where `option_id`='".$ids."'";	
					$result = mysql_query($sql);
				}
				
				
			// ============= Update description and title ================== //	
				for ($i=0; $i<count($options_imgs); $i++){
					$newValue = trim($options_descriptions[$i])."|".trim($options_titles[$i])."|Disabled";
				
					$sql2 = "UPDATE `form_field_option` SET `fieldset_id`='".$field_fieldset."', `value`='".$newValue."' WHERE `option_id`='".$options_ids[$i]."'";
					$result2 = mysql_query($sql2);
				}	
				
				
			// ============= Update statuses ================== //	
				$sql = "select * from `form_field_option` where `field_id`='".$hid_field."'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_assoc($result)){
					
					$opID = $row['option_id'];
					$value = $row['value'];
				
					if (in_array($opID, $options_statuses)){
						$value = str_replace("|Enabled", "|Enabled", $value);
						$value = str_replace("|Disabled", "|Enabled", $value);
					}else{
						$value = str_replace("|Enabled", "|Disabled", $value);
						$value = str_replace("|Disabled", "|Disabled", $value);
					}
					
					$sql2 = "UPDATE `form_field_option` SET `fieldset_id`='".$field_fieldset."', `value`='".$value."' WHERE `option_id`='".$opID."'";
					$result2 = mysql_query($sql2);
				}
			}
	
	}	
	 
	 if(($field_name!='' && $field_name!='Enter field name'))
	 {
      $sql = "update `form_fields` set `fieldset_id`='".$field_fieldset."',`position`='".$field_position."',`label`='".$field_label."' ,`name`='".$field_name."',`required`= '".$is_required."',`email_validation`='".$email_validation."',`status`='".$field_status."' where `field_id`='".$hid_field."'";
		 $result = mysql_query($sql);
		 if($result)
		 {?>
		 <script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
		 <?php }
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
	 $is_required = $_REQUEST['is_required'];
	 $email_validation = $_POST['email_validation'];
	 
	 if(($field_name!='' && $field_name!='Enter field name'))
	 {
         $sql = "insert into `form_fields` (`form_id`,`fieldset_id`,`position`,`type`,`label`,`name`,`required`,`email_validation`,`status`) values('".$form_id."','".$field_fieldset."','".$field_position."','".$field_type."','".$field_label."','".$field_name."','".$is_required."','".$email_validation."','".$field_status."')";
		 $result = mysql_query($sql);
		 $new_field_id = mysql_insert_id();
		 if($field_type == 'select' || $field_type == 'radio' || $field_type == 'checkbox')
		 {
			$indx=0;
			foreach($_REQUEST['optionlabel'] as $label)
			{
				$sql = "INSERT INTO `form_field_option` (`form_id` ,`fieldset_id` ,`field_id` ,`label` ,`value`) VALUES ('".$form_id."', '".$field_fieldset."', '".$new_field_id."', '".$label."', '".$_REQUEST['optionvalue'][$indx++]."')";
				$result = mysql_query($sql);
			}
		 }
		 
		 if($result)
		 {?>
			<script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
		 <?php }
	 }
 }	
 
 /*--------------------Delete Field----------------------------------------------------------*/ 	 
 if($_GET['del_field']!='')
 {
    $del_field_id = $_GET['del_field'];
	$sql = "delete from `form_data` where `field_id`='".$del_field_id."'";	
	$result = mysql_query($sql);
	$sql = "delete from `form_field_option` where `field_id`='".$del_field_id."'";	
	$result = mysql_query($sql);
	$sql = "delete from `form_fields` where `field_id`='".$del_field_id."'";	
	$result = mysql_query($sql);	
	?>	 
	<script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
<?php } ?>
<?php 
 /*--------------------Delete Field Option----------------------------------------------------------*/ 	 
 if($_GET['del_field_option']!='')
 {
    $del_field_option_id = $_GET['del_field_option'];	
	$sql = "delete from `form_field_option` where `option_id`='".$del_field_option_id."'";	
	$result = mysql_query($sql);	
	?>	 
	<script>window.location = "<?php echo $Site_Url;?>edit_form.php?form_id="+<?php echo $form_id;?></script>
<?php }?>

<div class="main">
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


		  
	<!------------------------------------------------------------------------------------------->          	  
	<!----------------------Edit Form------------------------------------------------------------> 
	
         <div>
              <h2 style="clear:both; padding:23px 0 1px;"><?php echo $lang_array['Edit Form']; ?></h2>
              <?php
				 $sql = "select * from `forms` where `form_id`='".$form_id."'";  
				 $result = mysql_query($sql);
				 if(mysql_num_rows($result))
				 {
					 while($row = mysql_fetch_assoc($result))
					 {
						 $form_name = $row['name'];
						 $form_url = $row['url'];
						 $form_description = $row['description'];
						 $show_in_sidebar = $row['show_in_sidebar'];
	                     $sidebar_size = $row['sidebar_size'];
						 $email_this  = $row['email_this'];
	                     $mail_to  = $row['mail_to'];
						 $thankyou_url = $row['thankyou_url'];
						 $thankyou_message = $row['thankyou_message'];
						 $form_status = $row['status'];
					 }
				?>
          <form name="new_form" id="new_form" action="" method="post" onsubmit="return validateForm()">
            <table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
					
					<tr><!------------------------------ NAME ----------------------------------->
						<td width="20%">
							<div data-tip="<?php echo $lang_array['EDIT - FORM NAME - Tooltip']; ?>" >
								<?php echo $lang_array['Name:']; ?>
							</div>
						</td>
						<td width="80%">
							<div data-tip="<?php echo $lang_array['EDIT - FORM NAME - Tooltip']; ?>" >
								<input type="text" name="form_name" id="form_name" onblur="if(this.value=='')this.value='Enter form name';" onfocus="if(this.value=='Enter form name')this.value='';" value="<?php if($form_name!=''){ echo $form_name;}else{ echo 'Enter form name';}?>" size="50">
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ URL ----------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM URL - Tooltip']; ?>" >
								<?php echo $lang_array['Url / Identifier:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM URL - Tooltip']; ?>" >
								<input type="text" name="form_url" id="form_url" onblur="if(this.value=='')this.value='Url is used to show this form in frontend';" onfocus="if(this.value=='Url is used to show this form in frontend')this.value='';" value="<?php if($form_url!=''){ echo $form_url;}else{ echo 'Url is used to show this form in frontend';}?>" size="50">
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ DESCRIPTION --------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM DESCRIPTION - Tooltip']; ?>" >
								<?php echo $lang_array['Description:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM DESCRIPTION - Tooltip']; ?>" >
								<textarea name="form_description" id="form_description" rows="5" cols="100"><?php echo $form_description;?></textarea>
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ Show in siderbar? ---------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM SIDEBAR - Tooltip']; ?>" >
								<?php echo $lang_array['Show in sidebar?:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM SIDEBAR - Tooltip']; ?>">
								<select name="show_in_sidebar" onchange="show_sidebar(this.value);" style="float:left;">
										<option value="0" <?php if($show_in_sidebar=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No']; ?></option>
										<option value="1" <?php if($show_in_sidebar=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes']; ?></option>
								</select>
								<div style="display:<?php if($show_in_sidebar!='0'){?>block<?php }else{?>none<?php } ?>; float:left;" id="tr_sidebar_size">
									<span style="float:left; padding:0 20px 0 50px;">Sidebar size(px):</span>
									<input type="text" name="sidebar_size" id="sidebar_size" onblur="if(this.value=='')this.value='Enter sidebar size';" onfocus="if(this.value=='Enter sidebar size')this.value='';" value="<?php if($sidebar_size!=''){ echo $sidebar_size;}else{ echo 'Enter sidebar size';}?>" size="50">
								</div>
							<div>
						</td>
					</tr>
					
					<tr><!------------------------------ NEED TO E-MAIL THIS FORM? ----------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM SEND MAIL - Tooltip']; ?>" >
								<?php echo $lang_array['Need to email this form?:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM SEND MAIL - Tooltip']; ?>" >
								<select name="email_this" onchange="email_form(this.value);" style="float:left;">
									<option value="0" <?php if($email_this=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No']; ?></option>
									<option value="1" <?php if($email_this=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes']; ?></option>
								</select>
								<div style="display:<?php if($mail_to!=''){?>block<?php }else{?>none<?php } ?>; float:left;" id="tr_mail_to">
									<span style="float:left; padding:0 20px 0 50px;">Mail To:</span>
									<input type="text" name="mail_to" id="mail_to" onblur="if(this.value=='')this.value='Enter email where need to send';" onfocus="if(this.value=='Enter email where need to send')this.value='';" value="<?php if($mail_to!=''){ echo $mail_to;}else{ echo 'Enter email where need to send';}?>" size="50">
								</div>
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ THANK YOU URL -------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM THANK URL - Tooltip']; ?>" >
								<?php echo $lang_array['Thank You Url:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM THANK URL - Tooltip']; ?>" >
								<input type="text" name="thankyou_url" id="thankyou_url" onblur="if(this.value=='')this.value='Thank you url';" onfocus="if(this.value=='Thank you url')this.value='';" value="<?php if($thankyou_url!=''){ echo $thankyou_url;}else{ echo 'Thank you url';}?>" size="50">
							</div>
						</td>
					</tr>

					<tr><!------------------------------ EMAIL THANK YOU MESSAGE ----------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM MAIL THANK - Tooltip']; ?>" >
								<?php echo $lang_array['Thank You Message for Email:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM MAIL THANK - Tooltip']; ?>" >
								<input type="text" name="thankyou_message" id="thankyou_message" onblur="if(this.value=='')this.value='Thank You Message for Email';" onfocus="if(this.value=='Thank You Message for Email')this.value='';" value="<?php if($thankyou_message!=''){ echo $thankyou_message;}else{ echo 'Thank You Message for Email';}?>" size="117">
							</div>
						</td>
					</tr>
						
					<tr><!------------------------------ FORM STATUS ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM STATUS - Tooltip']; ?>" >
								<?php echo $lang_array['Status:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FORM STATUS - Tooltip']; ?>" >
								<select name="form_status">
									<option value="1" <?php if($form_status=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Enable']; ?></option>
									<option value="0" <?php if($form_status=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['Disable']; ?></option>
								</select>
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ SAVE FORM - SUBMIT BUTTON ----------------------------->
						<td>&nbsp;</td>
						<td>
							<input type="hidden" name="hid_form" value="hid_form">
							<input type="submit" class="custom-button" name="save_form" value="Save">
						</td>
					</tr>                  
                </table>
          </form>
        </div>
		
		<br/><br/><br/>
		
		
		
		
   <!----------------------------------------------------------------------------------------------------------------------->      
   <!----------------------Edit Fieldsets----------------------------------------------------------------------------------->      
                
              <?php
			  $sql_fieldset = "select * from `form_fieldsets` where `form_id`='".$form_id."' order by `position`";
			  $result_fieldset = mysql_query($sql_fieldset);
			  $fieldset_idArray = array();
			  $fieldset_nameArray = array();
			  $fieldset_statusArray = array();
			  if(mysql_num_rows($result_fieldset))
			  {?>
				<div>
					<h2><?php echo $lang_array['Edit Fieldsets']; ?></h2>
				  <?php
					  while($row_fieldset = mysql_fetch_assoc($result_fieldset))
					  { 
						 $fieldset_idArray[] = $row_fieldset['fieldset_id'];
						 $fieldset_nameArray[] = $row_fieldset['name'];
						 $fieldset_statusArray[] = $row_fieldset['status'];
						 $fieldset_name = $row_fieldset['name'];
						 $fieldset_position = $row_fieldset['position'];
						 $fieldset_status = $row_fieldset['status'];
						  ?>
						
						
						<form name="edit_fieldset" id="edit_fieldset_<?php echo $row_fieldset['fieldset_id']?>" action="" method="post" onsubmit="return validateEditFieldset('<?php echo $row_fieldset['fieldset_id']?>')">
							<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
								
								<tr><!------------------------------ FIELDSET NAME ----------------------------------------->
									<td width="20%">
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET NAME - Tooltip']; ?>" >
											<?php echo $lang_array['Name:']; ?>
										</div>
									</td>
									<td width="80%">
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET NAME - Tooltip']; ?>"  >
											<input type="text" name="fieldset_name" id="fieldset_name_<?php echo $row_fieldset['fieldset_id']?>" onblur="if(this.value=='')this.value='Enter fieldset name';" onfocus="if(this.value=='Enter fieldset name')this.value='';" value="<?php if($fieldset_name!=''){ echo $fieldset_name;}else{ echo 'Enter fieldset name';}?>" size="50">
										<div>
									</td>
								</tr>  
								
								<tr><!------------------------------ FIELDSET POSITION ----------------------------------------->
									<td>
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET POSITION - Tooltip']; ?>" >
											<?php echo $lang_array['Position:']; ?>
										<div>
									</td>
									<td>
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET POSITION - Tooltip']; ?>" >
											<input type="text" name="fieldset_position" id="fieldset_position_<?php echo $row_fieldset['fieldset_id']?>" onblur="if(this.value=='')this.value='Enter fieldset position';" onfocus="if(this.value=='Enter fieldset position')this.value='';" value="<?php if($fieldset_position!=''){ echo $fieldset_position;}else{ echo 'Enter fieldset position';}?>" size="50">
										</div>
									</td>
								</tr>   
								
								<tr><!------------------------------ FIELDSET STATUS ----------------------------------------->
									<td>	
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET STATUS - Tooltip']; ?>" >
											<?php echo $lang_array['Status:']; ?>
										</div>
									</td>
									<td>
										<div data-tip="<?php echo $lang_array['EDIT - FIELDSET STATUS - Tooltip']; ?>" >
											<select name="fieldset_status">
												<option value="1" <?php if($fieldset_status=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Enable']; ?></option>
												<option value="0" <?php if($fieldset_status=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['Disable']; ?></option>
											</select>
										</div>
									</td>
								</tr>
									
								<tr><!------------------------------ SAVE OR DELETE FIELDSET ----------------------------------------->
									<td>&nbsp;</td>
									<td>
										<input type="hidden" name="hid_fieldset" value="<?php echo $row_fieldset['fieldset_id'];?>">
										<input type="submit" name="save_fieldset" value="Save" class="custom-button">&nbsp;&nbsp;&nbsp;
										<input type="button" value="<?php echo $lang_array['Delete']; ?>" class="custom-button" onclick="delete_fieldset('<?php echo $form_id;?>','<?php echo $row_fieldset['fieldset_id'];?>','<?php echo $Site_Url;?>')">
									</td>
								</tr>  
								
							</table>
						</form>
						<br>
						
				<?php } ?>
				<input type="button" class="custom-button" value="<?php echo $lang_array['Add New Fieldset']; ?>" onclick="add_fieldset()">
			</div>
			
			<div style="display:none;" id="new_fieldset_div">
			  <br>
				<form name="new_fieldset" id="new_fieldset" action="" method="post" onsubmit="return validateFieldset();">
					
					<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
					
						<tr><!------------------------------ FIELDSET NAME ----------------------------------------->
							<td width="20%">
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET NAME - Tooltip']; ?>" >
									<?php echo $lang_array['Name:']; ?>
								</div>
							</td>
							<td width="80%">
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET NAME - Tooltip']; ?>" >
									<input type="text" name="fieldset_name" id="fieldset_name" onblur="if(this.value=='')this.value='Enter fieldset name';" onfocus="if(this.value=='Enter fieldset name')this.value='';" value="Enter fieldset name" size="50">
								</div>
							</td>
						</tr>                  
						
						<tr><!------------------------------ FIELDSET POSITION ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET POSITION - Tooltip']; ?>" >
									<?php echo $lang_array['Position:']; ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET POSITION - Tooltip']; ?>" >
									<input type="text" name="fieldset_position" onblur="if(this.value=='')this.value='Enter fieldset position';" onfocus="if(this.value=='Enter fieldset position')this.value='';" value="Enter fieldset position" size="50">
								</div>
							</td>
						</tr>                  
						
						<tr><!------------------------------ FIELDSET STATUS ----------------------------------------->
							<td>
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET STATUS - Tooltip']; ?>" >
									<?php echo $lang_array['Status:']; ?>
								</div>
							</td>
							<td>
								<div data-tip="<?php echo $lang_array['EDIT - FIELDSET STATUS - Tooltip']; ?>" >
									<select name="fieldset_status">
										<option value="1"><?php echo $lang_array['Enable']; ?></option>
										<option value="0"><?php echo $lang_array['Disable']; ?></option>
									</select>
								</div>
							</td>
						</tr>    
						
						<tr>
							<td>&nbsp;</td>
							<td>
								<input type="hidden" name="hid_fieldset" value="hid_fieldset">
								<input type="submit" name="new_fieldset" class="custom-button" value="<?php echo $lang_array['Add Fieldset']; ?>">
							</td>
						</tr>                  
					</table>
				</form>
			</div>
          <?php } ?>        
               
		<br/><br/><br/>
			   
			   
			   
			   
			   
   <!------------------------------------------------------------------------------------------------------------->      
   <!----------------------Edit Fields---------------------------------------------------------------------------->      
   
        <?php
		   $sql = "select * from `form_fields` where `form_id`='".$form_id."'";
		   $result = mysql_query($sql);
		   if(mysql_num_rows($result)){			   
		?>
        <div>
              <h2><?php echo $lang_array['Edit Fields']; ?></h2>
        <?php
		  for($i = 0; $i<count($fieldset_idArray); $i++)
		  {
		    $sql2 = "select * from `form_fields` where `fieldset_id`='".$fieldset_idArray[$i]."' order by `position`";
			$result2 = mysql_query($sql2);
			while($row2 = mysql_fetch_assoc($result2))
			{
				$field_fieldset_id = $row2['fieldset_id'];
				$field_position = $row2['position'];
				$field_type = $row2['type'];
				$field_label = $row2['label'];
				$field_name = $row2['name'];
				$field_status = $row2['status'];
				$field_required = $row2['required'];
				$email_validation = $row2['email_validation'];
				$jsString='';
		?>      
              <form name="edit_field" id="edit_field_<?php echo $row2['field_id'];?>" action="" method="post" onsubmit="return validateEditfield('<?php echo $row2['field_id'];?>');">
            
				<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
					
					<tr><!------------------------------ FIELD assigned to FIELDSET ----------------------------------------->
						<td width="20%">
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
								<?php echo $lang_array['Fieldset:']; ?>
							</div>
						</td>
						<td width="80%">
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
								<select name="field_fieldset">
									<?php
									 for($j = 0; $j<count($fieldset_nameArray); $j++){?>
									 <?php if($fieldset_statusArray[$j]=='1'){?>
										<option value="<?php echo $fieldset_idArray[$j];?>" <?php if($fieldset_idArray[$j]==$field_fieldset_id){?> selected="selected"<?php } ?>><?php echo $fieldset_nameArray[$j];?></option>
									 <?php }?> 
									<?php } ?>
								</select>
							</div>
						</td>
					</tr>              
             
					<tr><!------------------------------ FIELD POSITION ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-POSITION - Tooltip']; ?>" >
								<?php echo $lang_array['Position:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-POSITION - Tooltip']; ?>" >
								<input type="text" name="field_position" onblur="if(this.value=='')this.value='Enter field position';" onfocus="if(this.value=='Enter field position')this.value='';" value="<?php if($field_position!=''){ echo $field_position;}else{ echo 'Enter field position';}?>" size="50">
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ FIELD TYPE ------------------------------------------>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD TYPE - Tooltip']; ?>" >
								<?php echo $lang_array['Type:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD TYPE - Tooltip']; ?>" >
								<select name="field_type" disabled="disabled">
									<option value="text"<?php if($field_type == 'text'){?> selected="selected"<?php } ?>><?php echo $lang_array['Text']; ?></option>
									<option value="radio"<?php if($field_type == 'radio'){?> selected="selected"<?php } ?>><?php echo $lang_array['Radio']; ?></option>
									<option value="checkbox"<?php if($field_type == 'checkbox'){?> selected="selected"<?php } ?>><?php echo $lang_array['Checkbox']; ?></option>
									<option value="select"<?php if($field_type == 'select'){?> selected="selected"<?php } ?>><?php echo $lang_array['Select']; ?></option>
									<option value="textarea"<?php if($field_type == 'textarea'){?> selected="selected"<?php } ?>><?php echo $lang_array['Textarea']; ?></option>
								</select>
								<input type="hidden" name="hid_field_type" value="<?php echo $field_type;?>">
							</div>
						</td>
					</tr> 
					
					<tr><!------------------------------ FIELD REQUIRED --------------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD REQUIRED - Tooltip']; ?>" >
								<?php echo $lang_array['Is Required:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD REQUIRED - Tooltip']; ?>" >
								<select name="is_required">
									<option value="0"<?php if($field_required == '0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No']; ?></option>
									<option value="1"<?php if($field_required == '1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes']; ?></option>
								</select>
							</div>
						</td>
					</tr> 
					
					<tr><!------------------------------ FIELD EMAIL VALIDATION ---------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
								<?php echo $lang_array['Email Validation Required?:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
								<select name="email_validation">
									<option value="0"<?php if($email_validation == '0'){?> selected="selected"<?php } ?>><?php echo $lang_array['No']; ?></option>
									<option value="1"<?php if($email_validation == '1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Yes']; ?></option>
								</select>
							</div>
						</td>
					</tr>
				  
					<tr><!------------------------------ FIELD LABEL ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD LABEL - Tooltip']; ?>" >
								<?php echo $lang_array['Label:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD LABEL - Tooltip']; ?>" >
								<input type="text" name="field_label" id="field_label_<?php echo $row2['field_id'];?>" onblur="if(this.value=='')this.value='Enter field label';" onfocus="if(this.value=='Enter field label')this.value='';" value="<?php if($field_label!=''){ echo $field_label;}else{ echo 'Enter field label';}?>" size="50">
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ FIELD NAME ------------------------------------------>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD NAME - Tooltip']; ?>" >
								<?php echo $lang_array['Name:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD NAME - Tooltip']; ?>" >
								<input type="text" name="field_name" id="field_name_<?php echo $row2['field_id'];?>" onblur="if(this.value=='')this.value='Enter field name';" onfocus="if(this.value=='Enter field name')this.value='';" value="<?php if($field_name!=''){ echo $field_name;}else{ echo 'Enter field name';}?>" size="50">
							</div>
						</td>
					</tr>              
					
					<tr><!------------------------------ FIELD STATUS ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD STATUS - Tooltip']; ?>" >
								<?php echo $lang_array['Status:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD STATUS - Tooltip']; ?>" >
								<select name="field_status">
									<option value="1" <?php if($field_status=='1'){?> selected="selected"<?php } ?>><?php echo $lang_array['Enable']; ?></option>
									<option value="0" <?php if($field_status=='0'){?> selected="selected"<?php } ?>><?php echo $lang_array['Disable']; ?></option>
								</select>
							</div>
						</td>
					</tr>
			  
							  <?php if($field_type == 'radio' || $field_type == 'select' || $field_type == 'checkbox'){?>
							  
							  <script type="text/javascript">
							  $(function() {
								$('#btnAddOption<?php echo $row2['field_id'];?>').click(function(){
								var divOptionId="divOption<?php echo $row2['field_id'];?>_"+ ( parseInt($('#divOptionMain<?php echo $row2['field_id'];?>').children('div').length) + 1 );
								$("#divOption<?php echo $row2['field_id'];?>").clone().attr('id', divOptionId).appendTo("#divOptionMain<?php echo $row2['field_id'];?>");
								});
							
								$('#btnDeleteOption<?php echo $row2['field_id'];?>').click(function(){
									if(parseInt($('#divOptionMain<?php echo $row2['field_id'];?>').children('div').length) > 2)
										$('#divOptionMain<?php echo $row2['field_id'];?>').children('div:last').remove();

								});
								});
							  </script>
			  
					<tr>
						<td colspan="2">
							<div style="border:1px solid #2F5F71;padding:4px;" id="divOptionMain<?php echo $row2['field_id'];?>">
								<span>
									<input type="button" class="custom-button" id="btnAddOption<?php echo $row2['field_id'];?>" value="<?php echo $lang_array['Add Option']; ?>" />&nbsp;&nbsp;
									<input type="button" class="custom-button" id="btnDeleteOption<?php echo $row2['field_id'];?>" value="<?php echo $lang_array['Delete Option']; ?>" />
								</span>
								<div>
								<?php
								 $fieldOptionSql = "SELECT * FROM `form_field_option` WHERE `field_id`='".$row2['field_id']."' AND `form_id`='".$form_id."'";
								 $fieldOptionResult = mysql_query($fieldOptionSql);
								 mysql_num_rows($fieldOptionResult);
								 if(mysql_num_rows($fieldOptionResult)){
									 while($fieldOptionRow = mysql_fetch_array($fieldOptionResult)){
								?>
									<div style="position:relative; padding:4px 0 5px 0;">
										<div data-tip="<?php echo $lang_array['EDIT - CHANGE OPTION LABEL - Tooltip']; ?>" style="display:inline;">
											<span>
												<?php echo $lang_array['Label:']; ?> 
												<input type="text" name="edit_optionlabel<?php echo $row2['field_id'];?>[]" id="" value="<?php echo $fieldOptionRow['label'];?>" style="min-width:300px;" />
											</span>
										</div>
										<div data-tip="<?php echo $lang_array['EDIT - CHANGE OPTION VALUE - Tooltip']; ?>" style="display:inline;">
											<span>
												<?php echo $lang_array['Value:']; ?> 
												<input type="text" name="edit_optionvalue<?php echo $row2['field_id'];?>[]" id="" value="<?php echo $fieldOptionRow['value'];?>" style="min-width:300px;" />
											</span>
										</div>
										<div data-tip="<?php echo $lang_array['EDIT - DELETE OPTION - Tooltip']; ?>" style="display:inline;">
											<span>
												<a href="javascript:void(0)">
													<img src="<?php echo $Site_Url;?>images/delete.png" alt="" width="30" height="30" title="Delete Option" onclick="delete_field_option('<?php echo $form_id;?>','<?php echo $fieldOptionRow['option_id'];?>','<?php echo $Site_Url;?>')" style="position:absolute; top:-30px; margin:10px;"/>
												</a>
											</span>
										</div>
										<input type="hidden" name="edit_optionid<?php echo $row2['field_id'];?>[]" id="" value="<?php echo $fieldOptionRow['option_id'];?>"/>
									</div>
								  <?php } } ?>  
								</div>
								
								<div id="divOption<?php echo $row2['field_id'];?>">
									<div>
									<span><?php echo $lang_array['Label:']; ?><input type="text" style="min-width:300px;" name="optionlabel<?php echo $row2['field_id'];?>[]" id="" value=""/></span>
									<span><?php echo $lang_array['Value:']; ?><input type="text" style="min-width:300px;" name="optionvalue<?php echo $row2['field_id'];?>[]" id="" value=""/></span>									
									</div>
								</div>
							</div>
						</td>
					</tr>
			  
					<?php } ?>
					
					
					
					<?php 
					if($field_type == 'uploadRadio'){
					?>
					<tr>
						<td colspan="2">
					
							<div id="divUploadedOptions">
								<div style="display:block; margin:10px;">
									
									<div data-tip="<?php echo $lang_array['NEW FIELD - SAVED OPTIONS - Tooltip']; ?>" style="border-bottom:1px solid #2F5F71; margin-bottom: 5px;" >
										<?php echo $lang_array['Uploaded / available options:'] ?>
									</div>
									
									<?php
										
										$sql = "select * from `form_field_option` WHERE `form_id`='".$form_id."' AND `fieldset_id`='".$field_fieldset_id."' AND `field_id`='".$row2['field_id']."'";
										$result_options = mysql_query($sql);
									
									?>
										
									<table  id="optionsTable<?php ///echo $tableCounter; ?>" align="center" border="3" width="900px">
										<thead>
											<td> <?php echo $lang_array['Image']; ?> </td>
											<td> <?php echo $lang_array['Description']; ?> </td>
											<td> <?php echo $lang_array['Option Title']; ?> </td>
											<td> <?php echo $lang_array['Status']; ?> </td>
											<td> <?php echo $lang_array['Delete']; ?> </td>
										</thead>
										
										<tbody>
											<?php												
												if(mysql_num_rows($result_options)){
													while($row = mysql_fetch_array($result_options)){
														
														$label = $row['label'];
														$value = $row['value'];
														$optionID = $row['option_id'];
														
														$value = explode("|", $value);
														
														?>
														<tr>
															<td> 
																<img src='<?php echo $label; ?>' height="70" style="padding:4px; border:1px solid #aaa; background:white;"  />
																<input type='hidden' name='options_img[]' value="<?php echo $label; ?>" />
																<input type='hidden' name='options_ids[]' value="<?php echo $optionID; ?>" />
															</td>
															<td> 
																<textarea name='options_desc[]' style="width:350px; padding:5px;" ><?php echo $value[0]; ?> </textarea>
															</td>
															<td> 
																<input type="text" name='options_tit[]' value='<?php echo $value[1]; ?>' />
															</td>
															<td> 
																<?php if($value[2] == 'Enabled') { ?>
																	<input type='checkbox' name='options_stat[]' value='<?php echo $optionID; ?>' CHECKED />
																<?php } else { ?>
																	<input type='checkbox' name='options_stat[]' value='<?php echo $optionID; ?>'  />
																<?php } ?>
															</td>
															<td> 
																<input type='checkbox' name='options_delete[]' value='<?php echo $optionID; ?>'  />
															</td>
														</tr>
														<?php
													}
												}
											?>
										</tbody>
									</table>
									
									
									<br/><br/>
									<div data-tip="<?php echo $lang_array['NEW FIELD - SAVED OPTIONS - Tooltip']; ?>" style="border-bottom:1px solid #2F5F71; margin-bottom: 5px;" >
										<?php echo $lang_array['Uploaded Images:'] ?>
									</div>
									
									<table  id="optionsTable<?php ///echo $tableCounter; ?>" align="center" border="3" width="900px">
										<thead>
											<td> <?php echo $lang_array['Image']; ?> </td>
											<td> <?php echo $lang_array['Description']; ?> </td>
											<td> <?php echo $lang_array['Option Title']; ?> </td>
										</thead>
										
										<tbody>
											<?php
											if ($handle = opendir('./option_images/')) {
												while (false !== ($entry = readdir($handle))) {
													if ($entry != "." && $entry != "..") {
																											
														$pos = strpos($entry, "___");
														if ($pos !== false) {
															?>
															<tr>
																<td> 
																	<img src='./option_images/<?php echo $entry; ?>' height='70' style="padding:4px; border:1px solid #aaa; background:white;" />
																	<input type='hidden' name='new_img[]' value="./option_images/<?php echo $entry; ?>" />
																</td>
																<td> 
																	<textarea style='width:350px;' name='new_desc[]'></textarea>
																</td>
																<td> 
																	<input type="text" name='new_tit[]' value='' />
																</td>
															</tr>
															<?php
														}
														
													}
												}
											}
											?>
										</tbody>
									</table>
								
									<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
										<div id="me" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
											<span style=" cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
												<span style=" cursor:pointer;"><?php echo $lang_array['Upload Image']; ?></span>
											</span>
										</div>
										
										<span id="mestatus" ></span>
											
										<a href="<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" style="floet:left;">
											<img src="./images/refresh1.png" width='30' />
										</a>
										<div id="files" style="margin-left:250px;">
											<li id="fileName" class="success"></li>
										</div>
									<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
									
									
								</div>
							</div>
								
						</td>
					</tr>
					<?php } ?>
					
					
			                  
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="hidden" name="hid_field" value="<?php echo $row2['field_id'];?>">
							<input type="submit" name="save_field" class="custom-button" value="Save">&nbsp;&nbsp;&nbsp;
							<input type="button" class="custom-button" value="<?php echo $lang_array['Delete']; ?>" onclick="delete_field('<?php echo $form_id;?>','<?php echo $row2['field_id'];?>','<?php echo $Site_Url;?>')"></td>
					</tr>                  
				</table>
			</form>
		  
		  
              <br>
        <?php } } ?>  
        
		
		
			<input type="button" class="custom-button" value="<?php echo $lang_array['Add New Field']; ?>" onclick="add_field()">
        </div>
            
		
		<div style="display:none;" id="new_field_div">
            <br>
            
			<form name="new_field" id="new_field" action="" method="post" onsubmit="return validateNewfield();">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="5px" class="atable">
				
					<tr><!------------------------------ FIELD assigned to FIELDSET ----------------------------------------->
						<td width="20%">
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
								<?php echo $lang_array['Fieldset:']; ?>
							</div>
						</td>
						<td width="80%">
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-FIELDSET ASSIGN - Tooltip']; ?>" >
								<select name="field_fieldset">
									<?php
									 for($j = 0; $j<count($fieldset_nameArray); $j++){?>
									 <?php if($fieldset_statusArray[$j]=='1'){?>
									  <option value="<?php echo $fieldset_idArray[$j];?>"><?php echo $fieldset_nameArray[$j];?></option>
									 <?php } ?> 
									<?php } ?>
								</select>
							</div>
						 </td>
					</tr>              
              
					<tr><!------------------------------ FIELD POSITION ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-POSITION - Tooltip']; ?>" >
								<?php echo $lang_array['Position:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD-POSITION - Tooltip']; ?>" >
								<input type="text" name="field_position" onblur="if(this.value=='')this.value='Enter field position';" onfocus="if(this.value=='Enter field position')this.value='';" value="Enter field position" size="50">
							</div>
						</td>
					</tr>              
                
					<tr><!------------------------------ FIELD TYPE ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD TYPE - Tooltip']; ?>" >
								<?php echo $lang_array['Type:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD TYPE - Tooltip']; ?>" >
								<select name="field_type" id="field_type_new">
									<option value="text"><?php echo $lang_array['Text']; ?></option>
									<option value="radio"><?php echo $lang_array['Radio']; ?></option>
									<option value="checkbox"><?php echo $lang_array['Checkbox']; ?></option>
									<option value="select"><?php echo $lang_array['Select']; ?></option>
									<option value="textarea"><?php echo $lang_array['Textarea']; ?></option>
									
									<option value="uploadRadio"><?php echo $lang_array['Image Upload Radio'] ?></option>
								</select>
							</div>
						</td>
					</tr> 
             
					<tr><!------------------------------ FIELD REQUIRED ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD REQUIRED - Tooltip']; ?>" >
								<?php echo $lang_array['Is Required?:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD REQUIRED - Tooltip']; ?>" >
								<select name="is_required"><option value="0">
									<?php echo $lang_array['No']; ?></option>
									<option value="1"><?php echo $lang_array['Yes']; ?></option>
								</select>
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ FIELD EMAIL VALIDATION ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
								<?php echo $lang_array['Email Validation Required?:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD EMAIL VALIDATATION - Tooltip']; ?>" >
								<select name="email_validation">
									<option value="0"><?php echo $lang_array['No']; ?></option>
									<option value="1"><?php echo $lang_array['Yes']; ?></option>
								</select>
							</div>
						</td>
					</tr>
				  
				  
					<tr><!------------------------------ FIELD LABEL ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD LABEL - Tooltip']; ?>" >
								<?php echo $lang_array['Label:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD LABEL - Tooltip']; ?>" >
								<input type="text" name="field_label" id="field_label" onblur="if(this.value=='')this.value='Enter field label';" onfocus="if(this.value=='Enter field label')this.value='';" value="Enter field label" size="50">
							</div>
						</td>
					</tr>     
			  
					<tr><!------------------------------ FIELD NAME ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD NAME - Tooltip']; ?>" >
								<?php echo $lang_array['Name:']; ?>
							</div>	
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD NAME - Tooltip']; ?>" >
								<input type="text" name="field_name" id="field_name" onblur="if(this.value=='')this.value='Enter field name';" onfocus="if(this.value=='Enter field name')this.value='';" value="Enter field name" size="50">
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ FIELD STATUS ----------------------------------------->
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD STATUS - Tooltip']; ?>" >
								<?php echo $lang_array['Status:']; ?>
							</div>
						</td>
						<td>
							<div data-tip="<?php echo $lang_array['EDIT - FIELD STATUS - Tooltip']; ?>" >
								<select name="field_status">
									<option value="1"><?php echo $lang_array['Enable']; ?></option>
									<option value="0"><?php echo $lang_array['Disable']; ?></option>		
								</select>
							</div>
						</td>
					</tr>
					
					<tr><!------------------------------ FIELD OPTIONS ----------------------------------------->
						<td colspan="2">
							<div style="border:1px solid #2F5F71;display:none;padding:4px;" id="divOptionMain">
								<span>
									<input type="button" class="custom-button" id="btnAddOption" value="<?php echo $lang_array['Add Option']; ?>" />&nbsp;&nbsp;
									<input type="button" class="custom-button" id="btnDeleteOption" value="<?php echo $lang_array['Delete Option']; ?>" />
								</span>
								<div id="divOption1">
									<div>
										<div data-tip="<?php echo $lang_array['EDIT - OPTION LABEL - Tooltip']; ?>" style="display:inline;" >
											<span><?php echo $lang_array['Label:']; ?> 
												<input type="text" name="optionlabel[]" id="label1" style="min-width:350px;" />
											</span>
										</div>
										<div data-tip="<?php echo $lang_array['EDIT - OPTION VALUE - Tooltip']; ?>" style="display:inline;" >
											<span><?php echo $lang_array['Value:']; ?> 
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
								<div id="divUploadOptions" style="display:none;>
									<div style="display:block; margin:10px;">
										
										<div data-tip="<?php echo $lang_array['NEW FIELD - UPLOAD IMAGES - Tooltip']; ?>" style="border-bottom:1px solid #2F5F71; margin-bottom: 5px;" >
											<?php echo $lang_array['Upload your images for the mailform:'] ?>
										</div>
										
										<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
											<div id="me2" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
												<span style=" cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
													<span style=" cursor:pointer;"><?php echo $lang_array['Upload Image']; ?></span>
												</span>
											</div>
											
											<span id="mestatus2" ></span>
												
											<div id="files2" style="margin-left:250px;">
												<li id="fileName2" class="success"></li>
											</div>
										<!-- ============================= UPLOAD A NEW OPTION ====================================== -->
										
									</div>
								</div>
							</td>
						</tr>
					
					<tr>
						<td>&nbsp;</td>
						<td>
							<input type="hidden" name="hid_field" value="hid_field">
							<input type="submit" class="custom-button" name="new_field" value="<?php echo $lang_array['Add Field']; ?>">
						</td>
					</tr>                  
                </table>
          </form>
            </div>
        <?php } ?>        
                
        <?php }
		else{
			echo '<label class="otherlabel">Invalid form id.</label>';
		}?>
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