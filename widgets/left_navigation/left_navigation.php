<?php

	// Newsletter Widget
	// by Facebook-Shopper

?>

	<div id="widget_left_navigation">
		
		<h4 class="widget_head"> <?php echo $lang_array['Navigation Block:']; ?> </h4>
		
		<div class="widget_content">
			
					<?php
						echo $amms->render_menu("left_navigation", "left_navigation", "vertical", "green_menu");
					?>
				
		</div>
		
	</div>
