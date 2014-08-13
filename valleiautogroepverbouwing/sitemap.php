<?php
	
	ob_start();
	include('config.php');
	
	
	$doc = new DOMDocument('1.0', 'UTF-8'); 
	$doc->formatOutput = true; 
   
	$root = $doc->createElement( "urlset" );
	$root->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

	$doc->appendChild( $root ); 
	
	

//----------------------------------------------------------------------------//
//--------------------- Adding the index.php ---------------------------------//
	
	$b = $doc->createElement( "url" ); 
	   
	   
	$loc = $doc->createElement( "loc" ); 
	$loc->appendChild( 
	$doc->createTextNode( $Site_Url.'index.php' ) 
	); 
	$b->appendChild( $loc );


	$changefreq = $doc->createElement( "changefreq" ); 
	$changefreq->appendChild( 
	$doc->createTextNode( "weekly" ) 
	); 
	$b->appendChild( $changefreq ); 	


	$priority = $doc->createElement( "priority" ); 
	$priority->appendChild( 
	$doc->createTextNode( "0.7" ) 
	); 
	$b->appendChild( $priority ); 	
	
	
	$root->appendChild( $b );
	
//----------------------------------------------------------------------------//
//----------------------------------------------------------------------------//	
   
   
   

//----------------------------------------------------------------------------//
//------------------- GETTING THE PAGES --------------------------------------//
	
	$sql = "SELECT * FROM webpages";
	$result = mysql_query($sql);
		
		
	while ($db_field = mysql_fetch_assoc($result)) {
		
		$b = $doc->createElement( "url" ); 
	   
		//-------- URL ------------------------------------------//
		$loc = $doc->createElement( "loc" ); 
		$loc->appendChild( 
		$doc->createTextNode( $Site_Url.$db_field['urlinput'] ) 
		); 
		$b->appendChild( $loc ); 
		
		
		$changefreq = $doc->createElement( "changefreq" ); 
		$changefreq->appendChild( 
		$doc->createTextNode( "weekly" ) 
		); 
		$b->appendChild( $changefreq ); 
		
		
		//-------- Prority - Home, Contact ----------------------//
		if ($db_field['urlinput'] == 'home.html' || $db_field['urlinput'] == 'contact.html'){
			$priority = $doc->createElement( "priority" ); 
			$priority->appendChild( 
			$doc->createTextNode( "0.8" ) 
			); 
			$b->appendChild( $priority ); 	
		}
	    
		
		$root->appendChild( $b ); 
		
	}

//----------------------------------------------------------------------------//
//----------------------------------------------------------------------------//  
   
	echo $doc->saveXML(); 
	$doc->save("sitemap.xml");
	
	header( 'Location: ./admin.php#pages' );
?>