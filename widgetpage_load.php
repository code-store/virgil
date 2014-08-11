<?php 

include 'config.php';

$page = $_GET["page"]; 


if ($page)
	{
	
		$sql = "SELECT * FROM widgets_pages WHERE name='".$page."'";
		$result = mysql_query($sql);
		while ($db_field = mysql_fetch_assoc($result)) {
				$widgets = $db_field['widgets'];
			}
		
			?>
			
				<link href="css/inettuts.css" rel="stylesheet" type="text/css" />
				<link href="css/inettuts.js.css" rel="stylesheet" type="text/css" />
			
					<div id="columns">
        
						<ul id="column1" class="column">
							<li class="widget color-green" id="intro">
								<div class="widget-head">
									<h3>Introduction Widget</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
							<li class="widget color-red">  
								<div class="widget-head">
									<h3>Widget title</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
						</ul>

						<ul id="column2" class="column">
							<li class="widget color-blue">  
								<div class="widget-head">
									<h3>Widget title</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
							<li class="widget color-yellow">  
								<div class="widget-head">
									<h3>Widget title</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
						</ul>
						
						<ul id="column3" class="column">
							<li class="widget color-orange">  
								<div class="widget-head">
									<h3>Widget title</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
							<li class="widget color-white">  
								<div class="widget-head">
									<h3>Widget title</h3>
								</div>
								<div class="widget-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam magna sem, fringilla in, commodo a, rutrum ut, massa. Donec id nibh eu dui auctor tempor. Morbi laoreet eleifend dolor. Suspendisse pede odio, accumsan vitae, auctor non, suscipit at, ipsum. Cras varius sapien vel lectus.</p>
								</div>
							</li>
							
						</ul>
						
					</div>
					
					<script type="text/javascript" src="./js/inettuts.js"></script>	
			
			
			<?php
	}
	else{
		echo "Please choose one Widget Page!!";
	}
	

	

?>