

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
	
	
	<div id="tabsnew">
		<ul>
			<li id="tab_pages" ><a href="./admin.php#pages"><span>1</span><?php echo $lang_array['Pages'] ?></a></li>
			<li id="tab_header" ><a href="./admin.php#header"><span>2</span><?php echo $lang_array['Header'] ?></a></li>
			<li id="tab_menu" ><a href="./admin.php#mymenu"><span>3</span><?php echo $lang_array['Menu'] ?></a></li>
			<li id="tab_footer" ><a href="./admin.php#myfooter"><span>4</span><?php echo $lang_array['Footer'] ?></a></li>
			
			
			<li id="tab_slider" ><a href="./admin.php#bannerslider"><span>1</span><?php echo $lang_array['Banner Slider'] ?></a></li>
			<li id="tab_backs" ><a href="./admin.php#backgrounds"><span>2</span><?php echo $lang_array['Upload Backgrounds'] ?></a></li>
			<li id="tab_widgets" ><a href="./admin.php#widgets"><span>3</span>Widgets</a></li>
			<li id="tab_widgetpages" ><a href="./admin.php#templates"><span>4</span>Templates and Default Pages</a></li>
			
			
			<li id="tab_mailforms" ><a href="./admin.php#mail-forms"><span>1</span> Mail Forms </a></li>
			<li id="tab_sideb" ><a href="./admin.php#sidebar"><span>2</span><?php echo $lang_array['Sidebar'] ?></a></li>			
			
			<li id="tab_setts" ><a href="./admin.php#setts"><span>1</span><?php echo $lang_array['Settings'] ?></a></li>
			<li id="tab_tooltips" ><a href="./admin.php#tooltips"><span>2</span>Tooltips</a></li>
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
			
			$("#pagetd").css({"border-color": "white"}); 
			$("#widgtd").css({"border-color": "white"}); 
			$("#mailtd").css({"border-color": "white"}); 
			$("#othetd").css({"border-color": "white"}); 
		}						
	</script>	