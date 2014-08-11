<?php

	if (isset($_POST["current_menu_nr_items"])) {
		$menu 		= true;
		$menu_items = $_POST["current_menu_nr_items"];
		
	} else {
		$menu = false;
	}

?>

<!doctype html>

<html lang="en">
	
	<head>
		<meta charset="utf-8">

		<title>Ultimate CSS/JQuery Menu</title>
		<meta name="description" content="Demo page of the Nested Sortable jQuery Plugin">
		<meta name="author" content="Eduardo Pereira | voindo.eu">
		
		<link type="text/css" href="assets/css/simple_menu.css"  rel="stylesheet" />
		
		<script type="text/javascript" src="assets/js/jquery-1.6.4.min.js"></script>
		<script type="text/javascript" src="assets/js/simple_menu.js"></script>
		
		
		
	</head>
	
	<body>

		<header>
			<h1>Ultimate Menu Manager System (Preview Menu)</h1>
			<h2>Manage menus and database operations using PHP, JQuery and MySQL <strong>(with Nested Set Model)</strong></h2>
		</header>
		<br/>
		
		<section id="ultimate_menu_manager">
			
			
			<?php
				
				$x 		= 0;	// first foreach loop counter
				$y 		= 0;	// first foreach loop counter excluding first passage
				$z 		= 0;	// second foreach loop counter
				$depth1 = 0;	// Counts how many depth one exists in menu
				
				$tree 	= array();
				foreach($_POST['menu_item'] as $values) {
					if ($x > 0) {
						$z = 0;
						foreach ( $values as $key => $value ) {
							if ($z == 0) {
								$tree[$y]["item_title"] = $value;
							} else if ($z == 1) {
								$tree[$y]["depth"] = $value;
								if ($tree[$y]["depth"] == 1) {
									$depth1++;
								}
							} else if ($z == 2) {
								$tree[$y]["left"] = $value;
							} else if ($z == 3) {
								$tree[$y]["right"] = $value;
							}
							$z++;
						}
						$y++;
					}
					$x++;
				}
				
				
				
				
				
				// bootstrap loop
				$result 		= '<ol id="menu3" class="simple_menu simple_menu_css horizontal">';
				
				$currDepth 		= 1;  			// Start from what depth (0 to get the outer <ul> - NOT RECOMENDED)
				$total			= $x - 1;		// Total of menu items (according to previous first foreach loop above) minus one because we have a 0 key in array eith no menu items
				$x				= 0;			// Reset X for counting next while loop
				$Dep1Count		= 0;			// Counter for depth 1 items
				while (!empty($tree)) {
					$x++;
					$currNode = array_shift($tree);
					
					if ($currNode['depth'] == 1) { $Dep1Count++; };
					
					// Level down?
					if ($currNode['depth'] > $currDepth) {
						// Yes, open <ul>
						$result .= '<ol>';
					} else if ($x > 1) {
						$result .= '</li>';
					}
					
					// Level up?
					if ($currNode['depth'] < $currDepth) {
						// Yes, close n open <ul>
						$result .= str_repeat('</ol></li>', $currDepth - $currNode['depth']);
					}
					
					
					// Checks if it is last item OR last depth one item
					if (($x == $total) or ($Dep1Count == $depth1)) { 
						$lastClass = "last"; 
					} else {
						$lastClass = ""; 
					}
					
					// Always add node. Checks if it is last item OR last depth one item
					if ($x == $total) {
						$result 	.= '<li class="'.$lastClass.'"><a href="#">'.$currNode['item_title'].'</a></li>';
					} else {
						$result 	.= '<li class="'.$lastClass.'"><a href="#">'.$currNode['item_title'].'</a>';
					}
					
					// Adjust current depth
					$currDepth 	= $currNode['depth'];
					
					// Are we finished?
					if (empty($tree)) {
						// Yes, close n open <ul>'s and correspondig <li>'s
						$result .= str_repeat('</ol></li>', $currDepth -1);
					}
				}
				$result .= "</ol>";
				
				echo $result;
				
			?>
			<script>
				$('ol#menu3').simpleMenu();
			</script>
			<br clear="all" />
			<br/>
		
			
		</section> <!-- END #demo -->
			
	</body>
</html>