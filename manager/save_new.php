<?php


$pizza_name = $_POST['save_recep_name'];
$desc = $_POST['desc_recep_name'];


$doc = new DOMDocument;
$doc->load('../pizzeria.xml');


$root = $doc->documentElement;
$xpath = new DOMXPath($doc);
$query = '/pizzeria/menu';

$id = rand(100, 200);
foreach($xpath->query($query) as $menu) {
	$node = $doc-> createElement("pizza");
	$menu -> appendChild($node);
	$node -> setAttribute("id", $id);
}

$queryUpdate = sprintf('/pizzeria/menu//pizza[@id = "%d"]',$id);

	foreach($xpath->query($queryUpdate) as $pizza) {
 	   	$node = $doc-> createElement("name");
 	   	$name = $doc -> createTextNode("$pizza_name");
 	   	
 	   	$node -> appendChild($name);
 	   	$pizza -> appendChild($node);
 	   	//$pizza -> appendChild($name);
 	   	$node = $doc -> createElement("description");
			$des = $doc -> createTextNode("$desc"); 	   	
 	   	$node -> appendChild($des);
 	   	$pizza -> appendChild($node);
 	   	
	}



for($i=1;$i<=20;$i++) {
	if($_POST[$i] != 0) 
	foreach($xpath->query($queryUpdate) as $pizza) {
 	   	$node = $doc-> createElement("ingredient");
 	   	$pizza -> appendChild($node);
 	   	$node -> setAttribute("id", $i);
 	   	$node -> setAttribute("units", $_POST[$i] );
	}
	
}

$doc->save('../pizzeria.xml');

?>