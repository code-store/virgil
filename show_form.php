<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<title>Show Form</title>
	<script src="js/jquery-1.7.1.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	<script src="js/ajaxScripts.js"></script>
	<link rel="stylesheet" href="css/jquery.ui.theme.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
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
		});
	 $.noConflict();		
	</script>
    <script type="text/javascript">
	function add_fieldset(){
		$('#new_fieldset_div').toggle(400);
	}
	function add_field(){
		$('#new_field_div').toggle(400);
	}
	function delete_fieldset(formid,fieldsetid){
		if(confirm("Are you sure to delete this fieldset?")){
		   window.location = 'http://www.facebook-shopper.nl/e-shop/edit_form.php?form_id='+formid+'&del_fieldset='+fieldsetid;	
		}
	}
	function delete_field(formid,fieldid){
		if(confirm("Are you sure to delete this field?")){
		   window.location = 'http://www.facebook-shopper.nl/e-shop/edit_form.php?form_id='+formid+'&del_field='+fieldid;	
		}
	}
	</script>
    <style type="text/css">
		.fieldset {
			border-radius: 12px 12px 12px 12px !important;
		}
		.fieldset {
			background: none repeat scroll 0 0 #FBFAF6 !important;
			border: 1px solid #BBAFA0 !important;
			margin: 15px 0 !important;
			padding: 22px 25px 12px 33px !important;
		}
		.fieldset .legend {
			background: none repeat scroll 0 0 #F9F3E3 !important;
			border: 1px solid #F19900 !important;
			color: #E76200 !important;
			float: left !important;
			font-size: 13px !important;
			font-weight: bold !important;
			margin: -33px 0 0 -10px !important;
			padding: 0 8px !important;
			position: relative !important;
		}
		.fieldset table{border:none !important;}
	</style>	
	</head>

	<body>
<?php
	error_reporting(0);
	session_start();
	
	if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) {

	include 'config.php';
	

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

 if($form_id)
 {
	$sql = "SELECT * FROM `forms` WHERE `form_id` = '".$form_id."'"; 
	$result = mysql_query($sql);
	if(mysql_num_rows($result))
	{
	 $row = mysql_fetch_assoc($result);
	 $form_name = $row['name'];	 
	}
 }

?>
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
       <div align="center"><h1 style="color:#E35E28;clear:both; padding:23px 0 1px; text-decoration:underline;">Form: <?php echo $form_name;?></h1></div>
      <?php
	    $sql = "SELECT * FROM `form_data` where `form_id`='".$form_id."' GROUP BY `time` ORDER BY `time` DESC";
		$result = mysql_query($sql);
		if(mysql_num_rows($result))
		{
		 	while($row = mysql_fetch_array($result))
			{
			   $time = $row['time'];			   
			 ?>  
			   <h2 style="margin-top:50px;"><?php echo $lang_array['Filled At:']." ".date('d-m-Y h:m:i',$time)?></h2>
               <div>
               <?php
			     $fieldsetSql = "SELECT * FROM `form_data` where `time`='".$time."' GROUP BY `fieldset_id` ORDER BY `id`";
				 $fieldsetResult = mysql_query($fieldsetSql);
				 while($row = mysql_fetch_array($fieldsetResult))
			     {
			       $fieldset_id = $row['fieldset_id'];
				   $FieldsetSQL = "SELECT * FROM `form_fieldsets` where `fieldset_id`='".$fieldset_id."'";
				   $FieldsetResult = mysql_query($FieldsetSQL);
				   $FieldsetRow = mysql_fetch_array($FieldsetResult);
			   ?>
               <fieldset class="fieldset">
                  <legend class="legend"><?php echo $FieldsetRow['name']; ?></legend>
                <table cellpadding="10px" cellspacing="0" width="100%">
            <?php   
			   $sql2 = "SELECT * FROM `form_data` where `time`='".$time."' AND `fieldset_id`='".$fieldset_id."' ORDER BY `id` ASC";
		       $result2 = mysql_query($sql2);
			   while($formrow = mysql_fetch_array($result2))
			   {
				   $fielId = $formrow['field_id'];
				   $fieldsql = "SELECT * FROM `form_fields` WHERE `field_id`='".$fielId."'";
				   $fieldresult = mysql_query($fieldsql);
				   $fieldRow = mysql_fetch_array($fieldresult);
				   ?>
				 <tr>
					<td width="20%">
						<?php echo $fieldRow['label'];?>:
					</td>
					<td width="80%">
						<?php 
							$fieldValue = $formrow['value'];
							
							$pos = strpos($fieldValue, 'ProductID:');
							$pos2 = strpos($fieldValue, 'OptionID:');
							
							if (($pos === false) && ($pos2 === false)) {
								
								echo stripslashes($fieldValue);
							
							} else {
							
								if ($pos !== false){
									/// ========== Is a product -> Show: Image, Product Name, SKU ============= ///
										$fieldValue = explode(":", $fieldValue);
										$sqlP = "SELECT * FROM `products` where `product_id`=".$fieldValue[1];
										$resultP = mysql_query($sqlP);
										
										while($db_row = mysql_fetch_array($resultP)){
											$name = $db_row['product_name'];
											$sku = $db_row['sku'];
											$image = $db_row['image'];
										}
										
										?>
											<div style="float:left; width:90%;">
												<img src=".<?php echo $image; ?>" height="70" style="float:left; padding:4px; border:1px solid #ccc;" />
												<p style="float:left; padding:5px 10px;"><b><?php echo $name; ?></b></p>
												<br/><br/>
												<p style="float:left; padding:5px 10px;"><?php echo "<b>SKU:</b> ".$sku; ?></p>
											</div>
										<?php
									/// ========== Is a product -> Show: Image, Product Name, SKU ============= ///
								}
								
								if ($pos2 !== false){
									/// ========== Is an uploaded item -> Show: Image, Title, Description ============= ///
										$fieldValue = explode(":", $fieldValue);
										$sqlP = "SELECT * FROM `form_field_option` where `option_id`=".$fieldValue[1];
										$resultP = mysql_query($sqlP);
										
										while($db_row = mysql_fetch_array($resultP)){
											$image = $db_row['label'];
											$details = $db_row['value'];
											
											$details = explode("|", $details);
										}
										
										?>
											<div style="float:left; width:90%;">
												<img src="<?php echo $image; ?>" height="70" style="float:left; padding:4px; border:1px solid #ccc;" />
												<p style="float:left; padding:5px 10px; max-width:70%; border:none; margin:0px;"><b><?php echo $details[1]; ?></b></p>
												<br/><br/>
												<p style="float:left; padding:5px 10px; max-width:70%; border:none; margin:0px;"><?php echo "<b><u>Template omschrijving:</u></b> ".$details[0]; ?></p>
											</div>
										<?php
									/// ========== s an uploaded item -> Show: Image, Title, Description ============= ///
								}
							}
						?>
					</td>
                 </tr>
	     <?php } ?>
                </table>
               </fieldset> 
           <?php } ?> 
               </div>
         <?php
			}
		}
		else
		{
		   echo $lang_array['This form not submitted yet.'];	
		}
	  ?>
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