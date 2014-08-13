<?php 

	include('config.php');
	
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
<style type="text/css">

	
	#widget_newsletter, 
	#widget_flexbanner,
	#widget_flexbanner1,
	#widget_flexbanner2,
	#widget_flexbanner3,
	#widget_gallery,        
	#widget_left_navigation
	{
		background: none repeat scroll 0 0 #<?php echo $widget_content_bg; ?>;
		/*border-radius:<?php echo $widget_border_radius; ?>px;
		border: 1px solid #<?php echo $widget_border_color; ?>;*/
		width:100%;
                margin-top:4px;
		margin-bottom:10px;
	}
        <?php
        for($i=1;$i<=20;$i++){?>
         #widget_gallery_<?php echo $i;?> {
                    background: none repeat scroll 0 0 #<?php echo $widget_content_bg; ?>;
                    /*border-radius:<?php echo $widget_border_radius; ?>px;
                    border: 1px solid #<?php echo $widget_border_color; ?>;*/
                    width:100%;
                    margin-top:4px;
                    margin-bottom:10px;
            }   
        <?php
            
        }
        ?>
        
	#widget_newsletter .widget_head, 
	#widget_flexbanner .widget_head,
	#widget_flexbanner1 .widget_head,
	#widget_flexbanner2 .widget_head,
	#widget_flexbanner3 .widget_head,
	#widget_gallery .widget_head,
	#widget_left_navigation .widget_head
	{
		background: none repeat scroll 0 0 #<?php echo $widget_head_bg; ?>;
		color: #<?php echo $widget_head_text; ?>;
		/*border-radius:<?php echo $widget_border_radius; ?>px <?php echo $widget_border_radius; ?>px 0px 0px;*/
	}

	#widget_newsletter .widget_content,
	#widget_flexbanner .widget_content,
	#widget_flexbanner1 .widget_content,
	#widget_flexbanner2 .widget_content,
	#widget_flexbanner3 .widget_content,
	#widget_gallery .widget_content,
	#widget_left_navigation .widget_content
	{
		color: #<?php echo $widget_content_text; ?>
	}
	
	

</style>	