<?php
error_reporting(0);
if (!isset($_SESSION)) {session_start();}
if ((isset($_SESSION['UserName'])) && (isset($_SESSION['Deals_password']))) {

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

	<title>Pro Social Ads</title>


	<script src="js/jquery-1.7.1.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	<script src="js/ajaxScripts.js"></script>
	<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="./tinymce/examples/lists/image_list.js"></script>
	<script type="text/javascript" src="js/jscolor.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "exact",
			elements : "elm2,elm3,elm4",
			theme : "advanced",
			relative_urls : false,
			plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,|,image,jbimages,|,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			//content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>
	<!-- /TinyMCE -->


	<link rel="stylesheet" href="css/jquery.ui.theme.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css"/>
	<?php
		if ($tooltip_status == 1){	
			?>
			<link rel="stylesheet" type="text/css" href="css/css-tooltips.css"/>
			<?php
		}
		?>	
	<link rel="stylesheet" type="text/css" href="css/tabcontent.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
	<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />



	<script>
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
		
		$(function(){
			var btnUpload=$('#me');
			var mestatus=$('#mestatus');
			var files=$('#files');
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload, {
				action: 'upload.php?dir=productimages',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus.html('<img src="./product_images/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus.text(file);
					//On completion clear the status
					files.html('');
					//Add uploaded file to list
					if(response==="error"){
						$('<li></li>').appendTo('#files').text(file).addClass('error');
						} else{
								$('<li></li>').appendTo('#files').html('<img id="uploadedImage" src="product_images/'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="product_images/'+file+'" id="img_src" name="img_src"/><br />').addClass('success');
						}
				}
			});
			
		});
		
		
		/*$(function(){
			var btnUpload2=$('#me2');
			var mestatus2=$('#mestatus2');
			var files2=$('#files2');
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload2, {
				action: 'upload.php?dir=projectimages',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus2.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus2.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus2.text(file);
					//On completion clear the status
					files2.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files2').text(file).addClass('error');
							} else{
									$('<li></li>').appendTo('#files2').html('<img id="uploadedImage" src="images/projectimages/'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="images/projectimages/'+file+'" id="img_src" name="img_src"/><br />').addClass('success');
							}
				}
			});
		});*/
		
		
		$(function(){
			var btnUpload3=$('#me3');
			var mestatus3=$('#mestatus3');
			var files3=$('#files3');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload3, {
				action: 'upload.php?dir=backgrounds&location=header',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus3.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus3.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus3.text(file);
					//On completion clear the status
					files3.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files3').text(file).addClass('error');
							} else{
								$('<li></li>').appendTo('#files3').html('<img id="uploadedImage" src="images/backgrounds/header_'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="images/backgrounds/header'+file+'" id="img_src" name="img_src"/><br />').addClass('success3');
							}
				}
			});
		});
		
		/*
		$(function(){
			var btnUpload4=$('#me4');
			var mestatus4=$('#mestatus4');
			var files4=$('#files4');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload4, {
				action: 'upload.php?dir=backgrounds&location=navigbar',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus4.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus4.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus4.text(file);
					//On completion clear the status
					files4.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files4').text(file).addClass('error');
							} else{
								$('<li></li>').appendTo('#files4').html('<img id="uploadedImage" src="images/backgrounds/navigbar_'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="images/backgrounds/navigbar_'+file+'" id="img_src" name="img_src"/><br />').addClass('success4');
							}
				}
			});
		});
		*/
		
		$(function(){
			var btnUpload5=$('#me5');
			var mestatus5=$('#mestatus5');
			var files5=$('#files5');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload5, {
				action: 'upload.php?dir=backgrounds&location=banners',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus5.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus5.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus5.text(file);
					//On completion clear the status
					files5.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files5').text(file).addClass('error');
							} else{
								$('<li></li>').appendTo('#files5').html('<img id="uploadedImage" src="images/backgrounds/banners_'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="images/backgrounds/banners_'+file+'" id="img_src" name="img_src"/><br />').addClass('success5');
							}
				}
			});
		});
		
		
		$(function(){
			var btnUpload6=$('#me6');
			var mestatus6=$('#mestatus6');
			var files6=$('#files6');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload6, {
				action: 'upload.php?dir=backgrounds&location=footer',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus6.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus6.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus6.text(file);
					//On completion clear the status
					files6.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files6').text(file).addClass('error');
							} else{
								$('<li></li>').appendTo('#files6').html('<img id="uploadedImage" src="images/backgrounds/footer_'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="images/backgrounds/footer_'+file+'" id="img_src" name="img_src"/><br />').addClass('success6');
							}
				}
			});
		});
	
//		$(function(){
//			var btnUpload7=$('#me7_1');
//			var mestatus7=$('#mestatus7_1');
//			var files7=$('#files7_1');
//		
//			var user = $('#extFileName.value');
//			new AjaxUpload(btnUpload7, {
//				action: 'widget_upload.php?widg=gallery&name=gallery_1',
//				name: 'uploadfile',
//				onSubmit: function(file, ext){
//					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
//			    // extension is not allowed 
//						mestatus7.text('Only JPG, PNG or GIF files are allowed');
//						return false;
//					}
//					mestatus7.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
//				},
//				onComplete: function(file, response){
//					//On completion clear the status
//					mestatus7.text('Update Succesfull!');
//					//On completion clear the status
//					files7.html('');
//					//Add uploaded file to list
//					if(response==="error"){
//							$('<li></li>').appendTo('#files7_1').text(file).addClass('error');
//							} else{
//								$('<li></li>').appendTo('#files7_1').html('<img id="uploadedImage_1" src="widgets/gallery_1/images/'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="widget/gallery_/images/'+file+'" id="img_src_1" name="img_src"/><br />').addClass('success7');
//							}
//				}
//			});
//		});
                
                
                <?php
                for($i=1;$i<=20;$i++) {
                ?>
                /***************************  Gallery button <?php echo $i?> start **************************/
                $(function(){
                    
			var btnUpload7=$('#me7_<?php echo $i?>');
			var mestatus7=$('#mestatus7_<?php echo $i?>');
			var files7=$('#files7_<?php echo $i?>');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload7, {
				action: 'widget_upload.php?widg=gallery&name=gallery_<?php echo $i?>',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus7.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus7.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus7.text('Update Succesfull!');
					//On completion clear the status
					files7.html('');
					//Add uploaded file to list
					if(response==="error"){
                                            $('<li></li>').appendTo('#files7_<?php echo $i?>').text(file).addClass('error');
                                        } else{
                                            $('<li></li>').appendTo('#files7_<?php echo $i?>').html('<img id="uploadedImage_<?php echo $i?>" src="widgets/gallery_<?php echo $i?>/images/'+file+'" alt="" height="80" width="80" /><input type="text" style="display:none;" value="widget/gallery_<?php echo $i?>/images/'+file+'" id="img_src_<?php echo $i?>" name="img_src"/><br />').addClass('success7');
                                        }
				}
			});
		});
                /***************************  Gallery button <?php echo $i?> end **************************/
                <?php
                } 
                ?>
		
		$(function(){
			var btnUpload8=$('#me8');
			var mestatus8=$('#mestatus8');
			var files8=$('#files8');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload8, {
				action: 'widget_upload.php?widg=flexbanner',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus8.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus8.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus8.text('Update Succesfull!');
					//On completion clear the status
					files8.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files8').text(file).addClass('error');
							} else{
								$('<li></li>').appendTo('#files8').html('<img id="uploadedImage" src="widgets/flexbanner/images/image.jpg" alt="" height="80" width="80" /><input type="text" style="display:none;" value="widget/flexbanner/images/image.jpg" id="img_src" name="img_src"/><br />').addClass('success8');
							}
				}
			});
		});
		
		
		$(function(){
			var btnUpload9=$('#me9');
			var mestatus9=$('#mestatus9');
			var files9=$('#files9');
		
			var user = $('#extFileName.value');
			new AjaxUpload(btnUpload9, {
				action: 'widget_upload.php?widg=flexbanner2',
				name: 'uploadfile',
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
			    // extension is not allowed 
						mestatus9.text('Only JPG, PNG or GIF files are allowed');
						return false;
					}
					mestatus9.html('<img src="./images/projectimages/ajax-loader.gif" height="16" width="16">');
				},
				onComplete: function(file, response){
					//On completion clear the status
					mestatus9.text('Update Succesfull!');
					//On completion clear the status
					files9.html('');
					//Add uploaded file to list
					if(response==="error"){
							$('<li></li>').appendTo('#files9').text(file).addClass('error');
							} else{
								//$('<li></li>').appendTo('#files9').html('<img id="uploadedImage" src="widgets/flexbanner2/images/image.jpg" alt="" height="80" width="80" /><input type="text" style="display:none;" value="widget/flexbanner2/images/image.jpg" id="img_src" name="img_src"/><br />').addClass('success9');
							}
				}
			});
		});
		
	
	</script>	
	
	<script type="text/javascript">
		function delete_form(form_id){
			if(confirm("Are you sure to delete this form?")){
				window.location = 'delete_form.php?form_id='+form_id;
			}
		}
	</script>
	
	
	<link type="text/css" href="assets/css/jquery-ui-1.8.16.custom.css"  rel="stylesheet" />
	<link type="text/css" href="assets/css/amms.css"  rel="stylesheet" />
	
	<script type="text/javascript" src="assets/js/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery-ui.nestedSortable.js"></script>
	<script type="text/javascript" src="assets/js/jquery.blockUI.js"></script>
	<script type="text/javascript" src="assets/js/jquery.query.js"></script>
	
	<script type="text/javascript" src="assets/js/amms.js"></script>
	

	<link href="css/inettuts.css" rel="stylesheet" type="text/css" />
	<link href="css/inettuts.js.css" rel="stylesheet" type="text/css" />
	
	
	<!---------------------------------------------------------------------------------->
	<!----------------- SYSTEM WIDGETS - CSS ------------------------------------------->
	
		<link href="widgets/newsletter/newsletter.css" rel="stylesheet" type="text/css" />
		<link href="widgets/flexbanner2/flexbanner2.css" rel="stylesheet" type="text/css" />
		<link href="widgets/flexbanner/flexbanner.css" rel="stylesheet" type="text/css" />
		<link href="widgets/left_navigation/left_navigation.css" rel="stylesheet" type="text/css" />
		<link href="widgets/gallery/gallery.css" rel="stylesheet" type="text/css" />
		
		
	<!----------------- SYSTEM WIDGETS - CSS ------------------------------------------->
	<!---------------------------------------------------------------------------------->
	
	
	<?php
	
	if ($_POST['widgetPageSelector']){
					
		$widgetPageSelector = $_POST['widgetPageSelector']; 
	
	//-------------------------------------------------------------------------------------//
	//------------- IF WE ACCESS THE TEMPLATE TAB & WE WANT TO VISUALIZE ------------------//
	//------------- A WIDGET PAGE -> TEMPLATE SETTINGS ------------------------------------//
						
		$sql = "SELECT * FROM widgets_pages WHERE name='".$widgetPageSelector."'";
		$result = mysql_query($sql);
	
		while ($db_field2 = mysql_fetch_assoc($result)) {
			$widgets = $db_field2['widgets'];
			$template_type = $db_field2['template_type'];
		}
	
		if ($template_type == '1column'){
			?>
				<style>
					#columns #column3, #columns #column4{
						display:none;
					}
					
					#columns #column2{
						min-height:500px;
						float:left;
					}
					
					#columns #column2 .widget, #columns #column3 .widget, #columns #column4 .widget{
						width:98%;
					}
				</style>
			
			<?php
		}
		
		if ($template_type == '2columns-left'){
			?>
				<style>
					#columns #column2{
						width:23%;
						min-height:500px;
						float:left;
					}
					
					#columns #column3{
						width:67.8%;
						min-height:500px;
						float:left;
					}
					
					#columns #column4{
						display:none;
					}
					
					#columns #column2 .widget, #columns #column3 .widget, #columns #column4 .widget{
						width:auto;
						max-width:96%;
					}
				</style>
			
			<?php
		}
		
		if ($template_type == '2columns-right'){
			?>
				<style>
					#columns #column2{
						width:67.8%;
						min-height:500px;
						float:left;
					}
					
					#columns #column3{
						width:23%;
						min-height:500px;
						float:left;
					}
					
					#columns #column4{
						display:none;
					}
					
					#columns #column2 .widget, #columns #column3 .widget, #columns #column4 .widget{
						width:auto;
						max-width:96%;
					}
				</style>
			
			<?php
		}
		
		if ($template_type == '3columns'){
			?>
				<style>
					#columns #column2{
						width:23%;
						min-height:500px;
						float:left;
					}
					
					#columns #column3{
						width:40.5%;
						min-height:500px;
						float:left;
					}
					
					#columns #column4{
						width:23%;
						min-height:500px;
						float:left;
					}
					
					#columns #column2 .widget, #columns #column3 .widget, #columns #column4 .widget{
						width:auto;
						max-width:96%;
					}
				</style>
			
			<?php
		}
		
	}
	?>	
	

   </head>

<body>


<?php

	error_reporting(0);

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
	
	<div id="supertabs">
		<table style="border:0px;">
			<tbody>
				<tr>
					<td id="pagetd"><input type="button" class="logout" id="super_page" value="Page Settings" ></td>
					<td id="widgtd"><input type="button" class="logout" id="super_widget" value="Widgets & Components"></td>
					<td id="mailtd"><input type="button" class="logout" id="super_mailform" value="Mailforms"></td>
					<td id="othetd"><input type="button" class="logout" id="super_other" value="Other Settings"></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	
	<div id="tabs">
		<ul>
			<li id="tab_pages" ><a href="#pages"><span>1</span><?php echo $lang_array['Pages'] ?></a></li>
			<li id="tab_header" ><a href="#header"><span>2</span><?php echo $lang_array['Header'] ?></a></li>
			<li id="tab_menu" ><a href="#mymenu"><span>3</span><?php echo $lang_array['Menu'] ?></a></li>
			<li id="tab_footer" ><a href="#myfooter"><span>4</span><?php echo $lang_array['Footer'] ?></a></li>
			
			
			<li id="tab_slider" ><a href="#bannerslider"><span>1</span><?php echo $lang_array['Banner Slider'] ?></a></li>
			<li id="tab_backs" ><a href="#backgrounds"><span>2</span><?php echo $lang_array['Upload Backgrounds'] ?></a></li>
			<li id="tab_widgets" ><a href="#widgets"><span>3</span>Widgets</a></li>
			<li id="tab_widgetpages" ><a href="#templates"><span>4</span>Templates and Default Pages</a></li>
			
			
			<li id="tab_mailforms" ><a href="#mail-forms"><span>1</span> Mail Forms </a></li>
			<li id="tab_sideb" ><a href="#sidebar"><span>2</span><?php echo $lang_array['Sidebar'] ?></a></li>			
			
			<li id="tab_setts" ><a href="#setts"><span>1</span><?php echo $lang_array['Settings'] ?></a></li>
			<li id="tab_tooltips" ><a href="#tooltips"><span>2</span>Tooltips</a></li>
			<li id="tab_langs" ><a href="#languages"><span>3</span><?php echo $lang_array['Language Settings'] ?></a></li>
		</ul>
		
		<script>	
		$("#super_page").click(function () {
				hideall();
				$("#tab_pages").toggle();
				$("#tab_header").toggle();
				$("#tab_menu").toggle();
				$("#tab_footer").toggle();
				$("#pagetd").css({	
									"border-color": "#2D5B91", 
									"border-width":"0px 0px 3px 0px", 
									"border-style":"solid"
								});
			});
		
		$("#super_widget").click(function () {
				hideall();
				$("#tab_slider").toggle();
				$("#tab_backs").toggle();
				$("#tab_widgets").toggle();
				$("#tab_widgetpages").toggle();
				$("#widgtd").css({	
									"border-color": "#2D5B91", 
									"border-width":"0px 0px 3px 0px", 
									"border-style":"solid"
								});
			});
			
		$("#super_mailform").click(function () {
				hideall();
				$("#tab_mailforms").toggle();
				$("#tab_sideb").toggle();
				$("#mailtd").css({	
									"border-color": "#2D5B91", 
									"border-width":"0px 0px 3px 0px", 
									"border-style":"solid"
								});
			});
			
		$("#super_other").click(function () {
				hideall();
				$("#tab_setts").toggle();
				$("#tab_tooltips").toggle();
				$("#tab_langs").toggle();
				$("#othetd").css({	
									"border-color": "#2D5B91", 
									"border-width":"0px 0px 3px 0px", 
									"border-style":"solid"
								});
			});	
			
			
			
		function hideall(){
			$("#tab_pages").hide();
			$("#tab_header").hide();
			$("#tab_menu").hide();
			$("#tab_footer").hide();
			
			$("#tab_slider").hide();
			$("#tab_backs").hide();
			$("#tab_widgets").hide();
			$("#tab_widgetpages").hide();
			
			$("#tab_mailforms").hide();
			$("#tab_sideb").hide();
			
			$("#tab_setts").hide();
			$("#tab_tooltips").hide();
			$("#tab_langs").hide();
			
			$("#pagetd").css({"border-color": "white"}); 
			$("#widgtd").css({"border-color": "white"}); 
			$("#mailtd").css({"border-color": "white"}); 
			$("#othetd").css({"border-color": "white"}); 
		}						
	</script>	
		
			
		
		
		
	
		
	<!---------------------------------------------------- HEADER CUSTOMIZATION ---------------------------------------------------------------------->		
		
		<div id="header" class="content">
			<div id="firstpage_content" class="myform steps">
			<form method="post" action="./saveHeader.php">
				<!---------------------------- HEADER SETTINGS:----------------------------->
					
				<h3><?php echo $lang_array['STEP 3: Customizing your header:'] ?></h3>	
				
				<label class="otherlabel" > <?php echo $lang_array['Choose a background for the header section: '] ?></label>
					<div class="header-options metas" data-tip="<?php echo $lang_array['Header Backgrounds - Tooltip']; ?>" >
					
						<?php
						
							$SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
							$result = mysql_query($SQL);

							$res = mysql_fetch_assoc($result); 
						
						
						if ($handle = opendir('./images/backgrounds/')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
									$flag = strpos($entry, "eader_");
									if ($flag > 0) {
									?>
									<div class="inn">
										<input type="radio" name="group1" value="<?php echo $entry; ?>" <?php if ($res['header_bg'] == $entry) echo "CHECKED"; ?> >
									
										<p><?php echo substr($entry, 0, -4); ?></p>
										<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x transparent;" ></div>
									</div>
									<?php
									}
								}
							}
							closedir($handle);
						}
						?>
						
							<?php $pos = strpos($res['header_bg'], "."); ?>
						<div class="inn" style="height: 151px;">
							<input type="radio" name="group1" value="colour" <?php if ($pos === false)  echo "CHECKED"; ?> >
							<p> <?php echo $lang_array['Colour'] ?>: </p> 
							<input class="color" style="width:60px; margin-top: 6px !important;" type="text" id="header_col" name="header_col" value="<?php if ($pos === false) { echo $res['header_bg']; } ?>"/> 
						</div>
					</div>
				
					<div class="orangespacer"></div>
				
					<div class="metas" data-tip="<?php echo $lang_array['Header Height - Tooltip']; ?>" style="display:table;" >
						<label style="width:190px;" > <?php echo $lang_array['Header Height'] ?> (Ex: 200): </label> 
						<input class="meta_input2" type="text" value="<?php echo $res['header_height']; ?>" id="header_height" name="header_height" /><br/><br/>
					</div>
					
					<div class="metas" data-tip="<?php echo $lang_array['Header Text - Tooltip']; ?>" >
						<label style="width:190px;" > <?php echo $lang_array['Header Text'] ?>: </label> 
						<input type="text" class="meta_input2" value="<?php echo $res['header_text']; ?>" id="header_text" name="header_text" /><br/>
					</div>
					
					<br/>
					<div class="metas" data-tip="<?php echo $lang_array['Google Analytics - Tooltip']; ?>" >
						<label style="width:210px;" > <?php echo $lang_array['Google Analytics Code'] ?>: </label> 
						<textarea class="meta_input_textarea" id="google_analytics" name="google_analytics" rows="15" cols="80" style="border: 2px solid #EEEEEE; border-radius: 12px 12px 12px 12px; float: left; margin-top: 20px; padding: 10px; width: 55%;"><?php echo stripslashes($res['google_analytics']); ?></textarea>
					</div>
					
					<div class="orangespacer"></div>
					
					<label class="otherlabel"> <?php echo $lang_array['Upload your logo for the website:'] ?> </label>
					<div id="me" class="styleall" style=" cursor:pointer; margin-bottom:12px;"><span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><span style="cursor:pointer;"> Upload Image </span></span></div><span id="mestatus" ></span>

					<div id="files" >
						<li id="fileName" class="success" data-tip="<?php echo $lang_array['Header - Company Logo - Tooltip']; ?>" >
							<img src="./<?php echo $res['header_img']; ?>" >
						</li>
					</div>	
						
				<!---------------- HEADER SETTINGS : END  ----------------------------------->
				
				<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Update Header'] ?>" />
			</form>
					
					
			</div>
		</div>
		
		
		
		
		
		
<!---------------------------------------------------- PAGES CUSTOMIZATION ---------------------------------------------------------------------->	
		
		<div id="pages" class="content">
			<div id="firstpage_content" class="myform steps">
				
			<h3><?php echo $lang_array['STEP 1: Create your website pages.'] ?></h3>
			
			<form method="post" action="./addPage.php" data-tip="<?php echo $lang_array['Add page - Tooltip']; ?>" style="margin-top:20px;" >
				<label id="fileNameLabel" name="fileNameLabel"><?php echo $lang_array['Add new page to the website:'] ?> </label>
				<input class="custom-input"  type="text" id="fileName" name="fileName">
				<input type="text" style="display:none;" value="elm2" id="web" name="web"/>
				
				<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Add Page']; ?>" />
			</form>
			<br/>
			
			
			<form method="post" action="./deletePage.php" data-tip="<?php echo $lang_array['Delete page - Tooltip']; ?>" >
			
				<label id="fileNameLabel" name="fileNameLabel"><?php echo $lang_array['Delete page from website:']; ?></label>
				
				<select id="fileName2" name="fileName2" class="custom-input2" onChange="">	
					<option value="">--<?php echo $lang_array['Select'] ?>--</option>
					<?php 
						$sql_p = "SELECT * FROM webpages";
						$result_p = mysql_query($sql_p);
						
						while ($db_field_p = mysql_fetch_assoc($result_p)) 
							{
								echo '<option value="'.$db_field_p['file'].'">'.$db_field_p['file'].'</option>';
							}
					?>
				</select>
				<input type="text" style="display:none;" value="elm2" id="web" name="web"/>
				
				<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Delete Page'] ?>" />
			</form>
		
			
			
			
			
			<form method="post" action="./savePage.php" style="margin-top:20px; padding-top:10px; width:100%; border-top: 1px solid #E35E28;">
				<h3><?php echo $lang_array['STEP 2: Add content to your website pages.'] ?></h3>
		
				<div style="margin-top:20px;" >
					<div data-tip="<?php echo $lang_array['Load Page - Tooltip']; ?>" >
						<label id="fileNameLabel" name="fileNameLabel"> <?php echo $lang_array['Choose the website page which you want to edit:'] ?></label> 
						<select style='float:left;' class="custom-input2" id="fileSelector2" name="fileSelector2" onChange="changeFile_website(this.options[this.selectedIndex].value)">	
							<option value="">--<?php echo $lang_array['Select']; ?>--</option>
							<?php 
								$sql_p = "SELECT * FROM webpages";
								$result_p = mysql_query($sql_p);
								
								while ($db_field_p = mysql_fetch_assoc($result_p)) 
									{
										echo '<option value="'.$db_field_p['file'].'">'.$db_field_p['file'].'</option>';
									}
							?>
						</select>
						
						<input type="button" class="custom-button" onclick=" tinyMCE.get('elm2').show(); return false;" value="<?php echo $lang_array['Load Content']; ?>"/><br/><br/>
					</div>
					
					
					<!-------------------- META TITLE - META DESCRIPTION for this page ------------------------------------->
					<div class="metas" data-tip="<?php echo $lang_array['Page title - Tooltip']; ?>" >
						<span> Page Title: </span>
						<input class="meta_input" type="text" id="new_title" name="new_title" value=""/>
					</div>
						<br/><br/>
					<div class="metas" data-tip="<?php echo $lang_array['Meta title - Tooltip']; ?>" >
						<span> Meta Title: </span>
						<input class="meta_input" type="text" id="meta_t" name="meta_t" value=""/>
					</div>
						<br/><br/>
					<div class="metas" data-tip="<?php echo $lang_array['Meta description - Tooltip']; ?>" >
						<span> Meta Description: </span>
						<input class="meta_input" type="text" id="meta_d" name="meta_d" value=""/>
					</div>
						<br/><br/>
					<div class="metas"  data-tip="<?php echo $lang_array['Meta keywords - Tooltip']; ?>" >
						<span> Meta Keywords: </span>
						<input class="meta_input" type="text" id="meta_k" name="meta_k" value=""/>
					</div>
					
					
					
					<!------------------------- TinyMCE editor. --- Begins here! ---------------->
									
					<div style="margin:20px; float:left; width:90%;" data-tip="<?php echo $lang_array['Page Content - Tooltip']; ?>" >
						<textarea id="elm2" name="elm2" rows="15" cols="80" style="width: 60%; float:left;"></textarea>
					</div>

					<!-- Some integration calls -->
					<a style="padding-left:30px;" href="javascript:;" onclick="tinyMCE.get('elm2').show();return false;">[Show]</a>
					<a href="javascript:;" onclick="tinyMCE.get('elm2').hide();return false;">[Hide]</a>
					<!------------------------- TinyMCE editor. --- ENDs here! ------------------>

					
					<table width="50%" cellspacing="0" cellpadding="5px" border="0" class="atable" style="margin:20px;">
						<tbody>
							<tr>
								<td style="min-width:300px;">
									<span style="float:left;" data-tip="<?php echo $lang_array['Is this the homepage? - Tooltip']; ?>" >
										<?php echo $lang_array['This is the HOME page?']; ?> 
									</span>
									<input type="checkbox" name="ishome" id="ishome"/>
								</td>
								<td style="max-width:500px;">
									<div class="metas" data-tip="<?php echo $lang_array['Choose the language of the page.']; ?>" >
										<select id="pageLang" name="pageLang" value="">
											<?php
												
												$SQL = "SELECT * FROM country";
												$result = mysql_query($SQL);					
											
												while ($db_field = mysql_fetch_assoc($result)) {
												
													$code = $db_field['iso2'];
													$name = utf8_encode($db_field['name']);
												
													if ( $code == $page_language ){
														?>
															<option value="<?php echo $code; ?>" selected="selected" ><?php echo $name; ?></option>
														<?php
													}
													else{
														?>
															<option value="<?php echo $code; ?>" ><?php echo $name; ?></option>
														<?php
													}
													
												}
											?>
										</select>
									</div>	
								</td>
							</tr>
						</tbody>
					</table>
						
						<div class="metas" data-tip="<?php echo $lang_array['Page Url - Tooltip']; ?>" >
							<span style="width:300px; float:left;"> <?php echo $lang_array['URL of the page: (Ex: home.html, contact.html)']; ?> </span>
							<input class="meta_input" type="text" id="urlinput" name="urlinput" value="" style="width:620px;"/>
						</div>
						
								
						<div data-tip="<?php echo $lang_array['Load Widget - Tooltip']; ?>" style="display:table; margin:30px 0px;" >
							<label> <?php echo $lang_array['Choose a template for this page:'] ?> </label>
							<select style='float:left;' class="custom-input2" id="templateSelector" name="templateSelector" >	
									<option value="">--<?php echo $lang_array['Select'] ?>--</option>
								<?php 
									$sql = "SELECT * FROM widgets_pages";
									$result = mysql_query($sql);
									
									while ($db_field = mysql_fetch_assoc($result)) {
										echo '<option value="'.$db_field['name'].'">'.$db_field['name'].'</option>';
									}
								?>
							</select>
							<input class="meta_input" type="text" id="templateSelector_input" name="templateSelector_input" value="" style="width:200px; margin-left:30px; border-radius:12px;" readonly/>
						</div>
				
						<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Submit'] ?>" />
								
				</div>
			</form>
					
					
			<div class="orangespacer"></div><br/><br/>

			<form method="post" action="./sitemap.php" style="margin-top:20px;"  data-tip="<?php echo $lang_array['Generate Sitemap - Tooltip']; ?>" >
				<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Generate Sitemap - Tooltip'];  ?>" />
			</form>
			
			<?php echo $lang_array['See the generated sitemap']; ?> <a href="./sitemap.xml" target="blank" > <?php echo $lang_array['here >>']; ?> </a>
			
					
			</div>
		</div>		
		
		
		
		
		

<!------------------------------------------------------------------------------------------------------------------------------------------------>		
<!------------------------------------------------ MANAGE FORMS ------------------------------------------------------------------------------->
		
		<div id="mail-forms" class="content">
			<div class="myform steps">
            <h3><?php echo $lang_array['STEP 10: Manage Forms']; ?></h3>            
            <?php 
			  $sql = "select * from `forms` order by `form_id`";
			  $result = mysql_query($sql);
			  if(mysql_num_rows($result)){
			?>
            <table class="atable" align="center" border="3" width="960px">								
            <thead>
                <tr>
                    <td align="center"> 
						<div data-tip="<?php echo $lang_array['Form Name - Tooltip']; ?>" >
							<?php echo $lang_array['Form Name']; ?>
						</div>
					</td>
                    <td align="center"> 
						<div data-tip="<?php echo $lang_array['Form URL - Tooltip']; ?>" >
							<?php echo $lang_array['Form Url']; ?>
						</div>
					</td>
                    <td align="center">
						<div data-tip="<?php echo $lang_array['Form Status - Tooltip']; ?>" >
							<?php echo $lang_array['Status']; ?>
						</div>
					</td>
                    <td align="center">
						<div data-tip="<?php echo $lang_array['Edit Form - Tooltip']; ?>" >
							<?php echo $lang_array['Edit']; ?> 
						</div>
					</td>
                    <td align="center"> 
						<div data-tip="<?php echo $lang_array['Delete Form - Tooltip']; ?>" >
							<?php echo $lang_array['Delete']; ?> 
						</div>
					</td>
                    <td align="center"> 
						<div data-tip="<?php echo $lang_array['View Form Results - Tooltip']; ?>" >
							<?php echo $lang_array['View Form Values']; ?>
						</div>
					</td>
                </tr>
            </thead>            
            <tbody>
             <?php while($rows = mysql_fetch_assoc($result)){?>
               <tr>
                 <td align="center"><?php echo $rows['name'];?></td>
                 <td align="center"><?php echo $rows['url'];?></td>
                 <td align="center"><?php if($rows['status']=='1'){ echo $lang_array['Enable'];}else{echo $lang_array['Disable'];}?></td>
                 <td align="center"><input type="button" class="custom-button2" value="<?php echo $lang_array['Edit']; ?>" onclick="window.location='edit_form.php?form_id=<?php echo $rows['form_id'];?>'"/></td>
                 <td align="center"><input type="button" class="custom-button2" value="<?php echo $lang_array['Delete']; ?>" onclick="delete_form('<?php echo $rows['form_id'];?>')"/></td>
                 <td align="center"><input type="button" class="custom-button2" value="<?php echo $lang_array['View']; ?>" onclick="window.location='show_form.php?form_id=<?php echo $rows['form_id'];?>'"/></td>
               </tr>
             <?php } ?>
            </tbody>
            </table>
            <?php } else{?>
            <label class="otherlabel"><?php echo $lang_array['No form created yet.']; ?></label>
            <?php }?>
            <br>
            <input type="button" class="custom-button" value="<?php echo $lang_array['Add New Form']; ?>" onclick="window.location='new_form.php'">
            </div>
        </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------>	   



	
		
		
<!---------------------------------------------------- FOOTER CUSTOMIZATION --------------------------------------------------------------------->	
		
		
		<div id="myfooter" class="content">
			<div id="firstpage_content" class="myform steps">
			
			
				<!---------------------------- FOOTER SETTINGS:----------------------------->
				<h3><?php echo $lang_array['STEP 5: Create / Update Footer'] ?></h3>	
				
				
				<!-------------------------------------------------------------------------->
				<label class="otherlabel"><?php echo $lang_array['Upload and Delete images from the Product Slider (Footer):'] ?>  </label>
				
				<span class="simple_span2" style="width:75%;"></span><br/><br/>
				
				
				
			<!-------------------------------------------------------------------------->
			<label class="otherlabel"><?php echo $lang_array['Set the background of the Product Slider:'] ?>  </label>	
				
			<form method="post" action="./saveFooter.php" style="margin-top:20px; padding-top:10px; width:100%; display:table;">
				
				<div data-tip="<?php echo $lang_array['Footer Slider Background - Tooltip']; ?>" >
				
				<?php
					if ($handle = opendir('./images/backgrounds/')) {
						while (false !== ($entry = readdir($handle))) {
							if ($entry != "." && $entry != ".." && $entry != "defaults") {
								//echo '<option value="'.$entry.'">'.$entry.'</option>';
								$flag = strpos($entry, "ooter_");
								if ($flag > 0) {
								?>
								<div class="inn">
									<input type="radio" name="group_f" value="<?php echo $entry; ?>" <?php if ($res['slider_bg'] == $entry) echo "CHECKED"; ?> >
									<p><?php echo substr($entry, 0, -4); ?></p>
									<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x transparent;" ></div>
								</div>
								<?php
								}
							}
						}
						closedir($handle);
					}
					?>
						<?php $pos = strpos($res['slider_bg'], "."); ?>
					<div style="height: 151px;" class="inn">
						<input type="radio" value="colour" name="group_f" <?php if ($pos === false) { echo "CHECKED"; } ?> >
						<p> <?php echo $lang_array['Colour'] ?>: </p> 
						<input type="text" value="<?php if ($pos === false) { echo $res['slider_bg']; } ?>" name="footer_col" id="footer_col" style="width: 60px; margin-top: 6px ! important; background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);" class="color" autocomplete="off"> 
					</div>
					
				</div>	
				
				<!-------------------------------------------------------------------------->
				<div class="orangespacer"></div>
				
				<label class="otherlabel"><?php echo $lang_array['Set the text & link in the footer, below the Product Slider:'] ?>  </label>
				<table  id="atable"  class="atable" align="center" border="3" style="width:960px;">
					<thead>
						<tr>
							
							<td>
								<h5 style="float:left;"><?php echo $lang_array['FOOTER SETTINGS:'] ?></h5> 
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td>
								<div data-tip="<?php echo $lang_array['Footer Text - Tooltip']; ?>" >
									<span class="simple_span" ><?php echo $lang_array['Text:'] ?>  </span> <input type="text" style=" width:800px;" value="<?php echo $res['footer_text']; ?>" id="footer_text" name="footer_text" />
								</div>
								
								<div data-tip="<?php echo $lang_array['Footer Text Colour - Tooltip']; ?>" >
									<span class="simple_span" > Text colour: </span> <input class="color" type="text" style=" width:800px;" value="<?php echo $res['footer_textc']; ?>" id="footer_textc" name="footer_textc" />
								</div>
								
								<div data-tip="<?php echo $lang_array['Footer Link To - Tooltip']; ?>" >
									<span class="simple_span" ><?php echo $lang_array['Link:'] ?>  </span> <input type="text" style=" width:800px;" value="<?php echo $res['footer_link']; ?>" id="footer_link" name="footer_link" />
								</div>
								<!--<span class="simple_span" > Mouse Over:  </span> <input class="color" type="text" style=" width:800px;" value="<?php echo $res['footer_textc_hover']; ?>" id="footer_textc_hover" name="footer_textc_hover" />
								<span class="simple_span" ><?php echo $lang_array['Background:'] ?>  </span> <input class="color" type="text" style=" width:800px;" value="<?php echo $res['footer_bg']; ?>" id="footer_color" name="footer_color" />-->
							</td>
						</tr>
					</tbody>
				</table>
				<!---------------- HEADER & FOOTER SETTINGS : END  ----------------------------------->
				
				<input class="custom-button" style="margin:20px; float:left;" type="submit" name="save" value="<?php echo $lang_array['Update Footer'] ?>" />
			</form>
					
					
			</div>
		</div>
	
	
		
		
		
		
		
	<!---------------------------------------------------- SETTINGS ------------------------------------------->	
		
		
		<div id="setts" class="content">
			<div id="firstpage_content" class="myform steps">
			
			<form method="post" action="./saveSettings.php">
					
				<h3><?php echo $lang_array['STEP 6: General Settings'] ?></h3>	
				
				<label class="otherlabel" data-tip="<?php echo $lang_array['Main Slider Background - Tooltip']; ?>" ><?php echo $lang_array['Set the background of the Banner Slider:'] ?>  </label>	
				
				
				<?php
					if ($handle = opendir('./images/backgrounds/')) {
						while (false !== ($entry = readdir($handle))) {
							if ($entry != "." && $entry != ".." ) {
								
								$flag = strpos($entry, "anners_");
								if ($flag > 0) {
								?>
								<div class="inn">
									<input type="radio" name="group_b" value="<?php echo $entry; ?>" <?php if ($res['banner_slider_bg'] == $entry) echo "CHECKED"; ?> >
									<p><?php echo substr($entry, 0, -4); ?></p>
									<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x transparent;" ></div>
								</div>
								<?php
								}
							}
						}
						closedir($handle);
					}
					?>
						<?php $pos = strpos($res['banner_slider_bg'], "."); ?>
					<div style="height: 151px;" class="inn">
						<input type="radio" value="colour" name="group_b" <?php if ($pos === false) { echo "CHECKED"; } ?> >
						<p> <?php echo $lang_array['Colour'] ?>: </p> 
						<input type="text" value="<?php if ($pos === false) { echo $res['banner_slider_bg']; } ?>" name="banner_col" id="banner_col" style="width: 60px; margin-top: 6px ! important; background-image: none; background-color: rgb(255, 255, 255); color: rgb(0, 0, 0);" class="color" autocomplete="off"> 
					</div>
					
				
				<!-------------------------------------------------------------------------->
				<div class="orangespacer"></div>
				
				
				
				<table  id="atable"  class="atable" align="center" border="3" style="width:960px;">
					<tbody>
						<tr>
							<td><span> <?php echo $lang_array['Background color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Page Background Color - Tooltip']; ?>" >
									<input class="color" style="width:800px;" type="text" id="backg_col" name="backg_col" value="<?php echo $res['colour']; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array["Banner Slider's height:"] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Slider Height - Tooltip']; ?>" >	
									<input style="width:800px;" type="text" id="bs_height" name="bs_height" value="<?php echo $res['banner_slider_height']; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array["Banner Slider's location:"] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Slider Location - Tooltip']; ?>" >
									<select id="show_on_this" name="show_on_this[]" onChange="" multiple  size="12">	
										<?php 
											$sql_p = "SELECT * FROM webpages";
											$result_p = mysql_query($sql_p);
											
											$marked = explode("|", $res['banner_slider_location']);
											
											while ($db_field_p = mysql_fetch_assoc($result_p)) 
												{
												  if ( in_array($db_field_p['PageID'], $marked)) {
														echo '<option value="'.$db_field_p['PageID'].'" selected="selected">'.$db_field_p['file'].'</option>';
														}
													else{
														echo '<option value="'.$db_field_p['PageID'].'" >'.$db_field_p['file'].'</option>';
														}
												}
										?>
									</select>
								</div>
							</td>
						</tr>
						<!--
						<tr>
							<td><span> Twitter URL: </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Twitter URL - Tooltip']; ?>" >
									http://<input style="width:400px;" type="text" id="twitterUrl" name="twitterUrl" value="<?php echo $res['twitterUrl']; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> Youtube URL: </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Youtube URL - Tooltip']; ?>" >
									http://<input style="width:400px;" type="text" id="youtubeUrl" name="youtubeUrl" value="<?php echo $res['youtubeUrl']; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> Facebook URL: </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Facebook URL - Tooltip']; ?>" >
									http://<input style="width:400px;" type="text" id="facebookUrl" name="facebookUrl" value="<?php echo $res['facebookUrl']; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> Blog URL: </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Blog URL - Tooltip']; ?>" >
									http://<input style="width:400px;" type="text" id="blogUrl" name="blogUrl" value="<?php echo $res['blogUrl']; ?>"/>
								</div>
							</td>
						</tr>
						-->
					</tbody>
				</table>
				
				<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Update Settings'] ?>" />
			</form>
					
					
			</div>
		</div>

		
		
		
		
		
		
	
		
		
				
		
<!--===============================================================================================================================================-->		
<!--============================================ MANAGE WIDGETS & TEMPLATES =======================================================================-->		
<!--============================================================================---================================================================-->		
		
		
		<div id="widgets" class="content">
			<div id="firstpage_content" class="myform steps">
			
				<h3><?php echo $lang_array['Create Widgets'] ?></h3>
			
				<form method="post" action="./widget-add.php" data-tip="<?php echo $lang_array['Add Widget - Tooltip']; ?>" style="margin-top:20px;" >
					
					<label><?php echo $lang_array["New Widget's Title:"] ?> </label>
					<input class="custom-input"  type="text" id="widgetName" name="widgetName">
					<br/>
					
					<label><?php echo $lang_array['Widget Identificator:'] ?> </label>
					<input class="custom-input"  type="text" id="widgetIdentificator" name="widgetIdentificator">
					<br/>
					
					<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Add Widget']; ?>" />
				</form>
		
		
				<div class="orangespacer"></div>
		
				<form method="post" action="./widget-delete.php" style="margin-top:20px; padding-top:10px; width:100%;" data-tip="<?php echo $lang_array['Delete Widget - Tooltip']; ?>" >
					<label> <?php echo $lang_array['Delete Widget:'] ?> </label>
					<select id="widgetName2" name="widgetName2" class="custom-input2" onChange="">	
									<option value="">--<?php echo $lang_array['Select'] ?>--</option>
							<?php 
								$sql = "SELECT * FROM widgets";
								$result = mysql_query($sql);
								
									while ($db_field = mysql_fetch_assoc($result)) {
										echo '<option value="'.$db_field['identificator'].'">'.$db_field['name'].'</option>';
									}
							?>
					</select>
					
					<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Delete Widget'] ?>" />
				</form>
				
				
				
				
				
				<h3><?php echo $lang_array['Edit Widgets'] ?></h3>
			
					<div style="margin-top:20px;">
						<div data-tip="<?php echo $lang_array['Load Widget - Tooltip']; ?>" >
							<label id="aBannerLabel" name="aBannerLabel"> <?php echo $lang_array['Choose a Widget which you want to edit:'] ?> </label>
							<select style='float:left;' class="custom-input2" id="fileSelector4" name="fileSelector4" onChange="changeWidget(this.options[this.selectedIndex].value)">	
										<option value="">--<?php echo $lang_array['Select'] ?>--</option>
								<?php 
										$sql = "SELECT * FROM widgets";
										$result = mysql_query($sql);
									
										while ($db_field = mysql_fetch_assoc($result)) {
											echo '<option value="'.$db_field['identificator'].'">'.$db_field['name'].'</option>';
										}
										
										//---------- SYSTEM WIDGETS -----------------------//
                                                                                $systemWidgetArr = array();
										if ($handle = opendir('widgets')) {
											while (false !== ($entry = readdir($handle))) {
                                                                                            if ($entry != "." && $entry != ".." && $entry != "contact_form" && $entry != "left_navigation" && $entry != "newsletter" ) {
                                                                                                $optionToShow = str_replace('_', ' ', $entry);
                                                                                                //echo '<option value="syst_'.$entry.'">'.ucfirst($optionToShow) .'</option>';
                                                                                                $systemWidgetArr[]='<option value="syst_'.$entry.'">'.ucfirst($optionToShow) .'</option>';
                                                                                                //echo '<option value="syst_'.$entry.'">'.ucfirst($optionToShow) .'</option>';
                                                                                            }
											}
											closedir($handle);
										}
                                                                                asort($systemWidgetArr, SORT_STRING);
                                                                                foreach($systemWidgetArr as $key){
                                                                                    echo $key;
                                                                                }
										//---------- SYSTEM WIDGETS -----------------------//
								?>
							</select>
							
							<input type="button" class="custom-button" onclick=" tinyMCE.get('elm4').show(); return false;" value="<?php echo $lang_array['Load Content'] ?>"/><br/><br/>
						</div>
						
						
						<!------------------------------------------------------------------------------------------>
						<!------------------------------------------------------------------------------------------>
						<!---------------- SYSTEM WIDGETS UPDATE SECTION ------------------------------------------->
						<?php /*?>	
						<!------------------------- GALLERY 1 START---------------------------------------------->	
							<div id="syst_gallery" style="display:none;"> 
								<div style="width:100%; display:table;">
								<label style="width:99%; text-align:left;" > UPLOAD IMAGES TO THE GALLERY: </label>
								<?php 
								if ($handle = opendir('widgets/gallery/images')) {
											while (false !== ($entry = readdir($handle))) {
												if ($entry != "." && $entry != "..") {
													?>
													<div class="inn">
														<img src="./widgets/gallery/images/<?php echo $entry?> " style="width:120px; float:left; border:1px solid #eee; padding:6px; margin:3px;"/>
														<form action="./widget_delete_uploaded.php?img=<?php echo $entry; ?>&src=gallery" method="post" >
															<input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
														</form>
													</div>
													<?php
												}
											}
											closedir($handle);
										}
								?>
								</div>
								
								<div id="me7" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
									<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
										<span style="cursor:pointer;"> Upload Image </span>
									</span>
								</div>
								
								<span id="mestatus7" ></span>

								<div id="files7" style="float:none; display:table;">
									<li id="fileName7" class="success"></li>
								</div>	
							</div>
                                                <?php */?>
						<!------------------------- GALLERY 1 END---------------------------------------------->
                                                
                                                <?php
                                                
                                                for($i=1;$i<=20;$i++){
                                                ?>
                                                <!------------------------- GALLERY 2 START---------------------------------------------->	
							<div id="syst_gallery_<?php echo $i?>" style="display:none;"> 
								<div style="width:100%; display:table;">
								<label style="width:99%; text-align:left;" > UPLOAD IMAGES TO THE GALLERY <?php echo $i?>: </label>
								<?php 
								if ($handle = opendir('widgets/gallery_'.$i.'/images')) {
                                                                    while (false !== ($entry = readdir($handle))) {
                                                                        if ($entry != "." && $entry != "..") { ?>
                                                                            <div class="inn">
                                                                                <img src="./widgets/gallery_<?php echo $i?>/images/<?php echo $entry?> " style="width:120px; float:left; border:1px solid #eee; padding:6px; margin:3px;"/>
                                                                                <form action="./widget_delete_uploaded.php?img=<?php echo $entry; ?>&src=gallery_<?php echo $i?>&action=delete_gallery_img" method="post" >
                                                                                    <input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
                                                                                </form>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    closedir($handle);
                                                                }
								?>
								</div>
								
								<div id="me7_<?php echo $i?>" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
                                                                    <span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
                                                                        <span style="cursor:pointer;"> Upload Image </span>
                                                                    </span>
								</div>
								
								<span id="mestatus7_<?php echo $i?>" ></span>

								<div id="files7_<?php echo $i?>" style="float:none; display:table;">
                                                                    <li id="fileName7_<?php echo $i?>" class="success"></li>
								</div>	
							</div>
                                                    <?php
                                                    }
                                                    ?>
						<!------------------------- GALLERY 2 END---------------------------------------------->

						
						<!------------------------- FLEXBANNER 1 ----------------------------------------->	
							<div id="syst_flexbanner" style="display:none;"> 
								<div style="width:100%; display:table;">
								<label style="width:99%; text-align:left;" > CHANGE THE BANNER IMAGE: </label>
								<?php 
								if ($handle = opendir('widgets/flexbanner/images')) {
											while (false !== ($entry = readdir($handle))) {
												if ($entry != "." && $entry != "..") {
													?>
													<div id="me8" class="styleall" style=" cursor:pointer; margin-bottom:12px; float:left;">
														<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
															<span style="cursor:pointer;"> Upload Other Image </span>
														</span>
													</div>
													
													<span id="mestatus8" ></span>

													<div id="files8" style="float:left; display:table;">
														<li id="fileName8" class="success" style="float:left; background:#fff; border:0px;">
															<img src="./widgets/flexbanner/images/<?php echo $entry?> " style="width:200px; float:left; border:1px solid #eee; padding:6px; margin:3px;"/>
														</li>
													</div>	
													<?php
												}
											}
											closedir($handle);
										}
								?>
								</div>
							</div>
						<!------------------------- FLEXBANNER 1 ----------------------------------------->	
						
						
						<!------------------------- FLEXBANNER 2 ----------------------------------------->	
							<div id="syst_flexbanner2" style="display:none;"> 
								<div style="width:100%; display:table;">
								<label style="width:99%; text-align:left;" > CHANGE THE BANNER IMAGE: </label>
								<?php 
								if ($handle = opendir('widgets/flexbanner2/images')) {
											while (false !== ($entry = readdir($handle))) {
												if ($entry != "." && $entry != "..") {
													?>
													<div id="me9" class="styleall" style=" cursor:pointer; margin-bottom:12px; float:left;">
														<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
															<span style="cursor:pointer;"> Upload Other Image </span>
														</span>
													</div>
													
													<span id="mestatus9" ></span>

													<div id="files9" style="float:none; display:table;">
														<li id="fileName9" class="success" style="background:#fff; border:0px; float:left;">
															<img src="./widgets/flexbanner2/images/<?php echo $entry?> " style="width:200px; float:left; border:1px solid #eee; padding:6px; margin:3px;"/>
														</li>
													</div>	
													<?php
												}
											}
											closedir($handle);
										}
								?>
								</div>
							</div>
						<!------------------------- FLEXBANNER 2 ----------------------------------------->	
							
						
						
						<!---------------- SYSTEM WIDGETS UPDATE SECTION (end) ------------------------------------->
						<!------------------------------------------------------------------------------------------>
						
						
						
					<form method="post" action="./widget-save.php" style="margin-top:20px; padding-top:10px; width:100%;">	
						
						<!------------------------- TinyMCE editor. --- Begins here! ---------------->
						<div id="elm4div" style="margin:20px; float:left; width:90%;">
								
							<div class="metas">
								<span style="width:140px;"> <?php echo $lang_array['Title of the widget:']; ?> </span>
								<input style="width:760px;" type="text" value="" name="widget_new_title" id="widget_new_title" class="meta_input">
								<input type="hidden" value="" name="widget_selected" id="widget_selected" class="meta_input" value="">
							</div><br/><br/>
										
							<div data-tip="<?php echo $lang_array['Widget Content - Tooltip']; ?>" >
								<textarea id="elm4" name="elm4" rows="15" cols="80" style="width: 60%; float:left;"></textarea>

								<!-- Some integration calls -->
								<a style="padding-left:30px;" href="javascript:;" onclick="tinyMCE.get('elm4').show();return false;">[Show]</a>
								<a href="javascript:;" onclick="tinyMCE.get('elm4').hide();return false;">[Hide]</a>
							</div>
						
						<!------------------------- TinyMCE editor. --- ENDs here! ------------------>

							<br />
							<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Submit'] ?>" />
						</div>
					</form>	
						
				</div>
				
				
				
				<div class="orangespacer"></div>
				<br/><br/><br/>
				
				
				<h3><?php echo $lang_array['Widget Apperance on the Frontend'] ?></h3>
				
			<?php 
			
				$sql = "SELECT * FROM widgets_settings";
				$result = mysql_query($sql);
			
				while ($ws_res = mysql_fetch_assoc($result)) {
					$widget_head_bg = $ws_res['head_bg_color'];
					$widget_head_text = $ws_res['head_text_color'];
					$widget_content_bg = $ws_res['content_bg_color'];
					$widget_content_text = $ws_res['content_text_color'];
					$widget_border_radius = $ws_res['border_radius'];
					$widget_border_color = $ws_res['widget_border_color'];
				}
				
			?>	
				
			<form method="post" action="./saveWidgetSettings.php">
				<table  id="atable"  class="atable" align="center" border="3" style="width:960px;">
					<tbody>
						<tr>
							<td><span> <?php echo $lang_array['Widget Header Background Color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Widget Header Background Color - Tooltip']; ?>" >
									<input class="color" style="width:500px;" type="text" id="widget_head_bg" name="widget_head_bg" value="<?php echo $widget_head_bg; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array['Widget Header Text Color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Widget Header Text Color - Tooltip']; ?>" >
									<input class="color" style="width:500px;" type="text" id="widget_head_text" name="widget_head_text" value="<?php echo $widget_head_text; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array['Widget Content Background Color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Widget Content Background Color - Tooltip']; ?>" >
									<input class="color" style="width:500px;" type="text" id="widget_content_bg" name="widget_content_bg" value="<?php echo $widget_content_bg; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array['Widget Content Text Color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Widget Content Text Color - Tooltip']; ?>" >
									<input class="color" style="width:500px;" type="text" id="widget_content_text" name="widget_content_text" value="<?php echo $widget_content_text; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array['Border Radius:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Border Radius - Tooltip']; ?>" >
									<input style="width:500px;" type="text" id="widget_border_radius" name="widget_border_radius" value="<?php echo $widget_border_radius; ?>"/>
								</div>
							</td>
						</tr>
						<tr>
							<td><span> <?php echo $lang_array['Widget Border Color:'] ?> </span></td>
							<td>
								<div data-tip="<?php echo $lang_array['Widget Border Color - Tooltip']; ?>" >
									<input class="color" style="width:500px;" type="text" id="widget_border_color" name="widget_border_color" value="<?php echo $widget_border_color; ?>"/>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				
				<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Update Widget Settings'] ?>" />
			</form>
				
				
			</div>
		</div>	
		
		
		
		
<!--===============================================================================================================================================-->		
<!--============================================ MANAGE WIDGETS & TEMPLATES ( end ) ===============================================================-->		
<!--============================================================================---================================================================-->			
		
		
		
		
		
		
		
<!--===============================================================================================================================================-->		
<!--============================================ MANAGE TEMPLATES & DEFAULT PAGES =================================================================-->		
<!--============================================================================---================================================================-->		
		
		
		<div id="templates" class="content">
			<div id="firstpage_content" class="myform steps">
			
			<h3><?php echo $lang_array['Change Templates and Widget Pages'] ?></h3>
			
			
				<form method="post" style="margin-top:20px;" action="./widgetpage-add.php" data-tip="<?php echo $lang_array['Add Widget Page - Tooltip']; ?>" >
					
					<label><?php echo $lang_array["Widget (Templated) Page Title:"] ?> </label>
					<input class="custom-input"  type="text" id="widgetpageName" name="widgetpageName">
					<br/>
					
					<label><?php echo $lang_array['Widget (Templated) Page Identificator:'] ?> </label>
					<input class="custom-input"  type="text" id="pageIdentificator" name="pageIdentificator">
					<br/>
					
					<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Add Widget Page']; ?>" />
				</form>
		
		
				<div class="orangespacer"></div>
		
				<form method="post" action="./widgetpage-delete.php" style="margin-top:20px; padding-top:10px; width:100%;" data-tip="<?php echo $lang_array['Delete Widget Page - Tooltip']; ?>" >
					<label> <?php echo $lang_array['Delete (Templated) Widget Page:'] ?> </label>
					<select id="widgetpageName" name="widgetpageName" class="custom-input2" onChange="">	
									<option value="">--<?php echo $lang_array['Select'] ?>--</option>
							<?php 
								$sql = "SELECT * FROM widgets_pages";
								$result = mysql_query($sql);
								
									while ($db_field = mysql_fetch_assoc($result)) {
										echo '<option value="'.$db_field['identificator'].'">'.$db_field['name'].'</option>';
									}
							?>
					</select>
					
					<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Delete Widget Page'] ?>" />
				</form>
			
				
				
				
				<form method="post" action="./widgetpage-save.php" style="margin-top:20px; padding-top:10px; width:100%;">
					<h3><?php echo $lang_array['Configure (Templated) Widget Pages'] ?></h3>
			
						<div>
							<br/>
							<div data-tip="<?php echo $lang_array['Change Widget Page Layout - Tooltip']; ?>" >
								<label id="aBannerLabel" name="aBannerLabel"> <?php echo $lang_array['Choose a Widget which you want to edit:'] ?> </label>
								<select style='float:left;' class="custom-input2" id="fileSelector5" name="fileSelector5" onChange="changeWidgetPage(this.options[this.selectedIndex].value)">	
											<option value="">--<?php echo $lang_array['Select'] ?>--</option>
									<?php 
											$sql = "SELECT * FROM widgets_pages";
											$result = mysql_query($sql);
										
											while ($db_field = mysql_fetch_assoc($result)) {
												echo '<option value="'.$db_field['name'].'">'.$db_field['name'].'</option>';
											}
									?>
								</select>
							</div>
				
							<br/><br/><br/>
				
							<div class="field form-inline radio">
								<table class='atable' id="widgetpages_table" style="margin:0 auto;">
									<thead>
										<tr>
											<td><b><?php echo $lang_array['1. One Column Left:']; ?></b></td>
											<td><b><?php echo $lang_array['2. One Column Right:']; ?></b></td>
											<td><b><?php echo $lang_array['3. Three Columns:']; ?></b></td>
											<td><b><?php echo $lang_array['4. One Column Page:']; ?></b></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="text-align:center;"><img src="./images/2col_left.png"></td>
											<td style="text-align:center;"><img src="./images/2col_right.png"></td>
											<td style="text-align:center;"><img src="./images/3col.png"></td>
											<td style="text-align:center;"><img src="./images/1col.png"></td>
										</tr>
										<tr>
											<td><input class="radio" type="radio" id="2columns-left" name="contact" value="2columns-left" /></td>
											<td><input class="radio" type="radio" id="2columns-right" name="contact" value="2columns-right" /></td>
											<td><input class="radio" type="radio" id="3columns" name="contact" value="3columns" /></td>
											<td><input class="radio" type="radio" id="1column" name="contact" value="1column" /></td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<input type="hidden" name="current_widgetpage" id="current_widgetpage" value="" />
							
							<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Submit'] ?>" />
						
						</div>
				</form>
				
				
				
				<div class="orangespacer"></div>
				
				<h3><?php echo $lang_array['Change Templates and Widget Pages'] ?></h3>
				
				<form method="post" action="./admin.php#templates" style="margin-top:20px; padding-top:10px; width:100%; ">
					<div data-tip="<?php echo $lang_array['Load a templated widget page - Tooltip']; ?>" >
						<label> <?php echo $lang_array['Load a templated widget page:'] ?> </label>
							<select style='float:left;' class="custom-input2" id="widgetPageSelector" name="widgetPageSelector" >	
										<option value="">--<?php echo $lang_array['Select'] ?>--</option>
								<?php 
										$sql = "SELECT * FROM widgets_pages";
										$result = mysql_query($sql);
									
										while ($db_field = mysql_fetch_assoc($result)) {
											echo '<option value="'.$db_field['name'].'">'.$db_field['name'].'</option>';
										}
								?>
							</select>
							
						<input type="submit" class="custom-button" value="<?php echo $lang_array['Load Content'] ?>"/><br/><br/>
					</div>
				</form>	
				
				
				<?php 
				
					if ($_POST['widgetPageSelector']){
					
						$widgetPageSelector = $_POST['widgetPageSelector']; 
						
						
						//------------------ ALL WIDGETS defined by the user-------------------//
						
						$sql = "SELECT * FROM widgets";
						$result = mysql_query($sql);
						$all_widget_array = array();
					
						while ($db_field = mysql_fetch_assoc($result)) {
							array_push($all_widget_array, $db_field['identificator']);
						}
						
						//----------------- GET all WIDGETS of the system-------------//
						
						if ($handle = opendir('widgets')) {
							/* This is the correct way to loop over the directory. */
							
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != ".."){
									array_push($all_widget_array, 'syst_'.$entry);
								}
							}
						
						}
						
						
						
						
						
						
						
						//------------- WIDGETS THIS PAGE ------------------//
						
						$sql = "SELECT * FROM widgets_pages WHERE name='".$widgetPageSelector."'";
						$result = mysql_query($sql);
					
						while ($db_field2 = mysql_fetch_assoc($result)) {
							$widgets = $db_field2['widgets'];
							$template_type = $db_field2['template_type'];
						}
						
						$widgets_array = explode("|", $widgets);
						
						$widgets_LEFT = array();
						$widgets_CENTER = array();
						$widgets_RIGHT = array();
						
						foreach($widgets_array as $widget){
							$location = substr($widget, 0, 1);
							$widget = substr($widget, 2);
							
							if ($location == "L") { array_push($widgets_LEFT, $widget); }
							if ($location == "C") { array_push($widgets_CENTER, $widget); }
							if ($location == "R") { array_push($widgets_RIGHT, $widget); }
							
							foreach ($all_widget_array as $key=>$element){
								if ($element == $widget){
									unset($all_widget_array[$key]);
								}
							}
						}
						
						
						/*echo "<br>";
						print_r($all_widget_array);
						echo "<br>";
						print_r($widgets_LEFT);
						echo "<br>";
						print_r($widgets_RIGHT);
						echo "<br>";
						print_r($widgets_CENTER);*/
						
						
					?>
					
					
<!------------------------------------------------------------------------------------------------------------------------------>					
<!-------------------------------- GENERATING AND SAVING THE DRAG & DROP TEMPLATE TO THE DATABASE ------------------------------>					
<!------------------------------------------------------------------------------------------------------------------------------>					
					
				
				
					<div id="columns">
					
		
		<!--=====================================================================================-->				
		<!--==================== 1st Container ==================================================-->
		
						<div class="container-head"><?php echo $widgetPageSelector ?> <?php echo $lang_array['- Widgets Container: Drag & Drop the Widgets to the Page Elements:']; ?> </div>
						<ul id="column1" class="column">
							<li class="widget color-green" id="intro">
								<div class="widget-head">
									<h3>Introduction Widget</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
							
								<?php 
								foreach ($all_widget_array as $widget_id){
									
									$sist = substr($widget_id, 0, 5);
									
									if ($sist == "syst_"){
									
										if ($handle = opendir('widgets')) {
										/* This is the correct way to loop over the directory. */
											
											while (false !== ($entry = readdir($handle))) {
												if ($entry != "." && $entry != ".."){
													
													if ( "syst_".$entry == $widget_id ){
														$title = $entry." box:";
														$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
													
														?>
														<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
															<div class="widget-head">
																<h3><?php echo $title; ?></h3>
															</div>
															<div class="widget-content">
																<p><?php echo $content; ?></p>
															</div>
														</li>
														<?php
													}
												}
											}
										
										}
										
									}
									else {
											$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
											$result = mysql_query($sql);
										
											while ($db_field2 = mysql_fetch_assoc($result)) {
												$title = $db_field2['name'];
												$content = stripslashes($db_field2['content']);
												}
												?>
														
												<li class="widget color-red" id="<?php echo $widget_id ?>" >  
													<div class="widget-head">
														<h3><?php echo $title; ?></h3>
													</div>
													<div class="widget-content">
														<p><?php echo $content; ?></p>
													</div>
												</li>
										<?php
										}
										
									}
									?>
							
						</ul>
						
						
						
						<div class="container-head"><?php echo $widgetPageSelector ?> <?php echo $lang_array['- Template Page Elements']; ?> (<?php echo $template_type; ?>) </div>
						
						
						
						
						
						
		<!--=====================================================================================-->				
		<!--==================== 2nd Container ==================================================-->
		
						<ul id="column2" class="column">
							
							<?
							if (($template_type == "2columns-left") || ($template_type == "3columns"))		//CONTAINER 2 SERVES AS LEFT ELEMENT
							{
								foreach ($widgets_LEFT as $widget_id){
									$sist = substr($widget_id, 0, 5);
							
									if ($sist != "syst_"){
										$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
										$result = mysql_query($sql);
									
										while ($db_field2 = mysql_fetch_assoc($result)) {
											$title = $db_field2['name'];
											$content = stripslashes($db_field2['content']);
										}
										?>
								
										<li class="widget color-red" id="<?php echo $widget_id ?>" >  
											<div class="widget-head">
												<h3><?php echo $title; ?></h3>
											</div>
											<div class="widget-content">
												<p><?php echo $content; ?></p>
											</div>
										</li>
								
										<?php
									}
									else{
									
										if ($handle = opendir('widgets')) {
										/* This is the correct way to loop over the directory. */
											
											while (false !== ($entry = readdir($handle))) {
												if ($entry != "." && $entry != ".."){
													
													if ( "syst_".$entry == $widget_id ){
														$title = $entry." box:";
														$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
													
														?>
														<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
															<div class="widget-head">
																<h3><?php echo $title; ?></h3>
															</div>
															<div class="widget-content">
																<p><?php echo $content; ?></p>
															</div>
														</li>
														<?php
													}
												}
											}
										
										}
									}
									
								}
							}
							else{
								
									foreach ($widgets_LEFT as $widget_id){				//CONTAINER 2 SERVES AS CENTER ELEMENT
									
										$sist = substr($widget_id, 0, 5);
									
											if ($sist != "syst_"){
												$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
												$result = mysql_query($sql);
											
												while ($db_field2 = mysql_fetch_assoc($result)) {
													$title = $db_field2['name'];
													$content = stripslashes($db_field2['content']);
												}
												
												?>
											
												<li class="widget color-red" id="<?php echo $widget_id ?>" >  
													<div class="widget-head">
														<h3><?php echo $title; ?></h3>
													</div>
													<div class="widget-content">
														<p><?php echo $content; ?></p>
													</div>
												</li>
											
												<?php
											}
											else{
												if ($handle = opendir('widgets')) {
												/* This is the correct way to loop over the directory. */
													
													while (false !== ($entry = readdir($handle))) {
														if ($entry != "." && $entry != ".."){
															
															if ( "syst_".$entry == $widget_id ){
																$title = $entry." box:";
																$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
															
																?>
																<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
																	<div class="widget-head">
																		<h3><?php echo $title; ?></h3>
																	</div>
																	<div class="widget-content">
																		<p><?php echo $content; ?></p>
																	</div>
																</li>
																<?php
															}
														}
													}
												
												}
											}
											
									}
							
								}
							?>
							
						</ul>
						
						
						
		<!--=====================================================================================-->				
		<!--==================== 3rd Container ==================================================-->

						
							
							<?
							if (($template_type == "2columns-left") || ($template_type == "3columns"))		//CONTAINER 3 SERVES AS CENTER ELEMENT
							{
								?><ul id="column3" class="column"><?php
							
								foreach ($widgets_CENTER as $widget_id){
									$sist = substr($widget_id, 0, 5);
									
									if ($sist != "syst_"){
									
										$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
										$result = mysql_query($sql);
									
										while ($db_field2 = mysql_fetch_assoc($result)) {
											$title = $db_field2['name'];
											$content = stripslashes($db_field2['content']);
											}
											?>
								
											<li class="widget color-red" id="<?php echo $widget_id ?>">  
												<div class="widget-head">
													<h3><?php echo $title; ?></h3>
												</div>
												<div class="widget-content">
													<p><?php echo $content; ?></p>
												</div>
											</li>
								
											<?php
									}
									else{
										
										if ($handle = opendir('widgets')) {
												/* This is the correct way to loop over the directory. */
													
													while (false !== ($entry = readdir($handle))) {
														if ($entry != "." && $entry != ".."){
															
															if ( "syst_".$entry == $widget_id ){
																$title = $entry." box:";
																$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
															
																?>
																<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
																	<div class="widget-head">
																		<h3><?php echo $title; ?></h3>
																	</div>
																	<div class="widget-content">
																		<p><?php echo $content; ?></p>
																	</div>
																</li>
																<?php
															}
														}
													}
												
												}
									
									}
								}	
								
								?> </ul> <?php
							}
							else
								
								{
								if ($template_type == "2columns-right") 
									{
										
										?><ul id="column3" class="column"><?php
									
										foreach ($widgets_CENTER as $widget_id){				//CONTAINER 3 SERVES AS RIGHT ELEMENT
											$sist = substr($widget_id, 0, 5);
									
											if ($sist != "syst_"){
												$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
												$result = mysql_query($sql);
											
												while ($db_field2 = mysql_fetch_assoc($result)) {
													$title = $db_field2['name'];
													$content = stripslashes($db_field2['content']);
												}
												?>
										
												<li class="widget color-red" id="<?php echo $widget_id ?>" >  
													<div class="widget-head">
														<h3><?php echo $title; ?></h3>
													</div>
													<div class="widget-content">
														<p><?php echo $content; ?></p>
													</div>
												</li>
										
												<?php
											}
											else {
											
												if ($handle = opendir('widgets')) {
												/* This is the correct way to loop over the directory. */
													
													while (false !== ($entry = readdir($handle))) {
														if ($entry != "." && $entry != ".."){
															
															if ( "syst_".$entry == $widget_id ){
																$title = $entry." box:";
																$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
															
																?>
																<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
																	<div class="widget-head">
																		<h3><?php echo $title; ?></h3>
																	</div>
																	<div class="widget-content">
																		<p><?php echo $content; ?></p>
																	</div>
																</li>
																<?php
															}
														}
													}
												
												}
												
											}
										}
										
										?> </ul> <?php
									}
								}
							
						
						
						
		//======================================================================================================================//			
		//==================== 4th Container ===================================================================================//
		
							
							if ($template_type == "3columns")							//CONTAINER 4 SERVES AS RIGHT ELEMENT
							{
							
							?> <ul id="column4" class="column"> <?php
							
								foreach ($widgets_RIGHT as $widget_id){
									$sist = substr($widget_id, 0, 5);
									
									if ($sist != "syst_"){
										$sql = "SELECT * FROM widgets WHERE identificator='".$widget_id."'";
										$result = mysql_query($sql);
									
										while ($db_field2 = mysql_fetch_assoc($result)) {
											$title = $db_field2['name'];
											$content = stripslashes($db_field2['content']);
											}
											?>
											<li class="widget color-red" id="<?php echo $widget_id ?>" >  
												<div class="widget-head">
													<h3><?php echo $title; ?></h3>
												</div>
												<div class="widget-content">
													<p><?php echo $content; ?></p>
												</div>
											</li>
											<?php
									}
									else{
									
										if ($handle = opendir('widgets')) {
												/* This is the correct way to loop over the directory. */
													
													while (false !== ($entry = readdir($handle))) {
														if ($entry != "." && $entry != ".."){
															
															if ( "syst_".$entry == $widget_id ){
																$title = $entry." box:";
																$content = file_get_contents('./widgets/'.$entry.'/'.$entry.'.php');
															
																?>
																<li class="widget color-green" id="<?php echo 'syst_'.$entry ?>" >  
																	<div class="widget-head">
																		<h3><?php echo $title; ?></h3>
																	</div>
																	<div class="widget-content">
																		<p><?php echo $content; ?></p>
																	</div>
																</li>
																<?php
															}
														}
													}
												
												}
									
									}
								}	
								
							?> </ul>	<?php
							
							}
							?>
						
						
				
					</div>	
				
					<script type="text/javascript" src="./js/inettuts.js"></script>	
				
		
					<input class="custom-button" style="margin:20px;" type="submit" onclick="saveDragDropContainers('<?php echo $template_type; ?>', '<?php echo $widgetPageSelector; ?>'); update_ALL('#templates');" name="save" value="<?php echo $lang_array['Submit'] ?>" />
									
				<?php 
				}
				?>
				
				
			</div>
		</div>	
		
		
		
		
<!--===============================================================================================================================================-->		
<!--============================================ MANAGE WIDGETS & TEMPLATES ( end ) ===============================================================-->		
<!--============================================================================---================================================================-->				
		
		
		
			
		
		
			
		
		
	<!---------------------------------------------------- BANNER SLIDER ------------------------------------------->	
		
		
		<div id="bannerslider" class="content">
			<div id="firstpage_content" class="myform steps">
			
			<h3><?php echo $lang_array['STEP 7: Create your Banner.'] ?></h3>
			
			<form method="post" action="./addBanner.php" data-tip="<?php echo $lang_array['Add Banner - Tooltip']; ?>" style="margin-top:20px;" >
				<label id="fileNameLabel" name="fileNameLabel"><?php echo $lang_array['Add new Banner:'] ?> </label>
				<input class="custom-input"  type="text" id="bannerName" name="bannerName">
				
				<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Add Banner']; ?>" />
			</form>
			
			
			
			<form method="post" action="./deleteBanner.php" style="margin-top:20px; padding-top:10px; width:100%;" data-tip="<?php echo $lang_array['Delete Banner - Tooltip']; ?>" >
				<label id="fileNameLabel" name="fileNameLabel"> <?php echo $lang_array['Delete Banner:'] ?> </label>
				<select id="bannerName2" name="bannerName2" class="custom-input2" onChange="">	
								<option value="">--<?php echo $lang_array['Select'] ?>--</option>
						<?php 
							$sql = "SELECT * FROM banners";
							$result = mysql_query($sql);
							
								while ($db_field = mysql_fetch_assoc($result)) {
									echo '<option value="'.$db_field['name'].'">'.$db_field['name'].'</option>';
								}
						?>
				</select>
				
				<input class="custom-button" type="submit" name="save" value="<?php echo $lang_array['Delete Banner'] ?>" />
			</form>
		
			
			
			
			
			<form method="post" action="./saveBanner.php" style="margin-top:20px; padding-top:10px; width:100%; border-top: 1px solid #E35E28;">
				<h3><?php echo $lang_array['STEP 8: Add content to your Banner.'] ?></h3>
		
				<div style="margin-top:20px;">
					<div data-tip="<?php echo $lang_array['Load Banner - Tooltip']; ?>" >
						<label id="aBannerLabel" name="aBannerLabel"> <?php echo $lang_array['Choose a Banner which you want to edit:'] ?> </label>
						<select style='float:left;' class="custom-input2" id="fileSelector3" name="fileSelector3" onChange="changeBanner(this.options[this.selectedIndex].value)">	
									<option value="">--<?php echo $lang_array['Select'] ?>--</option>
							<?php 
									$sql = "SELECT * FROM banners";
									$result = mysql_query($sql);
								
									while ($db_field = mysql_fetch_assoc($result)) {
										echo '<option value="'.$db_field['name'].'">'.$db_field['name'].'</option>';
									}
							?>
						</select>
						
						<input type="button" class="custom-button" onclick=" tinyMCE.get('elm3').show(); return false;" value="<?php echo $lang_array['Load Content'] ?>"/><br/><br/>
					</div>
					
					
					
					
					<div class="metas" data-tip="<?php echo $lang_array['Choose the language of the banner.']; ?>" style="float:left;" >
						<label id="aBannerLabel" name="aBannerLabel"> <?php echo $lang_array['Choose the language of the banner.'] ?> </label>
						<select id="bannerLang" name="bannerLang" value="" style="margin: 5px 5px 5px 0; padding: 5px;">
							<?php
								
								$SQL = "SELECT * FROM country";
								$result = mysql_query($SQL);					
							
								while ($db_field = mysql_fetch_assoc($result)) {
								
									$code = $db_field['iso2'];
									$name = utf8_encode($db_field['name']);
								
									if ( $code == $page_language ){
										?>
											<option value="<?php echo $code; ?>" selected="selected" ><?php echo $name; ?></option>
										<?php
									}
									else{
										?>
											<option value="<?php echo $code; ?>" ><?php echo $name; ?></option>
										<?php
									}
									
								}
							?>
						</select>
					</div>	
					
					
					<!------------------------- TinyMCE editor. --- Begins here! ---------------->
									
					<div style="margin:20px; float:left; width:90%;" data-tip="<?php echo $lang_array['Banner Content - Tooltip']; ?>" >
						<textarea id="elm3" name="elm3" rows="15" cols="80" style="width: 60%; float:left;">
						</textarea>
					</div>

					<!-- Some integration calls -->
					<a style="padding-left:30px;" href="javascript:;" onclick="tinyMCE.get('elm3').show();return false;">[Show]</a>
					<a href="javascript:;" onclick="tinyMCE.get('elm3').hide();return false;">[Hide]</a>
					<a href="javascript:;" onclick="tinyMCE.get('elm3').execCommand('Bold');return false;">[Bold]</a>
					<a href="javascript:;" onclick="alert(tinyMCE.get('elm3').getContent());return false;">[Get contents]</a>
					<a href="javascript:;" onclick="alert(tinyMCE.get('elm3').selection.getContent());return false;">[Get selected HTML]</a>
					<a href="javascript:;" onclick="alert(tinyMCE.get('elm3').selection.getContent({format : 'text'}));return false;">[Get selected text]</a>
					<a href="javascript:;" onclick="alert(tinyMCE.get('elm3').selection.getNode().nodeName);return false;">[Get selected element]</a>
					<a href="javascript:;" onclick="tinyMCE.execCommand('mceInsertContent',false,'<b>Hello world!!</b>');return false;">[Insert HTML]</a>
					<a href="javascript:;" onclick="tinyMCE.execCommand('mceReplaceContent',false,'<b>{$selection}</b>');return false;">[Replace selection]</a>
					<!------------------------- TinyMCE editor. --- ENDs here! ------------------>

					<p> </p>
					
					<br />
					<input class="custom-button" style="margin:20px;" type="submit" name="save" value="<?php echo $lang_array['Submit'] ?>" />
					
				</div>
			</form>
					
			</div>
		</div>
		
		
		
	
	<!---------------------------------------------------- UPLOAD BACKGROUNDS ---------------------------------------------------------------->	
		
		<div id="backgrounds" class="content">
			<div id="firstpage_content" class="myform steps">
			
			   <div class="container_backgs">
			
				<h3><?php echo $lang_array['Uploaded backgrounds:'] ?></h3>
			
			<!-------------------------------------------------------------------------------------------------------------->
			<!--------------------------- HEADER BACKGROUNDS --------------------------------------------------------------->
			
			<label class="otherlabel"> <?php echo $lang_array['Uploaded backgrounds for the HEADER section:'] ?> </label>
			
				<div class="uploaded_imgs" id="uploaded_bgs" name="uploaded_bgs" data-tip="<?php echo $lang_array['Uploaded Header Backgrounds - Tooltip']; ?>" >	
					<?php 
						if ($handle = opendir('./images/backgrounds/')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
								
									$flag = strpos($entry, "eader_");
									if ($flag > 0) {
									?>
									<div class="inn">
										<p><?php echo substr($entry, 0, -4); ?></p>
										<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x #fff;" ></div>
										<form action="./delete_background.php?file=isbg_<?php echo $entry; ?>" method="post" >
											<input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
										</form>
									</div>
									<?php
									}
								}
							}
							closedir($handle);
						}
					?>
				</div>
				
				<div class="upload_new" data-tip="<?php echo $lang_array['Upload Header Background - Tooltip']; ?>" >
					<div id="me3" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
						<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
							<span style="cursor:pointer;"> <?php echo $lang_array['Upload Background for - HEADER -'] ?></span>
						</span>
					</div>

					<span id="mestatus3" ></span>

					<div id="files3">
						<li style="list-style:none;" id="fileName3" class="success3"></li>
					</div>	
				</div>
				<div class="refresh">
					<input type="button" style="height: 60px; width: 60px;" name="delete" value="" onclick="update_ALL('#backgrounds');" class="refresh-button">
				</div>
				
				
			<!-------------------------------------------------------------------------------------------------------------->
			<!--------------------------- NAVIGATION BAR BACKGROUNDS ------------------------------------------------------->
				<!--
				<div class="orangespacer"></div>
				
				<label class="otherlabel"> <?php echo $lang_array['Uploaded backgrounds for the NAVIGATION BAR:'] ?> </label>
				
				<div class="uploaded_imgs" id="uploaded_bgs3" name="uploaded_bgs3" data-tip="<?php echo $lang_array['Uploaded Navigation Bar Backgrounds - Tooltip']; ?>" >	
					<?php 
						if ($handle = opendir('./images/backgrounds/')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
								
									$flag = strpos($entry, "avigbar_");
									if ($flag > 0) {
									?>
									<div class="inn">
										<p><?php echo substr($entry, 0, -4); ?></p>
										<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x #fff;" ></div>
										<form action="./delete_background.php?file=isbg_<?php echo $entry; ?>" method="post" >
											<input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
										</form>
									</div>
									<?php
									}
								}
							}
							closedir($handle);
						}
					?>
				</div>
				
				<div class="upload_new" data-tip="<?php echo $lang_array['Upload Navigation Bar Background - Tooltip']; ?>" >
					<div id="me4" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
						<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
							<span style="cursor:pointer;"> <?php echo $lang_array['Upload Background for - NAVIGATION BAR -'] ?> </span>
						</span>
					</div>

					<span id="mestatus4" ></span>

					<div id="files4">
						<li style="list-style:none;" id="fileName4" class="success4"></li>
					</div>	
				</div>
				<div class="refresh">
					<input type="button" style="height: 60px; width: 60px;" name="delete" value="" onclick="update_ALL('#backgrounds');" class="refresh-button">
				</div>
				-->
			<!-------------------------------------------------------------------------------------------------------------->
			<!--------------------------- BANNER SLIDER BACKGROUNDS -------------------------------------------------------->
			
				<div class="orangespacer"></div>
				
				<label class="otherlabel"> <?php echo $lang_array['Uploaded backgrounds for the BANNER SLIDER:'] ?> </label>
				
				<div class="uploaded_imgs" id="uploaded_bgs4" name="uploaded_bgs4" data-tip="<?php echo $lang_array['Uploaded Banner Slider Backgrounds - Tooltip']; ?>" >	
					<?php 
						if ($handle = opendir('./images/backgrounds/')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
								
									$flag = strpos($entry, "anners_");
									if ($flag > 0) {
									?>
									<div class="inn">
										<p><?php echo substr($entry, 0, -4); ?></p>
										<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x #fff;" ></div>
										<form action="./delete_background.php?file=isbg_<?php echo $entry; ?>" method="post" >
											<input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
										</form>
									</div>
									<?php
									}
								}
							}
							closedir($handle);
						}
					?>
				</div>
				
				<div class="upload_new" data-tip="<?php echo $lang_array['Upload Banner Slider Background - Tooltip']; ?>" >
					<div id="me5" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
						<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
							<span style="cursor:pointer;"> <?php echo $lang_array['Upload Background for - BANNERS -'] ?> </span>
						</span>
					</div>

					<span id="mestatus5" ></span>

					<div id="files5">
						<li style="list-style:none;" id="fileName5" class="success5"></li>
					</div>	
				</div>
				<div class="refresh">
					<input type="button" style="height: 60px; width: 60px;" name="delete" value="" onclick="update_ALL('#backgrounds');" class="refresh-button">
				</div>

			<!-------------------------------------------------------------------------------------------------------------->
			<!--------------------------- BOTTOM SLIDER BACKGROUNDS -------------------------------------------------------->
				<div class="orangespacer"></div>
				
				<label class="otherlabel"> <?php echo $lang_array['Uploaded backgrounds for the PRODUCT SLIDER (FOOTER) :'] ?> </label>
				
				<div class="uploaded_imgs" id="uploaded_bgs2" name="uploaded_bgs2" data-tip="<?php echo $lang_array['Uploaded Bottom Slider Backgrounds - Tooltip']; ?>" >	
					<?php 
						if ($handle = opendir('./images/backgrounds/')) {
							while (false !== ($entry = readdir($handle))) {
								if ($entry != "." && $entry != "..") {
								
									$flag = strpos($entry, "ooter_");
									if ($flag > 0) {
									?>
									<div class="inn">
										<p><?php echo substr($entry, 0, -4); ?></p>
										<div class="bgs" style="background: url('./images/backgrounds/<?php echo $entry; ?>') 0 0 repeat-x #fff;" ></div>
										<form action="./delete_background.php?file=isbg_<?php echo $entry; ?>" method="post" >
											<input type="submit" class="custom-button2" value="<?php echo $lang_array['Delete'] ?>" />
										</form>
									</div>
									<?php
									}
								}
							}
							closedir($handle);
						}
					?>
				</div>
				
				<div class="upload_new" data-tip="<?php echo $lang_array['Upload Bottom Slider Background - Tooltip']; ?>" >
					<div id="me6" class="styleall" style=" cursor:pointer; margin-bottom:12px;">
						<span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:13px;">
							<span style="cursor:pointer;"> <?php echo $lang_array['Upload Background for - BOTTOM SLIDER -'] ?> </span>
						</span>
					</div>

					<span id="mestatus6" ></span>

					<div id="files6">
						<li style="list-style:none;" id="fileName6" class="success6"></li>
					</div>	
				</div>
				<div class="refresh">
					<input type="button" style="height: 60px; width: 60px;" name="delete" value="" onclick="update_ALL('#backgrounds');" class="refresh-button">
				</div>
				
				
				
				<div style="width:100%; clear:both;"></div>
			   </div>
			
			</div>
		</div>
		
		
		
		
		
	
	<!----------------------------------------------------- CONTENT SIDEBAR ------------------------------------------------------------------>		
		
		<div id="sidebar" class="content">
			<div id="firstpage_content" class="myform steps">
				<div data-tip="<?php echo $lang_array['Actual Contact Form']; ?>">
					<h3><?php echo $lang_array['Select the Form which will be shown in the Website:']; ?></h3>
				   
					<?php
						$formSql = "SELECT * FROM `forms` WHERE `status`='1'";
						$formResult = mysql_query($formSql);
					   
						$iframeSql = "SELECT * FROM `webpages_settings` WHERE webpages_settings.id='1'";
						$iframeResult = mysql_query($iframeSql);
						$iframeRow = mysql_fetch_array($iframeResult);
					?>   
					
					<form method="post" action="./saveSidebar.php" style="margin-top:20px; width:100%;">
					  <?php if(mysql_num_rows($formResult)){?>
						<table width="50%" border="0" cellspacing="0" cellpadding="5px" class="atable">
							<tr>
							 <td width="50%"><?php echo $lang_array['Select Form:']; ?></td>
							 <td width="50%">
							 <select name="iframe_form">
							  <?php while($formRow = mysql_fetch_array($formResult)){?>
							   <option value="<?php echo $formRow['url'];?>"><?php echo $formRow['name'];?></option>
							  <?php } ?>
							 </select>
							 </td>
							</tr>
							<tr>
							 <td><?php echo $lang_array['Enter iframe width:']; ?></td>
							 <td><input type="text" name="iframe_width" value="<?php echo $iframeRow['iframe_width'];?>"></td>
							</tr>  
							<tr>
							 <td><?php echo $lang_array['Enter iframe height:']; ?></td>
							 <td><input type="text" name="iframe_height" value="<?php echo $iframeRow['iframe_height'];?>"></td>
							</tr>
							<tr>
							 <td>&nbsp;</td>
							 <td><input type="hidden" name="hid_form" value="hid_form">
								 <input type="submit" value="<?php echo $lang_array['Save']; ?>" name="save_form" class="custom-button" style="margin:0;"></td>
							</tr>                
						</table>
					  <?php } ?>	
					</form>
					
				</div>
			</div>
		</div>
		
		
		
		
		
		
	<!---------------------------------------------------- Main menu ---------------------------------------------------------------------->
		
		<div id="mymenu" class="content">
			<div id="firstpage_content" class="myform steps">
				
				<h3><?php echo $lang_array['STEP 4: Menu & Navigation'] ?></h3>
				<br/><br/>
	
				<section id="advanced_menu_manager_system">
						<?php
						include ("include/amms.class.php");
						$amms 				= new amms;
						
						if (isset($_GET["menu_selector"])) {
							$actual_menu 	= $_GET["menu_selector"];
						} else {
							$actual_menu 	= "main_menu";
						}
						
						$menus 				= $amms->get_menus();								// Gets all menus in database
						$menu_details 		= $amms->get_menuDetails($actual_menu);				// Gets current menu details (name, id, safe_name)
						$menu_items 		= $amms->get_menuItems($menu_details["menu_id"]);	// Gets all database saved menu items for current menu
						?>
						
						<!-- These three hidden inputs are very important 
						**** 
						**** current_menu_name 			-> Holds the current menu name
						**** current_menu_safe_name 	-> Holds the current menu safe_name
						**** current_menu_serialized 	-> Holds the current menu original database serialization of menu records. Used to compare to changes and activating save button
						-->
						<input type="hidden" id="current_menu_name" name="current_menu_namee" value="<?php echo $menu_details["menu_name"]; ?>" />
						<input type="hidden" id="current_menu_safe_name" name="current_menu_safe_namee" value="<?php echo $menu_details["safe_name"]; ?>" />
						<input type="hidden" id="current_menu_serialized" name="current_menu_serialized" value="" />
						
						<!-- Actual menu information, menu selector and nem menu button -->
						<div class="main_options">
							<div class="current_menu">
								<div class="cname"><?php echo $menu_details["menu_name"]; ?></div>
								<div class="csname"><?php echo $menu_details["safe_name"]; ?></div>
							</div>
							
							<a id="create_menu" class="add_menu" href="#" data-tip="<?php echo $lang_array['Add new menu - Tooltip']; ?>" ><?php echo $lang_array['Add menu'] ?></a>
							<form class="change_menu" id="change_menu" name="change_menu" method="get" action="" data-tip="<?php echo $lang_array['Select Menu - Tooltip']; ?>" >
								<label for="menu_selector"><?php echo $lang_array['Select Menu'] ?>&nbsp;&nbsp;</label>
								<select name="menu_selector" id="menu_selector">
									<?php
										while ($row = mysql_fetch_assoc($menus)) {
											if ($actual_menu == $row["safe_name"]) {
												echo '<option selected value="'.$row["safe_name"].'">'.$row["menu_name"].'</option>';
											} else {
											//	echo '<option value="'.$row["safe_name"].'">'.$row["menu_name"].'</option>';
												
												?>
													<option onclick="window.location.href='./admin.php?menu_selector=<?php echo $row["safe_name"]; ?>#mymenu'" value="<?php echo $row["safe_name"]; ?>" > <?php echo $row["menu_name"]; ?></option>
												<?php
												
											}
										}
									?>
								</select>
							</form>
							<br clear="all" />
						</div>
						
						<!-- Actual menu options -->
						<div class="current_menu_options">
							<a id="add_item" class="add_item" href="#" data-tip="<?php echo $lang_array['Add menu item - Tooltip']; ?>" ><?php echo $lang_array['Add Item'] ?></a>
							<a id="save_menu" class="save_menu" href="include/menu.processor.php" style="display: none;" ><?php echo $lang_array['Save Menu'] ?></a>
							<a id="edit_menu" class="edit_menu" href=""><?php echo $lang_array['Edit Menu'] ?></a>
							<form class="preview_menu_form" id="preview_menu_form" name="preview_menu_form" method="post" action="menu_preview.php" target="_blank">
								<input type="hidden" id="current_menu_nr_items" name="current_menu_nr_items" value="" />
								<a id="preview_menu" class="preview_menu" href="#"><?php echo $lang_array['Preview Menu'] ?></a>
							</form>
							<?php
								if ($actual_menu != "main_menu") {
									echo '<a id="remove_menu" class="remove_menu" href="#'.$menu_details["safe_name"].'">'.$lang_array['Remove Menu'].'</a>';
								}
							?>
							<br clear="all" />
						</div>
						
						<!-- Notifications container. All start with display: none. JQuery handles show/hide/msg/type -->
						<div id="notification_container">
							<div id="notify_green" class="notify_green" style="display: none;">
								<div class="cross">x</div>
								<div class="content"><?php echo $lang_array['There are no items for this menu yet. Please add new items now!'] ?></div>
								<br clear="all" />
							</div>
							
							<div id="notify_red" class="notify_red" style="display: none;">
								<div class="cross">x</div>
								<div class="content"><?php echo $lang_array['There are no items for this menu yet. Please add new items now!'] ?></div>
								<br clear="all" />
							</div>
							
							<div id="notify_yellow" class="notify_yellow" style="display: none;">
								<div class="cross">x</div>
								<div class="content"><?php echo $lang_array['There are no items for this menu yet. Please add new items now!'] ?></div>
								<br clear="all" />
							</div>
							
							<div id="notify_blue" class="notify_blue" style="display: none;">
								<div class="cross">x</div>
								<div class="content"><?php echo $lang_array['There are no items for this menu yet. Please add new items now!'] ?></div>
								<br clear="all" />
							</div>
						</div>
						
						<?php
						// Checks is current menu has items ?
						if ($menu_items == false ) {
							?>
							<script>
								enableNotification("notify_yellow", "There are no items for this menu yet. Please add new items now!", 10000);
							</script>
							
							<div class="titles" data-tip="<?php echo $lang_array['Menu Drag Drop - Tooltip']; ?>" >
								<div class="handle"><?php echo $lang_array['Handle'] ?></div>
								<div class="title"><?php echo $lang_array['Title'] ?></div>
								<div class="class"><?php echo $lang_array['Class'] ?></div>
								<div class="type"><?php echo $lang_array['Type'] ?></div>
								<div class="content"><?php echo $lang_array['Content'] ?></div>
								<div class="tasks"><?php echo $lang_array['Tasks'] ?></div>
								<br clear="all" />
							</div>
							
							<!-- This <ol> is required even when menu has no items to allow JQuery insert new items -->
							<ol class="sortable"></ol>
							<?php
						} else {
							?>
							<div class="titles" data-tip="<?php echo $lang_array['Menu Drag Drop - Tooltip']; ?>" >
								<div class="handle"><?php echo $lang_array['Handle'] ?></div>
								<div class="title"><?php echo $lang_array['Title'] ?></div>
								<div class="class"><?php echo $lang_array['Class'] ?></div>
								<div class="type"><?php echo $lang_array['Type'] ?></div>
								<div class="content"><?php echo $lang_array['Content'] ?></div>
								<div class="tasks"><?php echo $lang_array['Tasks'] ?></div>
								<br clear="all" />
							</div>
							
							<ol class="sortable">
							<?php
							// bootstrap loop
							$result 	= '';
							$currDepth 	= 0;  // -1 to get the outer <ul>
							$x			= 1;
							
							while (!empty($menu_items)) {
								$currNode = array_shift($menu_items);
								
								// Level down?
								if ($currNode['depth'] > $currDepth) {
									// Yes, open new <ol>
									$result .= '<ol>';
								} else if ($x > 1) {
									// No, closes previous <li> then
									$result .= '</li>';
								}
								
								
								// Level up?
								if ($currNode['depth'] < $currDepth) {
									// Yes, close x number of open <ol> and respective <li>
									$result .= str_repeat('</ol></li>', $currDepth - $currNode['depth']);
								}
								
								/* Always add a new node
								**
								** Notice here that we use a span for field output
								** and a hidden input for the actual value. It might be usefull
								** for example if you want to show the article/content name on the gui
								** but the hidden input holds the article/content ID from the database
								*/
								$result .= '<li id="list_'.$x.'">	
												<div class="li_content">
													<div class="handle"></div>
													
													<span class="title">'.$currNode['title'].'&nbsp;</span>
													<input type="hidden" class="db_title" name="db_title" value="'.$currNode['title'].'" />
													
													<div class="tasks"><a class="edit edit_item_btn" href="#'.$x.'"></a><a class="remove rem_item_btn" href="#'.$x.'"></a></div>
													
													<span class="content">'.$currNode['content'].'&nbsp;</span>
													<input type="hidden" class="db_content" name="db_content" value="'.$currNode['content'].'" />
													
													<span class="type">'.$currNode['type'].'&nbsp;</span>
													<input type="hidden" class="db_type" name="db_type" value="'.$currNode['type'].'" />
													
													<span class="class">'.$currNode['class_name'].'&nbsp;</span>
													<input type="hidden" class="db_class_name" name="db_class_name" value="'.$currNode['class_name'].'" />
													
													<br clear="all" />
												</div>';
								
								// Adjust current depth
								$currDepth = $currNode['depth'];
								
								// Are we finished?
								if (empty($menu_items)) {
									// Yes, close the open <ol> and <li>
									$result .= str_repeat('</ol></li>', $currDepth + 1);
								}
								
								$x++;
								
							}
							echo $result;
							
							?>
							</ol>
							<?php
						}
						?>
							
						<br/>
						<br/>
						
						<!-- Create New Menu JQuery UI Modal Form -->
						<div id="create_menu-form" title="Create a new menu">
							<p class="validateTips"><?php echo $lang_array['All form fields are required.'] ?></p>
							<form id="create_menu_form">
							<fieldset>
								<label for="name"><?php echo $lang_array['Menu Name'] ?></label>
								<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
								<label for="safe_name"><?php echo $lang_array['Menu Safe Name'] ?></label>
								<input type="text" name="safe_name" id="safe_name" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
							</fieldset>
							</form>
						</div>
						
						<!-- Create New Menu ITEM JQuery UI Modal Form -->
						<div id="create_menu_item-form" title="Create a new (<?php echo $menu_details["menu_name"]; ?>) item">
							<p class="validateTips"><?php echo $lang_array['All form fields are required.'] ?></p>
							<form id="create_menu_form">
							<fieldset>
								<label for="parent"><?php echo $lang_array['Parent'] ?></label>
								<div id="parent_container"><?php echo $amms->get_menuItems_NestedSetInput($menu_details["menu_id"]); ?></div>
								<br clear="all" />
								<br/>
								
								<label for="title"><?php echo $lang_array['Title'] ?></label>
								<input type="text" name="title" id="title" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
								<br/>
								
								<label for="class_name"><?php echo $lang_array['Class name'] ?></label>
								<input type="text" name="class_name" id="class_name" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
								<br/>
								
								<label for="type"><?php echo $lang_array['Type'] ?></label>
								<select name="type" id="type">
									<option value="url">Url</option>
									<option value="separator"><?php echo $lang_array['Separator'] ?></option>
									<option value="component"><?php echo $lang_array['Component'] ?></option>
									<option value="content"><?php echo $lang_array['Content'] ?></option>
								</select>
								<br clear="all" />
								<br/>
								
								<div id="url_input_holder">
									<label for="url">Url</label>
									<input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" />
									<br clear="all" />
									<br/>
								</div>
								
								<div id="component_input_holder" style="display: none;">
									<label for="component"><?php echo $lang_array['Component'] ?></label>
									<?php echo $amms->getComponents("component", "component", "select ui-widget-content ui-corner-all"); ?>
									<br clear="all" />
									<br/>
								</div>
								
								<div id="component_id_input_holder" style="display: none;">
									<label for="component_id"><?php echo $lang_array['Component Id'] ?></label>
									<input type="text" name="component_id" id="component_id" class="text ui-widget-content ui-corner-all" />
									<br clear="all" />
									<br/>
								</div>
								
								<div id="content_input_holder" style="display: none;">
									<label for="content"><?php echo $lang_array['Content'] ?></label>
									<?php echo $amms->getContents("content", "content", "select ui-widget-content ui-corner-all"); ?>
									<br clear="all" />
								</div>
								
							</fieldset>
							</form>
						</div>
						
						<!-- Edit Menu JQuery UI Modal Form -->
						<div id="edit_menu-form" title="Edit - <?php echo $menu_details["menu_name"]; ?>">
							<?php
								if ($actual_menu == "main_menu") {
									?>
									<p class="warning"><?php echo $lang_array['This is the main menu. Safe name cannot be changed.'] ?></p>
									<?php
								}
							?>
							<p class="validateTips"><?php echo $lang_array['All form fields are required.'] ?></p>
							<form id="create_menu_form">
							<fieldset>
								<label for="name_edit"><?php echo $lang_array['Menu Name'] ?></label>
								<input type="text" name="name_edit" id="name_edit" class="text ui-widget-content ui-corner-all" value="<?php echo $menu_details["menu_name"]; ?>" />
								<br clear="all" />
								<label for="safe_name_edit"><?php echo $lang_array['Menu Safe Name'] ?></label>
								<input type="text" name="safe_name_edit" id="safe_name_edit" class="text ui-widget-content ui-corner-all" value="<?php echo $menu_details["safe_name"]; ?>" />
								<br clear="all" />
							</fieldset>
							</form>
						</div>
						
						<!-- Edit Menu ITEM JQuery UI Modal Form -->
						<div id="edit_menu_item-form" title="Edit menu item">
							<p class="validateTips"><?php echo $lang_array['All form fields are required.'] ?></p>
							<form id="create_menu_form">
							<fieldset>
								
								<label for="title_edit"><?php echo $lang_array['Content'] ?><?php echo $lang_array['Title'] ?></label>
								<input type="text" name="title_edit" id="title_edit" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
								<br/>
								
								<label for="class_name_edit"><?php echo $lang_array['Content'] ?><?php echo $lang_array['Class name'] ?></label>
								<input type="text" name="class_name_edit" id="class_name_edit" class="text ui-widget-content ui-corner-all" />
								<br clear="all" />
								<br/>
								
								<label for="type_edit"><?php echo $lang_array['Type'] ?></label>
								<select name="type_edit" id="type_edit">
									<option value="url">Url</option>
									<option value="separator"><?php echo $lang_array['Separator'] ?></option>
									<option value="component"><?php echo $lang_array['Component'] ?></option>
									<option value="content"><?php echo $lang_array['Content'] ?></option>
								</select>
								<br clear="all" />
								<br/>
								
								<div id="url_input_holder_edit">
									<label for="url_edit">Url</label>
									<input type="text" name="url_edit" id="url_edit" class="text ui-widget-content ui-corner-all" />
									<br clear="all" />
									<br/>
								</div>
								
								<div id="component_input_holder_edit" style="display: none;">
									<label for="component_edit"><?php echo $lang_array['Component'] ?></label>
									<?php echo $amms->getComponents("component_edit", "component_edit", "select ui-widget-content ui-corner-all"); ?>
									<br clear="all" />
									<br/>
								</div>
								
								<div id="component_id_input_holder_edit" style="display: none;">
									<label for="component_id_edit"><?php echo $lang_array['Component Id'] ?></label>
									<input type="text" name="component_id_edit" id="component_id_edit" class="text ui-widget-content ui-corner-all" />
									<br clear="all" />
									<br/>
								</div>
								
								<div id="content_input_holder_Edit" style="display: none;">
									<label for="content_edit"><?php echo $lang_array['Content'] ?></label>
									<?php echo $amms->getContents("content_edit", "content_edit", "select ui-widget-content ui-corner-all"); ?>
									<br clear="all" />
								</div>
								
							</fieldset>
							</form>
						</div>
						
						<!-- Delete Menu JQuery UI Confirmation Modal -->
						<div id="delete_menu-confirm" title="Delete (<?php echo $menu_details["menu_name"]; ?>) ?">
							<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $lang_array['This will permanently delete the entire menu from the database. Are you sure?'] ?></p>
						</div>
						
						<!-- Delete Menu ITEM JQuery UI Confirmation Modal -->
						<div id="delete_item-confirm" title="Delete this item menu?">
							<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo $lang_array['This will delete the selected item menu. Are you sure?'] ?></p>
						</div>
						
					</section>
		
				
				<table width="50%" cellspacing="0" cellpadding="5px" border="0" class="atable" style="margin:20px;">
					<thead>
						<tr>
							<td>ID</th>
							<td><?php echo $lang_array['Page name']; ?></td>
							<td><?php echo $lang_array['Page URL']; ?></td>
							<td><?php echo $lang_array['Language']; ?></td>
						</tr>
					</thead>
					<tbody>
							
						<?php
							
							$Sql = "SELECT * FROM `webpages`";
							$Result = mysql_query($Sql);
							
							while ($db_field = mysql_fetch_assoc($Result)) {
								?>
								<tr>
									<td><?php echo $db_field['PageID'] ?></td>
									<td><?php echo $db_field['file'] ?></td>
									<td><?php echo $db_field['urlinput'] ?></td>
									<td><?php echo $db_field['language'] ?></td>
								</tr>
								<?php
							}
									
						?>
						
					</tbody>
				</table>
				
			</div>
		</div>
	


		
		
	
	<!------------------------------------------------------------------------------------------------------------------------------------------------>		
	<!------------------------------------------------ TOOLTIP SETTINGS ------------------------------------------------------------------------------>

		<div id="tooltips" class="content">
			<div class="myform steps">
				<h3>Tooltips:</h3>	
					
					<?php
					$SQL = "SELECT tooltip_status FROM webpages_settings WHERE webpages_settings.id = 1";
					$result = mysql_query($SQL);

					$res = mysql_fetch_assoc($result); 
					$tooltip_status = $res['tooltip_status'];
					?>
				
					<form method="post" action="./changeTooltipStatus.php" class="centeredform" data-tip="<?php echo $lang_array['Tooltip Toggle - Tooltip']; ?>" >
						<?php 
							if ($tooltip_status == 1) {
								echo "<input type='hidden' id='the_tooltip_status' name='the_tooltip_status' value='is_on'>";
								echo '<input type="submit" class="tooltip_on" value="Submit" name="SubmitButton" >';
							}
							else{
								echo "<input type='hidden' id='the_tooltip_status' name='the_tooltip_status' value='is_off'>";
								echo '<input type="submit" class="tooltip_off" value="Submit" name="SubmitButton" >';
							}
						?>
					</form>
			</div>
		</div>
	
	<!------------------------------------------------------------------------------------------------------------------------------------------------>	



	
	
	
	<!------------------------------------------------------------------------------------------------------------------------------------------------>		
	<!------------------------------------------------ LANGUAGE SETTINGS ON THE FRONTEND ------------------------------------------------------------->

		<div id="languages" class="content">
			<div class="myform steps">
				<h3><?php echo $lang_array['Language Settings'] ?>:</h3>	
					
					<?php
					
					$SQL = "SELECT * FROM country";
					$result = mysql_query($SQL);					
					
					$SQL2 = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
					$result2 = mysql_query($SQL2);
					
					$res2 = mysql_fetch_assoc($result2); 
					$frontend_languages = $res2['frontend_languages'];
					$default_language = $res2['default_language'];
					
					$frontend_languages = explode("|", $frontend_languages);

					?>
				
				
					<form method="post" action="./saveLanguageSettings.php" class="centeredform" data-tip="<?php echo $lang_array['Here you can edit available languages on the frontend.']; ?>" >
						
						<table width="50%" cellspacing="0" cellpadding="5px" border="0" class="atable" style="margin:20px;">
							<tbody>
							
								<tr>
									<td>
										<label> <?php echo $lang_array['Languages on the frontend.'] ?>: </label>
									</td>
								
									<td>
										<select multiple id="availableLangs" name="availableLangs[]">
											<?php
												while ($db_field = mysql_fetch_assoc($result)) {
												
													$code = $db_field['iso2'];
													$name = utf8_encode($db_field['name']);
												
													if (in_array($code, $frontend_languages) && $code != ""){
														?>
															<option value="<?php echo $code; ?>" selected="selected" ><?php echo $name; ?></option>
														<?php
													}
													else{
														?>
															<option value="<?php echo $code; ?>" ><?php echo $name; ?></option>
														<?php
													}
													
												}
											?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td>
										<label> <?php echo $lang_array['Default language on the frontend.'] ?>: </label>
									</td>
									<td>
										<select id="defaultLang" name="defaultLang" size="10">
											<?php
												
												$SQL = "SELECT * FROM country";
												$result = mysql_query($SQL);					
											
												while ($db_field = mysql_fetch_assoc($result)) {
												
													$code = $db_field['iso2'];
													$name = utf8_encode($db_field['name']);
												
													if ( $code == $default_language ){
														?>
															<option value="<?php echo $code; ?>" selected="selected" ><?php echo $name; ?></option>
														<?php
													}
													else{
														?>
															<option value="<?php echo $code; ?>" ><?php echo $name; ?></option>
														<?php
													}
													
												}
											?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td colspan="2">
										<input type="submit" class="custom-button" value="<?php echo $lang_array['Submit']; ?>" name="saveLanguages" />
									</td>
								</tr>
								
							</tbody>
						</table>

					</form>
					
			</div>
		</div>
	
	<!------------------------------------------------------------------------------------------------------------------------------------------------>	
	<!------------------------------------------------------------------------------------------------------------------------------------------------>	
	
	
	
	
		
		
		
	</div>
	<div class="bot"></div>
	
</div>

<div class="footer-outer">
  <div class="footer-inner">
    <div class="footer"><p>&copy; All right reserved.</p></div>
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