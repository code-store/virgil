<?php 

	ob_start();
	include('config.php');


	//$header_color = $_POST["header_color"]; 
	$footer_color = $_POST["footer_color"]; 
	$footer_link = $_POST["footer_link"]; 
	$footer_text = $_POST["footer_text"]; 
	$footer_textc = $_POST["footer_textc"]; 
	$footer_textc_hover = $_POST["footer_textc_hover"]; 
	
	$slider_bg = $_POST["footer_col"]; 
	$group_f = $_POST["group_f"]; 
	
	
	//  If some of the data did not arrive............................... //
	//--------------------------------------------------------------------//
	$SQL = "SELECT * FROM webpages_settings WHERE webpages_settings.id = 1";
	$result = mysql_query($SQL);

	$res = mysql_fetch_assoc($result); 
	
	
	if ($footer_color == "" || $footer_color == null) { $footer_color = $res['footer_bg']; }
	if ($footer_link == "" || $footer_link == null) { $footer_link = $res['footer_link']; }
	if ($footer_text == "" || $footer_text == null) { $footer_text = $res['footer_text']; }
	//--------------------------------------------------------------------//
		
	
	$footer = '<div class="footer_ext">';
	
	if ($group_f == 'colour')
	{
	$footer .= '<div class="projects-container" style="background: #'.$slider_bg.'" >';
	}
	else
	{
	$footer .= '<div class="projects-container" style="background: url(\'../images/backgrounds/'.$group_f.'\') repeat-x scroll 0 0 transparent;">';
	}
	
	$footer = $footer.'    	<div class="footer-wrap">
        	<div class="outerOneFourth">
                <div class="title"><h4>Pages</h4></div>
                <div class="clear20"></div>
                <ul class="bullet4">
                    <li><p><a href="#">Lorem ipsum dolor sit amet</a></p></li>
                    <li><p><a href="#">Fusce accumsan mollis eros</a></p></li>
                    <li><p><a href="#">Nullam quis massa</a></p></li>
                    <li><p><a href="#">Ut scelerisque hendrerit</a></p></li>
                    <li><p><a href="#">Vivamus imperdiet nibh feugiat</a></p></li>
                    <li><p><a href="#">Integer eu magna sit amet</a></p></li>
                    <li><p><a href="#">Cum sociis natoque penatibus</a></p></li>
                </ul>
            </div>
        	<div class="outerOneFourth">
                <div class="title"><h4>Twitter</h4></div>
                <div class="clear"></div>
                
                <div id="twitter">
                </div>
                
                <script type="text/javascript">
                $("#twitter").jTweetsAnywhere({
                    username: "envato",
                    count: 3,
                    showFollowButton: false
                });
                </script>
               
            </div>
        	<div class="outerOneFourth">
                <div class="title"><h4>About Us</h4></div>
                <div class="clear"></div>
                <div id="about-us">
                    <p><img src="images/building.png" alt="" class="fl" />Sed fringilla dui id ante volutpat ut pellentesque lacus semper. 
                    Duis laoreet congue consectetur. Aliquam volutpat scelerisque dui ac fringilla. 
                    Praesent et volutpat urna. Sed ipsum dolor.</p><br />
                    <p>Praesent et volutpat urna. Sed ipsum dolor, dapibus a ultrices a, 
                    pellentesque eget metus.</p><br />
                    <ul class="socialNav">
                        <li><a href="#" title="Facebook"><img src="images/facebook_icon.png" alt="Delicious" /></a></li>
                        <li><a href="#" title="Twitter"><img src="images/twitter_icon.png" alt="Twitter" /></a></li>
                        <li><a href="#" title="Dribble"><img src="images/dribble_icon.png" alt="Drible" /></a></li>
                        <li><a href="#" title="StumbleUpon"><img src="images/su_icon.png" alt="StumbleUpon" /></a></li>
                        <li><a href="#" title="RSS"><img src="images/rss_icon.png" alt="Rss" /></a></li>
					</ul>
                </div>
            </div>
        	<div class="outerOneFourth last">
                <div class="title"><h4>Contact</h4></div>
                <div class="clear"></div>
                <div id="contactWrap">
                    <iframe src="/templates/design-4/footerForm.php?url=footer_contact" width="207" height="306"></iframe>
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
		<div class="clear"></div>
        <div class="post-footer">
            <div class="post-footer-wrap">
            <p class="fl"><a href="http://www.123website-online.nl/" target="_blank">Powered by 123website-online.nl</a></p>
            ';
		
     include ("include/amms.class.php");
     $amms = new amms;
     $footer .= $amms->render_menu_footer("footer_menu", "the_footer_menu", "horizontal", "foot_nav");
        
     $footer .= '
            </div>
        </div>';

	$footer = $footer.'</div></div>';
	
	$footer = $footer.'</div>'; // end of inner-wrap
	$footer = $footer.'</div>	<div class="clear"></div>
		<div id="footerShadow" class="boxed boxed">
<div class="shadowHolderflat">
<img alt="" src="images/big-shadow.png" />
</div>
</div>'; // end of wrap
	
	//$footer = $footer.'</body></html>';	
	
	
	$stringData = $footer;

	
	
	
	$stringData = str_replace("../", './', $stringData);
	$stringData = str_replace("../images/", "./images/", $stringData);
	
	$sql = "UPDATE webpages_elements SET webpages_elements.footer = '".addslashes($stringData)."' WHERE webpages_elements.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }

	
	
	
	
	// Insert data into DB //
	
	if ($group_f == 'colour') {
	$sql = "UPDATE webpages_settings SET webpages_settings.slider_bg = '".$slider_bg."' WHERE webpages_settings.id = 1";
	}
	else{
	$sql = "UPDATE webpages_settings SET webpages_settings.slider_bg = '".$group_f."' WHERE webpages_settings.id = 1";
	}
	if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
	
	$sql = "UPDATE webpages_settings SET webpages_settings.footer_bg = '".$footer_color."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('1.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.footer_link = '".$footer_link."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('2.Sorry. Error at saving data! Please try again later!'); }

	$sql = "UPDATE webpages_settings SET webpages_settings.footer_text = '".$footer_text."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }
	
	$sql = "UPDATE webpages_settings SET webpages_settings.footer_textc = '".$footer_textc."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }
		
	$sql = "UPDATE webpages_settings SET webpages_settings.footer_textc_hover = '".$footer_textc_hover."' WHERE webpages_settings.id = 1";
		if (!mysql_query($sql)) { die('3.Sorry. Error at saving data! Please try again later!'); }	
	
	
	header( 'Location: ./admin.php#myfooter' ) ;
	
	
//--------------- (End) Update CMS --------------------//

?>