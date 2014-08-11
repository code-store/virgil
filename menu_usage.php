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
			<h1>Ultimate Menu Manager System (Menu Render Call Function)</h1>
			<h2>Calls a specific menu and renders it <strong>(using Simple JQuery Menu)</strong></h2>
		</header>
		<br/>
		
		<section id="ultimate_menu_manager">
			
			
			
			
			<pre style="background: #eee; padding: 10px;">
&lt;?php
	include (&quot;include/amms.class.php&quot;);
	$amms = new amms;
	echo $amms-&gt;render_menu(&quot;main_menu&quot;, &quot;menu1&quot;, &quot;horizontal&quot;);
?&gt;
			</pre>
			<?php
				include ("include/amms.class.php");
				$amms = new amms;
				echo $amms->render_menu("main_menu", "menu1", "horizontal");
			?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			
			
			
			
			
			<pre style="background: #eee; padding: 10px;">
&lt;?php
	include (&quot;include/amms.class.php&quot;);
	$amms = new amms;
	echo $amms-&gt;render_menu(&quot;main_menu&quot;, &quot;menu2&quot;, &quot;horizontal&quot;, &quot;green_menu&quot;);
?&gt;
			</pre>
			<?php
				echo $amms->render_menu("main_menu", "menu2", "horizontal", "green_menu");
			?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			
			
			
			
			
			
			
			
			<pre style="background: #eee; padding: 10px;">
&lt;?php
	include (&quot;include/amms.class.php&quot;);
	$amms = new amms;
	echo $amms-&gt;render_menu(&quot;main_menu&quot;, &quot;menu3&quot;, &quot;horizontal&quot;, &quot;green_menu&quot;);
?&gt;
			</pre>
			<?php
				echo $amms->render_menu("main_menu", "menu3", "horizontal", "blue_menu");
			?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			
			
			
			
			
			
			
			<pre style="background: #eee; padding: 10px;">
&lt;?php
	include (&quot;include/amms.class.php&quot;);
	$amms = new amms;
	echo $amms-&gt;render_menu(&quot;main_menu&quot;, &quot;menu4&quot;, &quot;vertical&quot;, &quot;orange_menu&quot;);
?&gt;
			</pre>
			<?php
				echo $amms->render_menu("main_menu", "menu4", "vertical", "orange_menu");
			?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			
			
			
			
			
			
			
			
			
			<pre style="background: #eee; padding: 10px;">
&lt;?php
	include (&quot;include/amms.class.php&quot;);
	$amms = new amms;
	echo $amms-&gt;render_menu(&quot;footer_menu&quot;, &quot;menu5&quot;, &quot;vertical&quot;, &quot;green_menu&quot;);
?&gt;
			</pre>
			<?php
				echo $amms->render_menu("footer_menu", "menu5", "vertical", "green_menu");
			?>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			
			
			
			
			
			
			
			
			
			
		</section> <!-- END #demo -->
			
	</body>
</html>