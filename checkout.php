<?php

$doc = new DOMDocument;
$doc->load('pizzeria.xml');

$xpath = new DOMXPath($doc);

	
while ($name = current($_POST)) {
	
	 $ind = key($_POST);
	 
	 
	 $new_val = intval(current($_POST)); 
	 
	 $queryUpdate = sprintf('/pizzeria/menu//pizza[@id = "%d"]/popularity',$ind );
	 $query = sprintf('/pizzeria/menu//pizza[@id = "%d"]',$ind );
	 $querying  = sprintf('/pizzeria/menu//pizza[@id = "%d"]/ingredient',$ind );
	 $querystorage = sprintf('/pizzeria/storage/ingredient');
	 
	 
	 foreach($xpath->query($queryUpdate) as $pop) {
 	   	
 	   	$pop->parentNode->removeChild($pop);
 	   	
 	   	
	 }	
    
    foreach($xpath->query($query) as $pizz ) {
 	   	
 	   	
 	   	$node = $doc-> createElement("popularity");
 	   	
 	   	$prev = $pop -> textContent;
			$name = $doc -> createTextNode($new_val + intval($prev)); 	   	
		   //$pop -> parents();
 	   	$node  -> appendChild($name);
 	   	$pizz   -> appendChild($node);
 	   	
	 }
	 //////////////////////////////////////////////////////////////////
	 foreach($xpath->query($querying ) as $ing  ) {
 	   	
 	   	
 	   	$units = $ing -> getAttribute('units');
 	   	$id = $ing -> 	getAttribute('id');
 	   	
 	   	foreach ($xpath->query( $querystorage) as $inger  ) {
 	   			
 	   			if ($inger  -> getAttribute( 'id' ) == $id ) {
 	   			
 	   						$prev_storage = $inger  -> getAttribute('in_storage');				
 	   						$inger  -> setAttribute('in_storage' , ($prev_storage)-($new_val * $units));
 	   			 }	
 	   	
 	   	
 	  
	 		}
	 
	 
	 }

    
    next($_POST);
    
}


$doc->save('pizzeria.xml');
?>
